<?php
/**
 * Input Repository.
 */

namespace App\Repository;

use App\Entity\Artist;
use App\Entity\Category;
use App\Entity\Field;
use App\Entity\Input;
use App\Entity\Movement;
use App\Entity\Tag;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class InputRepository.
 *
 * @method Input|null find($id, $lockMode = null, $lockVersion = null)
 * @method Input|null findOneBy(array $criteria, array $orderBy = null)
 * @method Input[]    findAll()
 * @method Input[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @extends ServiceEntityRepository<Input>
 */
class InputRepository extends ServiceEntityRepository
{
    /**
     * Items per page.
     *
     * Use constants to define configuration options that rarely change instead
     * of specifying them in configuration files.
     * See https://symfony.com/doc/current/best_practices.html#configuration
     *
     * @constant int
     */
    public const PAGINATOR_ITEMS_PER_PAGE = 10;

    /**
     * Constructor.
     *
     * @param ManagerRegistry $registry Manager registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Input::class);
    }

    /**
     * Query by Author.
     *
     * @param User $user User entity
     *
     * @return QueryBuilder Query builder
     */
    public function queryByAuthor(User $user): QueryBuilder
    {
        $queryBuilder = $this->queryAll();

        $queryBuilder->andWhere('input.author = :author')
            ->setParameter('author', $user);

        return $queryBuilder;
    }

    /**
     * Query all records.
     *
     * @param array<string, object> $filters Filters
     *
     * @return QueryBuilder Query builder
     */
    public function queryAll(array $filters = [], string $search = null): QueryBuilder
    {
        $queryBuilder = $this->getOrCreateQueryBuilder()
            ->select(
                'partial input.{id, title, paintingFilename}',
                'partial category.{id, name}',
                'partial artist.{id, name, photoFilename}'
                // TODO: inne partial daj
            )
            ->join('input.artist', 'artist')
            ->join('input.category', 'category')
            ->orderBy('input.id', 'ASC');

        if ($search) {
            $queryBuilder->andWhere('input.title LIKE :searchTerm')
                ->setParameter('searchTerm', '%'.$search.'%');

            return $queryBuilder;
//                ->getQuery()
//                ->getResult();
        } else {
            return $this->applyFiltersToList($queryBuilder, $filters);
        }
    }

    /**
     * Apply filters to paginated list.
     *
     * @param QueryBuilder          $queryBuilder Query builder
     * @param array<string, object> $filters      Filters array
     *
     * @return QueryBuilder Query builder
     */
    private function applyFiltersToList(QueryBuilder $queryBuilder, array $filters = []): QueryBuilder
    {
        if (isset($filters['category']) && $filters['category'] instanceof Category) {
            $queryBuilder->andWhere('category = :category')
                ->setParameter('category', $filters['category']);
        }

        return $queryBuilder;
    }

    /**
     * Count inputs by category.
     *
     * @param Category $category Category
     *
     * @return int Number of inputs in category
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function countByCategory(Category $category): int
    {
        $qb = $this->getOrCreateQueryBuilder();

        return $qb->select($qb->expr()->countDistinct('input.id'))
            ->where('input.category = :category')
            ->setParameter(':category', $category)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Count inputs by field.
     *
     * @param Field $field Field
     *
     * @return int Number of inputs in field
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function countByField(Field $field): int
    {
        $qb = $this->getOrCreateQueryBuilder();

        return $qb->select($qb->expr()->countDistinct('input.id'))
            ->where('input.field = :field')
            ->setParameter(':field', $field)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Count inputs by movement.
     *
     * @param Movement $movement Movement
     *
     * @return int Number of inputs in movement
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function countByMovement(Movement $movement): int
    {
        $qb = $this->getOrCreateQueryBuilder();

        return $qb->select($qb->expr()->countDistinct('input.id'))
            ->where('input.movement = :movement')
            ->setParameter(':movement', $movement)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Count inputs by artist.
     *
     * @param Artist $artist Artist
     *
     * @return int Number of inputs in artist
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function countByArtist(Artist $artist): int
    {
        $qb = $this->getOrCreateQueryBuilder();

        return $qb->select($qb->expr()->countDistinct('input.id'))
            ->where('input.artist = :artist')
            ->setParameter(':artist', $artist)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * Count inputs by user.
     *
     * @param User $user User
     *
     * @return int Number of inputs in user
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function countByUser(User $user): int
    {
        $qb = $this->getOrCreateQueryBuilder();

        return $qb->select($qb->expr()->countDistinct('input.id'))
            ->where('input.author = :author')
            ->setParameter(':author', $user)
            ->getQuery()
            ->getSingleScalarResult();
    }

//    /**
//     * Count inputs by tag.
//     *
//     * @param Tag $tag Tag
//     *
//     * @return int Number of inputs in tag
//     *
//     * @throws NoResultException
//     * @throws NonUniqueResultException
//     */
////    public function countByTag(Tag $tag): int
////    {
////        $qb = $this->getOrCreateQueryBuilder();
////
////        return $qb->select($qb->expr()->countDistinct('input.id'))
////            ->where('input.tag = :tag')
////            ->setParameter(':tag', $tag)
////            ->getQuery()
////            ->getSingleScalarResult();
////    }

    /**
     * Save entity.
     *
     * @param Input $input Input entity
     */
    public function save(Input $input): void
    {
        $this->_em->persist($input);
        $this->_em->flush();
    }

    /**
     * Delete entity.
     *
     * @param Input $input Input entity
     */
    public function delete(Input $input): void
    {
        $this->_em->remove($input);
        $this->_em->flush();
    }

    /**
     * Get or create new query builder.
     *
     * @param QueryBuilder|null $queryBuilder Query builder
     *
     * @return QueryBuilder Query builder
     */
    private function getOrCreateQueryBuilder(QueryBuilder $queryBuilder = null): QueryBuilder
    {
        return $queryBuilder ?? $this->createQueryBuilder('input');
    }
}
