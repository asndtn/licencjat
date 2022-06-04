<?php
/**
 * Artist controller.
 */

namespace App\Controller;

use App\Entity\Artist;
use App\Repository\ArtistRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArtistController.
 */
#[Route('/artist')]
class ArtistController extends AbstractController
{
    /**
     * Index action.
     *
     * @param Request $request User request
     * @param ArtistRepository $artistRepository Artist repository
     * @param PaginatorInterface $paginator
     *
     * @return Response HTTP Response
     */
    #[Route(name: 'artist_index', methods: 'GET')]
    public function index(Request $request, ArtistRepository $artistRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $artistRepository->queryAll(),
            $request->query->getInt('page', 1),
            ArtistRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render('artist/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param Artist $artist Artist entity
     *
     * @return Response HTTP Response
     */
    #[Route(
        '/{id}',
        name: 'artist_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET'
    )]
    public function show(Artist $artist): Response
    {
        return $this->render(
            'artist/show.html.twig',
            ['artist' => $artist]
        );
    }
}
