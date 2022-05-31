<?php
/**
 * Input controller.
 */

namespace App\Controller;

use App\Entity\Input;
use App\Repository\InputRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class InputController.
 */
#[Route('/input')]
class InputController extends AbstractController
{
    /**
     * Index action.
     *
     * @param InputRepository $inputRepository Input repository
     *
     * @return Response HTTP Response
     */
    #[Route(name: 'input_index', methods: 'GET')]
    public function index(Request $request, InputRepository $inputRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $inputRepository->queryAll(),
            $request->query->getInt('page', 1),
            InputRepository::PAGINATOR_ITEMS_PER_PAGE
        );

        return $this->render('input/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param Input $input Input entity
     *
     * @return Response HTTP Response
     */
    #[Route(
        '/{id}',
        name: 'input_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET'
    )]
    public function show(Input $input): Response
    {
        return $this->render(
            'input/show.html.twig',
            ['input' => $input]
        );
    }
}
