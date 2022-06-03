<?php
/**
 * Field controller.
 */

namespace App\Controller;

use App\Entity\Field;
use App\Repository\FieldRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FieldController.
 */
#[Route('/field')]
class FieldController extends AbstractController
{
    /**
     * Index action.
     *
     * @param Request $request User request
     * @param FieldRepository $fieldRepository Field Repository
     * @param PaginatorInterface $paginator Paginator
     *
     * @return Response HTTP Response
     */
    #[Route(name: 'field_index', methods: 'GET')]
    public function index(Request $request, FieldRepository $fieldRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $fieldRepository->queryAll(),
            $request->query->getInt('page', 1),
            FieldRepository::PAGINATOR_ITEMS_PER_PAGE
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
}
