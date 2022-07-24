<?php
/**
 * Input service.
 */

namespace App\Service;

use App\Entity\Input;
use App\Entity\User;
use App\Repository\InputRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class InputService.
 */
class InputService implements InputServiceInterface
{
    /**
     * Input repository.
     */
    private InputRepository $inputRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Category Service.
     */
    private CategoryServiceInterface $categoryService;

    /**
     * Constructor.
     *
     * @param InputRepository          $inputRepository Input repository
     * @param PaginatorInterface       $paginator       Paginator
     * @param CategoryServiceInterface $categoryService Category service
     */
    public function __construct(InputRepository $inputRepository, PaginatorInterface $paginator, CategoryServiceInterface $categoryService)
    {
        $this->inputRepository = $inputRepository;
        $this->paginator = $paginator;
        $this->categoryService = $categoryService;
    }

    /**
     * Get paginated list.
     *
     * @param int   $page    Page number
     * @param array $filters Filters array
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page, array $filters = [], string $search = null): PaginationInterface
    {
        $filters = $this->prepareFilters($filters);

        return $this->paginator->paginate(
            $this->inputRepository->queryAll($filters, $search),
            $page,
            InputRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Filter by author.
     *
     * @param int  $page   Page number
     * @param User $author Author
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getAuthorList(int $page, User $author): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->inputRepository->queryByAuthor($author),
            $page,
            InputRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Save entity.
     *
     * @param Input $input Input entity
     */
    public function save(Input $input): void
    {
        $this->inputRepository->save($input);
    }

    /**
     * Delete entity.
     *
     * @param Input $input Input entity
     */
    public function delete(Input $input): void
    {
        $this->inputRepository->delete($input);
    }

    /**
     * Prepare filters for the inputs list.
     *
     * @param array<string, int> $filters Raw filters from request
     *
     * @return array<string, object> Result array of filters
     */
    public function prepareFilters(array $filters): array
    {
        $resultFilters = [];
        if (!empty($filters['category_id'])) {
            $category = $this->categoryService->findOneById($filters['category_id']);
            if (null !== $category) {
                $resultFilters['category'] = $category;
            }
        }

        return $resultFilters;
    }
}
