<?php
/**
 * Movement controller.
 */

namespace App\Controller;

use App\Entity\Movement;
use App\Repository\MovementRepository;
use Knp\Component\Pager\PaginatorInterface;
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
     * @param Request            $request            User request
     * @param MovementRepository $movementRepository Movement Repository
     * @param PaginatorInterface $paginator          Paginator
     *
     * @return Response HTTP Response
     */
    #[Route(name: 'movement_index', methods: 'GET')]
    public function index(Request $request, MovementRepository $movementRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $movementRepository->queryAll(),
            $request->query->getInt('page', 1),
            MovementRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render('movement/index.html.twig', ['pagination' => $pagination]);
    }

    /**
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
