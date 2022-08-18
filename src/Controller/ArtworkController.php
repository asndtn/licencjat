<?php
/**
 * Artwork controller.
 */

namespace App\Controller;

use App\Entity\Artwork;
use App\Form\ArtworkType;
use App\Repository\ArtworkRepository;
use App\Service\ArtworkServiceInterface;
use App\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use function Symfony\Component\Translation\t;

/**
 * Class ArtworkController.
 *
 * @Route("/artwork")
 */
class ArtworkController extends AbstractController
{
    /**
     * Artwork service.
     */
    private ArtworkServiceInterface $artworkService;

    /**
     * Translator.
     */
    private TranslatorInterface $translator;

    /**
     * Constructor.
     *
     * @param ArtworkServiceInterface $artworkService Artwork service
     * @param TranslatorInterface    $translator    Translator
     */
    public function __construct(ArtworkServiceInterface $artworkService, TranslatorInterface $translator)
    {
        $this->artworkService = $artworkService;
        $this->translator = $translator;
    }

    /**
     * Index action.
     *
     * @param Request $request User request
     *
     * @return Response HTTP Response
     *
     * @Route("/", name="artwork_index", methods={"GET"})
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(Request $request): Response
    {
        $pagination = $this->artworkService->getPaginatedList(
            $request->query->getInt('page', 1)
        );

        return $this->render('artwork/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param Artwork $artwork Artwork entity
     *
     * @return Response HTTP Response]
     *
     * @Route("/{id}", name="artwork_show", requirements={"id": "[1-9]\d*"}, methods={"GET"})
     */
    public function show(Artwork $artwork, ArtworkRepository $artworkRepository): Response
    {
        return $this->render(
            'artwork/show.html.twig',
            ['artwork' => $artwork]
        );
    }

    /**
     * Create action.
     *
     * @param Request $request HTTP request
     *
     * @return Response HTTP response
     *
     * @Route("/create", name="artwork_create", methods={"GET|POST"})
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function create(Request $request, FileUploader $fileUploader): Response
    {
        $artwork = new Artwork();
        $form = $this->createForm(ArtworkType::class, $artwork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artworkFile = $form->get('artwork')->getData();
            if ($artworkFile) {
                $artworkFilename = $fileUploader->upload($artworkFile);
                $artwork->setArtworkFilename($artworkFilename);
            }
            $this->artworkService->save($artwork);
            $this->addFlash(
                'success',
                $this->translator->trans('message.created_successfully')
            );

            return $this->redirectToRoute('artist_show', ['id' => $artwork->getId()]);
        }

        return $this->render(
            'artwork/create.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Edit action.
     *
     * @param Request $request HTTP request
     * @param Artwork  $artwork  Artwork entity
     *
     * @return Response HTTP response
     *
     * @Route("/{id}/edit", name="artwork_edit", requirements={"id": "[1-9]\d*"}, methods={"GET|PUT"})
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Artwork $artwork, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(ArtworkType::class, $artwork, [
            'method' => 'PUT',
                'action' => $this->generateUrl('artwork_edit', ['id' => $artwork->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artworkFilename = $form->get('artwork')->getData();
            if ($artworkFilename) {
                $artworkFilename = $fileUploader->upload($artworkFilename);
                $artwork->setArtworkFilename($artworkFilename);
            }
            $this->artworkService->save($artwork);

            $this->addFlash(
                'success',
                $this->translator->trans('message.edited_successfully')
            );

            return $this->redirectToRoute('artwork_show', ['id' => $artwork->getId()]);
        }

        return $this->render(
            'artwork/edit.html.twig',
            [
                'form' => $form->createView(),
                'artwork' => $artwork,
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param Request $request HTTP Request
     * @param Artwork  $artwork  Artwork entity
     *
     * @return Response HTTP Response
     *
     * @Route("/{id}/delete", name="artwork_delete", requirements={"id": "[1-9]\d*"}, methods={"GET", "DELETE"})
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Artwork $artwork): Response
    {
        $form = $this->createForm(FormType::class, $artwork, [
            'method' => 'DELETE',
            'action' => $this->generateUrl('artwork_delete', ['id' => $artwork->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->artworkService->delete($artwork);

            $this->addFlash(
                'success',
                $this->translator->trans('message.deleted_successfully')
            );

            return $this->redirectToRoute('artwork_index');
        }

        return $this->render(
            'artwork/delete.html.twig',
            [
                'form' => $form->createView(),
                'artwork' => $artwork,
            ]
        );
    }
}
