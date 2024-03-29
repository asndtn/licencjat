<?php
/**
 * Nationality Repository.
 */

namespace App\Repository;

use App\Entity\Nationality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class NationalityRepository.
 *
 * @method Nationality|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nationality|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nationality[]    findAll()
 * @method Nationality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @extends ServiceEntityRepository<Nationality>
 */
class NationalityRepository extends ServiceEntityRepository
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
        parent::__construct($registry, Nationality::class);
    }

    /**
     * Query all records.
     *
     * @return QueryBuilder Query builder
     */
    public function queryAll(): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder()
            ->select('partial nationality.{id, name}')
            ->orderBy('nationality.name', 'ASC');
    }

    /**
     * Save entity.
     *
     * @param Nationality $nationality Nationality entity
     */
    public function save(Nationality $nationality): void
    {
        $this->_em->persist($nationality);
        $this->_em->flush();
    }

    /**
     * Delete entity.
     *
     * @param Nationality $nationality Nationality entity
     */
    public function delete(Nationality $nationality): void
    {
        $this->_em->remove($nationality);
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
        return $queryBuilder ?? $this->createQueryBuilder('nationality');
    }
}
