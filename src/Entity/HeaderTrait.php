<?php

namespace App\Entity;

use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;

trait HeaderTrait
{
    private array $headerUpdate = [];

    #[ORM\PreUpdate]
    public function preUpdate(PreUpdateEventArgs $eventArgs): void
    {
        $entity = $eventArgs->getObject();

        if ($entity->isIsHeader() === true) {
            $entityManager = $eventArgs->getObjectManager();
            $videoRepository = $entityManager->getRepository(Video::class);

            $videos = $videoRepository->findBy(['isHeader' => true]);

            foreach ($videos as $video) {
                if ($video !== $entity) {
                    $video->setIsHeader(false);
                    $this->headerUpdate[] = $video;
                }
            }
        }
    }

    #[ORM\PostUpdate]
    public function postUpdate(PostUpdateEventArgs $eventArgs): void
    {
        $entityManager = $eventArgs->getObjectManager();

        foreach ($this->headerUpdate as $video) {
            $entityManager->persist($video);
        }

        $entityManager->flush();

        $this->headerUpdate = [];
    }
}
