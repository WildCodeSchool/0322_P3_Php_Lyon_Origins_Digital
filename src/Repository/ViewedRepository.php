<?php

namespace App\Repository;

use App\Entity\Viewed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Viewed>
 *
 * @method Viewed|null find($id, $lockMode = null, $lockVersion = null)
 * @method Viewed|null findOneBy(array $criteria, array $orderBy = null)
 * @method Viewed[]    findAll()
 * @method Viewed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ViewedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Viewed::class);
    }

    public function save(Viewed $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Viewed $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findView(int $videoId): array
    {
        return $this->createQueryBuilder('viewed')
            ->select('COUNT(viewed.id)')
            ->andWhere('viewed.video = :id')
            ->setParameter('id', $videoId)
            ->getQuery()
            ->getResult();
    }
}
