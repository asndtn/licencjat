<?php
/**
 * Field controller.
 */

namespace App\Controller;

use App\Entity\Field;
use App\Service\FieldServiceInterface;
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
     * Field service.
     */
    private FieldServiceInterface $fieldService;

    /**
     * Constructor.
     */
    public function __construct(FieldServiceInterface $fieldService)
    {
        $this->fieldService = $fieldService;
    }

    /**
     * Index action.
     *
     * @param Request $request User request
     *
     * @return Response HTTP Response
     */
    #[Route(name: 'field_index', methods: 'GET')]
    public function index(Request $request): Response
    {
        $pagination = $this->fieldService->getPaginatedList(
            $request->query->getInt('page', 1)
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
