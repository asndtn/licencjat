<?php
/**
 * Input controller.
 */

namespace App\Controller;

use App\Entity\Input;
use App\Entity\User;
use App\Form\InputType;
use App\Service\FileUploader;
use App\Service\InputServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * Class InputController.
 *
 * @Route("/input")
 */
class InputController extends AbstractController
{
    /**
     * Input service.
     */
    private InputServiceInterface $inputService;

    /**
     * Translator.
     */
    private TranslatorInterface $translator;

    /**
     * Constructor.
     *
     * @param InputServiceInterface $inputService Input service
     * @param TranslatorInterface   $translator   Translator
     */
    public function __construct(InputServiceInterface $inputService, TranslatorInterface $translator)
    {
        $this->inputService = $inputService;
        $this->translator = $translator;
    }

    /**
     * Index action.
     *
     * @param Request $request User request
     *
     * @return Response HTTP Response
     *
     * @Route("/", name="input_index", methods={"GET"})]
     */
    public function index(Request $request): Response
    {
        $filters = $this->getFilters($request);
        $pagination = $this->inputService->getPaginatedList(
            $request->query->getInt('page', 1),
            $filters
        );

//        foreach ($pagination as $input) {
//            $description = $input->getDescription();
//
//            $sentences = explode(".", $description);
//            $teaser = $sentences[0];
//        }
//
//        dd($description);
        return $this->render('input/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show only user's inputs action.
     *
     * @param Request $request User request
     *
     * @return Response HTTP Response
     *
     * @Route("/my_inputs", name="my_inputs", methods={"GET"})
     */
    public function userInputs(Request $request): Response
    {
        $pagination = $this->inputService->getAuthorList(
            $request->query->getInt('page', 1),
            $this->getUser()
        );

        return $this->render('input/my_inputs.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param Input $input Input entity
     *
     * @return Response HTTP Response
     *
     * @Route("/{id}", name="input_show", requirements={"id": "[1-9]\d*"}, methods={"GET"})
     */
    public function show(Input $input): Response
    {
        return $this->render(
            'input/show.html.twig',
            ['input' => $input]
        );
    }

    /**
     * Create action.
     *
     * @param Request      $request      HTTP request
     * @param FileUploader $fileUploader File uploader
     *
     * @return Response HTTP response
     *
     * @Route("/create", name="input_create", methods={"GET", "POST"})
     */
    public function create(Request $request, FileUploader $fileUploader): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $input = new Input();
        $input->setAuthor($user);
        $form = $this->createForm(
            InputType::class,
            $input,
            ['action' => $this->generateUrl('input_create')]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paintingFile = $form->get('painting')->getData();
            if ($paintingFile) {
                $paintingFilename = $fileUploader->upload($paintingFile);
                $input->setPaintingFilename($paintingFilename);
            }

            $this->inputService->save($input);

            $this->addFlash(
                'success',
                $this->translator->trans('message.created_successfully')
            );

            return $this->redirectToRoute('input_index');
        }

        return $this->render(
            'input/create.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Edit action.
     *
     * @param Request $request HTTP request
     * @param Input   $input   Input entity
     *
     * @return Response HTTP response
     *
     * @Route("/{id}/edit", name="input_edit", requirements={"id": "[1-9]\d*"}, methods={"GET|PUT"})
     *
     * @IsGranted("EDIT", subject="input")
     */
    public function edit(Request $request, Input $input): Response
    {
        $form = $this->createForm(InputType::class, $input, [
            'method' => 'PUT',
                'action' => $this->generateUrl('input_edit', ['id' => $input->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->inputService->save($input);

            $this->addFlash(
                'success',
                $this->translator->trans('message.edited_successfully')
            );

            return $this->redirectToRoute('input_index');
        }

        return $this->render(
            'input/edit.html.twig',
            [
                'form' => $form->createView(),
                'input' => $input,
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param Request $request HTTP Request
     * @param Input   $input   Input entity
     *
     * @return Response HTTP Response
     *
     * @Route("/{id}/delete", name="input_delete", requirements={"id": "[1-9]\d*"}, methods={"GET|DELETE"})
     *
     * @IsGranted("DELETE", subject="input")
     */
    public function delete(Request $request, Input $input): Response
    {
        $form = $this->createForm(FormType::class, $input, [
            'method' => 'DELETE',
            'action' => $this->generateUrl('input_delete', ['id' => $input->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->inputService->delete($input);

            $this->addFlash(
                'success',
                $this->translator->trans('message.deleted_successfully')
            );

            return $this->redirectToRoute('input_index');
        }

        return $this->render(
            'input/delete.html.twig',
            [
                'form' => $form->createView(),
                'input' => $input,
            ]
        );
    }

    /**
     * Get filters from request.
     *
     * @param Request $request HTTP request
     *
     * @return array<string, int> Array of filters
     *
     * @psalm-return array{category_id: int, status_id: int}
     */
    private function getFilters(Request $request): array
    {
        $filters = [];
        $filters['category_id'] = $request->query->getInt('filters_category_id');

        return $filters;
    }
}
