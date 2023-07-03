<?php

namespace App\Repository;

use App\Entity\Video;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Video>
 *
 * @method Video|null find($id, $lockMode = null, $lockVersion = null)
 * @method Video|null findOneBy(array $criteria, array $orderBy = null)
 * @method Video[]    findAll()
 * @method Video[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Video::class);
    }

    public function save(Video $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Video $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findLatestVideos(): array
    {
        $now = new DateTimeImmutable();

        return $this->createQueryBuilder('v')
            ->orderBy('v.postDate', 'DESC')
            ->setMaxResults(15)
            ->where('v.postDate < :today')
            ->setParameter('today', $now, Types::DATETIME_IMMUTABLE)
            ->getQuery()
            ->getResult();
    }

    public function findVideosBySearch(string $keyword): array
    {
        $now = new DateTimeImmutable();

        return $this->createQueryBuilder('v')
            ->orderBy('v.title', 'ASC')
            ->where('v.title LIKE :keyword')
            ->andWhere('v.postDate < :today')
            ->setParameter('today', $now, Types::DATETIME_IMMUTABLE)
            ->setParameter('keyword', '%' . $keyword . '%')
            ->getQuery()
            ->getResult()
        ;
    }
}
