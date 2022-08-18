<?php
/**
 * Nationality controller.
 */

namespace App\Controller;

use App\Entity\Nationality;
use App\Form\NationalityType;
use App\Service\NationalityServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class NationalityController.
 *
 * @Route("/nationality")
 *
 * @IsGranted("ROLE_ADMIN")
 */
class NationalityController extends AbstractController
{
    /**
     * Nationality service.
     */
    private NationalityServiceInterface $nationalityService;

    /**
     * Translator.
     */
    private TranslatorInterface $translator;

    /**
     * Constructor.
     *
     * @param NationalityServiceInterface $nationalityService Nationality service
     * @param TranslatorInterface         $translator         Translator
     */
    public function __construct(NationalityServiceInterface $nationalityService, TranslatorInterface $translator)
    {
        $this->nationalityService = $nationalityService;
        $this->translator = $translator;
    }

    /**
     * Index action.
     *
     * @param Request $request User request
     *
     * @return Response HTTP Response
     *
     * @Route("/", name="nationality_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $pagination = $this->nationalityService->getPaginatedList(
            $request->query->getInt('page', 1)
        );

        return $this->render('nationality/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param Nationality $nationality Nationality entity
     *
     * @return Response HTTP Response
     *
     * @Route("/{id}", name="nationality_show", requirements={"id": "[1-9]\d*"}, methods={"GET"})
     */
    public function show(Nationality $nationality): Response
    {
        return $this->render(
            'nationality/show.html.twig',
            ['nationality' => $nationality]
        );
    }

    /**
     * Create action.
     *
     * @param Request $request HTTP request
     *
     * @return Response HTTP response
     *
     * @Route("/create", name="nationality_create", methods={"GET|POST"})]
     */
    public function create(Request $request): Response
    {
        $nationality = new Nationality();
        $form = $this->createForm(NationalityType::class, $nationality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->nationalityService->save($nationality);

            $this->addFlash(
                'success',
                $this->translator->trans('message.created_successfully')
            );

            return $this->redirectToRoute('nationality_show', ['id' => $nationality->getId()]);
        }

        return $this->render(
            'nationality/create.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Edit action.
     *
     * @param Request     $request     HTTP request
     * @param Nationality $nationality Nationality entity
     *
     * @return Response HTTP response
     *
     * @Route("/{id}/edit", name="nationality_edit", requirements={"id": "[1-9]\d*"}, methods={"GET", "PUT"})]
     */
    public function edit(Request $request, Nationality $nationality): Response
    {
        $form = $this->createForm(NationalityType::class, $nationality, [
            'method' => 'PUT',
            'action' => $this->generateUrl('nationality_edit', ['id' => $nationality->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->nationalityService->save($nationality);

            $this->addFlash(
                'success',
                $this->translator->trans('message.edited_successfully')
            );

            return $this->redirectToRoute('nationality_show', ['id' => $nationality->getId()]);
        }

        return $this->render(
            'nationality/edit.html.twig',
            [
                'form' => $form->createView(),
                'nationality' => $nationality,
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param Request     $request     HTTP Request
     * @param Nationality $nationality Nationality entity
     *
     * @return Response HTTP Response
     *
     * @Route("/{id}/delete", name="nationality_delete", requirements={"id": "[1-9]\d*"}, methods={"GET", "DELETE"})]
     */
    public function delete(Request $request, Nationality $nationality): Response
    {
        if (!$this->nationalityService->canBeDeleted($nationality)) {
            $this->addFlash(
                'warning',
                $this->translator->trans('message.contains_inputs')
            );

            return $this->redirectToRoute('nationality_index');
        }

        $form = $this->createForm(FormType::class, $nationality, [
            'method' => 'DELETE',
            'action' => $this->generateUrl('nationality_delete', ['id' => $nationality->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->nationalityService->delete($nationality);

            $this->addFlash(
                'success',
                $this->translator->trans('message.deleted_successfully')
            );

            return $this->redirectToRoute('nationality_index');
        }

        return $this->render(
            'nationality/delete.html.twig',
            [
                'form' => $form->createView(),
                'nationality' => $nationality,
            ]
        );
    }
}
