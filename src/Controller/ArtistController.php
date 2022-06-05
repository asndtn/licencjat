<?php
/**
 * Artist controller.
 */

namespace App\Controller;

use App\Entity\Artist;
use App\Service\ArtistServiceInterface;
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
     * Artist service.
     */
    private ArtistServiceInterface $artistService;

    /**
     * Constructor.
     */
    public function __construct(ArtistServiceInterface $artistService)
    {
        $this->artistService = $artistService;
    }

    /**
     * Index action.
     *
     * @param Request $request User request
     *
     * @return Response HTTP Response
     */
    #[Route(name: 'artist_index', methods: 'GET')]
    public function index(Request $request): Response
    {
        $pagination = $this->artistService->getPaginatedList(
            $request->query->getInt('page', 1)
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
