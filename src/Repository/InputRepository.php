<?php
/**
 * Input Repository.
 */

namespace App\Repository;

use App\Entity\Input;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
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
     * Query all records.
     *
     * @return QueryBuilder Query builder
     */
    public function queryAll(): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder()
            ->select(
                'partial input.{id, title}',
                'partial artist.{id, name}'
            )
            ->join('input.artist', 'artist')
            ->orderBy('input.id', 'ASC');
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
}
