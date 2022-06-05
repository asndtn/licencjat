<?php
/**
 * Movement controller.
 */

namespace App\Controller;

use App\Entity\Movement;
use App\Service\MovementServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MovementController.
 */
#[Route('/movement')]
class MovementController extends AbstractController
{
    /**
     * Movement service.
     */
    private MovementServiceInterface $movementService;

    /**
     * Constructor.
     */
    public function __construct(MovementServiceInterface $movementService)
    {
        $this->movementService = $movementService;
    }

    /**
     * Index action.
     *
     * @param Request $request User request
     *
     * @return Response HTTP Response
     */
    #[Route(name: 'movement_index', methods: 'GET')]
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
     */
    #[Route(
        '/{id}',
        name: 'movement_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET'
    )]
    public function show(Movement $movement): Response
    {
        return $this->render(
            'movement/show.html.twig',
            ['movement' => $movement]
        );
    }
}
