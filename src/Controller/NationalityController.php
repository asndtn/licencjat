<?php
/**
 * Nationality controller.
 */

namespace App\Controller;

use App\Entity\Nationality;
use App\Repository\NationalityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NationalityController.
 */
#[Route('/nationality')]
class NationalityController extends AbstractController
{
    /**
     * @param Request $request User request
     * @param NationalityRepository $nationalityRepository Nationality Repository
     * @param PaginatorInterface $paginator Paginator
     *
     * @return Response HTTP Response
     */
    #[Route(name: 'nationality_index', methods: 'GET')]
    public function index(Request $request, NationalityRepository $nationalityRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $nationalityRepository->queryAll(),
            $request->query->getInt('page', 1),
            NationalityRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render('nationality/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * @param Nationality $nationality Nationality entity
     *
     * @return Response HTTP Response
     */
    #[Route(
        '/{id}',
        name: 'nationality_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET'
    )]
    public function show(Nationality $nationality): Response
    {
        return $this->render(
            'nationality/show.html.twig',
            ['nationality' => $nationality]
        );
    }
}
