<?php
/**
 * Field controller.
 */

namespace App\Controller;

use App\Entity\Field;
use App\Form\FieldType;
use App\Service\FieldServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class FieldController.
 */
#[Route('/field')]
class FieldController extends AbstractController
{
    /**
     * Field service.
     */
    private FieldServiceInterface $fieldService;

    /**
     * Translator.
     */
    private TranslatorInterface $translator;

    /**
     * Constructor.
     *
     * @param FieldServiceInterface $fieldService Field service
     * @param TranslatorInterface   $translator   Translator
     */
    public function __construct(FieldServiceInterface $fieldService, TranslatorInterface $translator)
    {
        $this->fieldService = $fieldService;
        $this->translator = $translator;
    }

    /**
     * Index action.
     *
     * @param Request $request User request
     *
     * @return Response HTTP Response
     */
    #[Route(name: 'field_index', methods: 'GET')]
    public function index(Request $request): Response
    {
        $pagination = $this->fieldService->getPaginatedList(
            $request->query->getInt('page', 1)
        );

        return $this->render('field/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param Field $field Field entity
     *
     * @return Response HTTP Response
     */
    #[Route(
        '/{id}',
        name: 'field_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET'
    )]
    public function show(Field $field): Response
    {
        return $this->render(
            'field/show.html.twig',
            ['field' => $field]
        );
    }

    /**
     * Create action.
     *
     * @param Request $request HTTP request
     *
     * @return Response HTTP response
     */
    #[Route(
        '/create',
        name: 'field_create',
        methods: 'GET|POST'
    )]
    public function create(Request $request): Response
    {
        $field = new Field();
        $form = $this->createForm(FieldType::class, $field);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->fieldService->save($field);

            $this->addFlash(
                'success',
                $this->translator->trans('message.created_successfully')
            );

            return $this->redirectToRoute('field_index');
        }

        return $this->render(
            'field/create.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Edit action.
     *
     * @param Request $request HTTP request
     * @param Field   $field   Field entity
     *
     * @return Response HTTP response
     */
    #[Route('/{id}/edit', name: 'field_edit', requirements: ['id' => '[1-9]\d*'], methods: 'GET|PUT')]
    public function edit(Request $request, Field $field): Response
    {
        $form = $this->createForm(FieldType::class, $field, [
            'method' => 'PUT',
            'action' => $this->generateUrl('field_edit', ['id' => $field->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->fieldService->save($field);

            $this->addFlash(
                'success',
                $this->translator->trans('message.edited_successfully')
            );

            return $this->redirectToRoute('field_index');
        }

        return $this->render(
            'field/edit.html.twig',
            [
                'form' => $form->createView(),
                'field' => $field,
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param Request $request HTTP Request
     * @param Field   $field   Field entity
     *
     * @return Response HTTP Response
     */
    #[Route('/{id}/delete', name: 'field_delete', requirements: ['id' => '[1-9]\d*'], methods: 'GET|DELETE')]
    public function delete(Request $request, Field $field): Response
    {
        if (!$this->fieldService->canBeDeleted($field)) {
            $this->addFlash(
                'warning',
                $this->translator->trans('message.field_contains_inputs')
            );

            return $this->redirectToRoute('field_index');
        }

        $form = $this->createForm(FormType::class, $field, [
            'method' => 'DELETE',
            'action' => $this->generateUrl('field_delete', ['id' => $field->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->fieldService->delete($field);

            $this->addFlash(
                'success',
                $this->translator->trans('message.deleted_successfully')
            );

            return $this->redirectToRoute('field_index');
        }

        return $this->render(
            'field/delete.html.twig',
            [
                'form' => $form->createView(),
                'field' => $field,
            ]
        );
    }
}
