<?php
/**
 * Tag service.
 */

namespace App\Service;

use App\Entity\Tag;
use App\Repository\ArtistRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class TagService.
 */
class TagService implements TagServiceInterface
{
    /**
     * Tag repository.
     */
    private TagRepository $tagRepository;

    /**
     * ArtistRepository.
     */
    private ArtistRepository $artistRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param TagRepository      $tagRepository Tag repository
     * @param PaginatorInterface $paginator     Paginator
     */
    public function __construct(TagRepository $tagRepository, PaginatorInterface $paginator)
    {
        $this->tagRepository = $tagRepository;
        $this->paginator = $paginator;
    }

    /**
     * Get paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->tagRepository->queryAll(),
            $page,
            TagRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Find by name.
     *
     * @param string $name Tag name
     *
     * @return Tag|null Tag entity
     */
    public function findOneByName(string $name): ?Tag
    {
        return $this->tagRepository->findOneByName($name);
    }

    /**
     * Can Tag be deleted?
     *
     * @param Tag $tag Tag entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Tag $tag): bool
    {
        try {
            $result = $this->artistRepository->countByTag($tag);

            return !($result > 0);
        } catch (NoResultException|NonUniqueResultException) {
            return false;
        }
    }

    /**
     * Save entity.
     *
     * @param Tag $tag Tag entity
     */
    public function save(Tag $tag): void
    {
        $this->tagRepository->save($tag);
    }

    /**
     * Delete entity.
     *
     * @param Tag $tag Tag entity
     */
    public function delete(Tag $tag): void
    {
        $this->tagRepository->delete($tag);
    }
}
