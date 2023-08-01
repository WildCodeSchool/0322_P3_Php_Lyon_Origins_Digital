<?php

namespace App\Twig\Components;

use App\Repository\TagRepository;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent()]
final class SmallVideoGalleryComponent
{
    public ?string $title = null;
    public ?string $source = null;
    public int $numberOfVideosToShow;

    private TagRepository $tagRepository;

    public string $galleryId;
    public string $subtitle;
    private array $videos;

    public function __construct(
        TagRepository $tagRepository
    ) {
        $this->tagRepository = $tagRepository;
    }

    public function mount(
        string $source = null,
    ): void {
        $this->source = $source;

        $this->mountVideosByTag($source);

        $this->galleryId = $source;
    }

    private function mountVideosByTag(string $tag): void
    {
        $this->title = null;
        $searchTag = $this->tagRepository->findOneBy(['name' => $tag]);
        $tagVideos = $searchTag->getVideos();

        $videoCollection = [];

        foreach ($tagVideos as $tagVideo) {
            $videoCollection[] = $tagVideo;
        }

        $this->updateVideoProperties($videoCollection);
    }

    private function updateVideoProperties(
        array $videoCollection,
    ): void {
        $this->subtitle = count($videoCollection) . ' videos';
        $this->videos = $videoCollection;
    }

    public function getVideos(): array
    {
        return $this->videos;
    }

    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    public function getGalleryId(): string
    {
        return $this->galleryId;
    }
}
