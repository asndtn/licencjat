<?php
/**
 * Artist controller.
 */

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtworkRepository;
use App\Service\ArtistServiceInterface;
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
 * Class ArtistController.
 *
 * @Route("/artist")
 */
class ArtistController extends AbstractController
{
    /**
     * Artist service.
     */
    private ArtistServiceInterface $artistService;

    /**
     * Translator.
     */
    private TranslatorInterface $translator;

    /**
     * Constructor.
     *
     * @param ArtistServiceInterface $artistService Artist service
     * @param TranslatorInterface    $translator    Translator
     */
    public function __construct(ArtistServiceInterface $artistService, TranslatorInterface $translator)
    {
        $this->artistService = $artistService;
        $this->translator = $translator;
    }

    /**
     * Index action.
     *
     * @param Request $request User request
     *
     * @return Response HTTP Response
     *
     * @Route("/", name="artist_index", methods={"GET"})
     */
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
     * @return Response HTTP Response]
     *
     * @Route("/{id}", name="artist_show", requirements={"id": "[1-9]\d*"}, methods={"GET"})
     */
    public function show(Artist $artist, ArtworkRepository $artworkRepository): Response
    {
        return $this->render(
            'artist/show.html.twig',
            [
                'artist' => $artist,
                'artwork' => $artworkRepository->findBy(['id' => $artist->getId()])
            ]
        );
    }

    /**
     * Create action.
     *
     * @param Request $request HTTP request
     *
     * @return Response HTTP response
     *
     * @Route("/create", name="artist_create", methods={"GET|POST"})
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function create(Request $request, FileUploader $fileUploader): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photoFile = $form->get('photo')->getData();
            if ($photoFile) {
                $photoFilename = $fileUploader->upload($photoFile);
                $artist->setPhotoFilename($photoFilename);
            }
            $this->artistService->save($artist);
            $this->addFlash(
                'success',
                $this->translator->trans('message.created_successfully')
            );

            return $this->redirectToRoute('artist_show', ['id' => $artist->getId()]);
        }

        return $this->render(
            'artist/create.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Edit action.
     *
     * @param Request $request HTTP request
     * @param Artist  $artist  Artist entity
     *
     * @return Response HTTP response
     *
     * @Route("/{id}/edit", name="artist_edit", requirements={"id": "[1-9]\d*"}, methods={"GET|PUT"})
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Artist $artist, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(ArtistType::class, $artist, [
            'method' => 'PUT',
                'action' => $this->generateUrl('artist_edit', ['id' => $artist->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photoFilename = $form->get('photo')->getData();
            if ($photoFilename) {
                $photoFilename = $fileUploader->upload($photoFilename);
                $artist->setPhotoFilename($photoFilename);
            }
            $this->artistService->save($artist);

            $this->addFlash(
                'success',
                $this->translator->trans('message.edited_successfully')
            );

            return $this->redirectToRoute('artist_show', ['id' => $artist->getId()]);
        }

        return $this->render(
            'artist/edit.html.twig',
            [
                'form' => $form->createView(),
                'artist' => $artist,
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param Request $request HTTP Request
     * @param Artist  $artist  Artist entity
     *
     * @return Response HTTP Response
     *
     * @Route("/{id}/delete", name="artist_delete", requirements={"id": "[1-9]\d*"}, methods={"GET", "DELETE"})
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Artist $artist): Response
    {
        if (!$this->artistService->canBeDeleted($artist)) {
            $this->addFlash(
                'warning',
                $this->translator->trans('message.contains_inputs')
            );

            return $this->redirectToRoute('artist_index');
        }

        $form = $this->createForm(FormType::class, $artist, [
            'method' => 'DELETE',
            'action' => $this->generateUrl('artist_delete', ['id' => $artist->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->artistService->delete($artist);

            $this->addFlash(
                'success',
                $this->translator->trans('message.deleted_successfully')
            );

            return $this->redirectToRoute('artist_index');
        }

        return $this->render(
            'artist/delete.html.twig',
            [
                'form' => $form->createView(),
                'artist' => $artist,
            ]
        );
    }
}
