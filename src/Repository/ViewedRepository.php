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

    //Count views with video_id set as parameter
    public function findView(int $videoId): array
    {
        return $this->createQueryBuilder('viewed')
            ->select('COUNT(viewed.id)')
            ->andWhere('viewed.video = :id')
            ->setParameter('id', $videoId)
            ->getQuery()
            ->getResult();
    }

    //get the number of view for all videos ordered desc (no parameter)
    public function findAllViews(): array
    {
        return $this->createQueryBuilder('viewed')
            ->select('video.id, COUNT(viewed.id) as viewCount')
            ->leftJoin('viewed.video', 'video')
            ->groupBy('video.id')
            ->orderBy('viewCount', 'DESC')
            ->getQuery()
            ->getResult();
    }

    //get the x most viewed videos (x set as parameter)
    public function findMostViewed(int $limit): array
    {
        return $this->createQueryBuilder('viewed')
            ->select('video.id, COUNT(viewed.id) as viewCount')
            ->leftJoin('viewed.video', 'video')
            ->groupBy('video.id')
            ->orderBy('viewCount', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    //get unique videos viewed by a user, sorted antichronologically (user_id as parameter)
    public function findVideosViewedByUser(int $userId): array
    {
        $queryBuilder = $this->createQueryBuilder('viewed')
            ->select('video.id')
            ->join('viewed.video', 'video')
            ->andWhere('viewed.user = :userId')
            ->setParameter('userId', $userId)
            ->groupBy('video.id')
            ->orderBy('MAX(viewed.viewDate)', 'DESC');

        return $queryBuilder->getQuery()->getResult();
    }
}
