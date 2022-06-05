<?php
/**
 * Nationality controller.
 */

namespace App\Controller;

use App\Entity\Nationality;
use App\Service\NationalityServiceInterface;
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
     * Nationality service.
     */
    private NationalityServiceInterface $nationalityService;

    /**
     * Constructor.
     */
    public function __construct(NationalityServiceInterface $nationalityService)
    {
        $this->nationalityService = $nationalityService;
    }

    /**
     * Index action.
     *
     * @param Request $request User request
     *
     * @return Response HTTP Response
     */
    #[Route(name: 'nationality_index', methods: 'GET')]
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
