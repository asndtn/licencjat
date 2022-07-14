<?php
/**
 * Movement controller.
 */

namespace App\Controller;

use App\Entity\Movement;
use App\Form\MovementType;
use App\Service\MovementServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class MovementController.
 *
 * @Route("/movement")
 *
 * @IsGranted("ROLE_ADMIN")
 */
class MovementController extends AbstractController
{
    /**
     * Movement service.
     */
    private MovementServiceInterface $movementService;

    /**
     * Translator.
     */
    private TranslatorInterface $translator;

    /**
     * Constructor.
     *
     * @param MovementServiceInterface $movementService Movement service
     * @param TranslatorInterface      $translator      Translator
     */
    public function __construct(MovementServiceInterface $movementService, TranslatorInterface $translator)
    {
        $this->movementService = $movementService;
        $this->translator = $translator;
    }

    /**
     * Index action.
     *
     * @param Request $request User request
     *
     * @return Response HTTP Response
     *
     * @Route("/", name="movement_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $pagination = $this->movementService->getPaginatedList(
            $request->query->getInt('page', 1)
        );

        return $this->render('movement/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param Movement $movement Movement entity
     *
     * @return Response HTTP Response
     *
     * @Route("/{id}", name="movement_show", requirements={"id": "[1-9]\d*"}, methods={"GET"})
     */
    public function show(Movement $movement): Response
    {
        return $this->render(
            'movement/show.html.twig',
            ['movement' => $movement]
        );
    }

    /**
     * Create action.
     *
     * @param Request $request HTTP request
     *
     * @return Response HTTP response
     *
     * @Route("/create", name="movement_create", methods={"GET|POST"})
     */
    public function create(Request $request): Response
    {
        $movement = new Movement();
        $form = $this->createForm(MovementType::class, $movement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->movementService->save($movement);

            $this->addFlash(
                'success',
                $this->translator->trans('message.created_successfully')
            );

            return $this->redirectToRoute('movement_index');
        }

        return $this->render(
            'movement/create.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Edit action.
     *
     * @param Request  $request  HTTP request
     * @param Movement $movement Movement entity
     *
     * @return Response HTTP response
     *
     * @Route("/{id}/edit", name="movement_edit", requirements={"id": "[1-9]\d*"}, methods={"GET|PUT"})
     */
    public function edit(Request $request, Movement $movement): Response
    {
        $form = $this->createForm(MovementType::class, $movement, [
            'method' => 'PUT',
            'action' => $this->generateUrl('movement_edit', ['id' => $movement->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->movementService->save($movement);

            $this->addFlash(
                'success',
                $this->translator->trans('message.edited_successfully')
            );

            return $this->redirectToRoute('movement_index');
        }

        return $this->render(
            'movement/edit.html.twig',
            [
                'form' => $form->createView(),
                'movement' => $movement,
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param Request  $request  HTTP Request
     * @param Movement $movement Movement entity
     *
     * @return Response HTTP Response
     *
     * @Route("/{id}/delete", name="movement_delete", requirements={"id": "[1-9]\d*"}, methods={"GET", "DELETE"})
     */
    public function delete(Request $request, Movement $movement): Response
    {
        if (!$this->movementService->canBeDeleted($movement)) {
            $this->addFlash(
                'warning',
                $this->translator->trans('message.contains_inputs')
            );

            return $this->redirectToRoute('movement_index');
        }

        $form = $this->createForm(FormType::class, $movement, [
            'method' => 'DELETE',
            'action' => $this->generateUrl('movement_delete', ['id' => $movement->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->movementService->delete($movement);

            $this->addFlash(
                'success',
                $this->translator->trans('message.deleted_successfully')
            );

            return $this->redirectToRoute('movement_index');
        }

        return $this->render(
            'movement/delete.html.twig',
            [
                'form' => $form->createView(),
                'movement' => $movement,
            ]
        );
    }
}
