<?php

namespace App\Twig\Components;

use App\Repository\TagRepository;
use App\Repository\VideoRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent()]
final class VideoGalleryComponent
{
    public ?string $title = null;
    public int $count;
    public string $id;
    public ?string $source = null;

    public ?int $videoPlayedId = null;
    // public ?array $videoQuery = null;

    private TagRepository $tagRepository;
    private VideoRepository $videoRepository;

    public string $subtitle;
    private Collection $tags;
    private string $mainTag;
    private array $videos;

    public function __construct(
        VideoRepository $videoRepository,
        TagRepository $tagRepository,
        )
    {
        $this->tagRepository = $tagRepository;
        $this->videoRepository = $videoRepository;
    }

    public function mount(
        ?int $videoPlayedId = null,
        string $source = null
        )
    {
        $this->source = $source;

        switch ($source) {
            case 'videoId':
            $video = $this->videoRepository->findOneBy(['id' => $videoPlayedId]);
            $tagCollection = $video->getTag();
            $firstTag = $tagCollection[0]->getName();
            $videoCollection = $this->tagRepository->findOneBy(['name' => $firstTag])->getVideos();
            break;

        case 'latest':
            $this->title = 'Les videos les plus récentes';
            $videoCollection = $this->videoRepository->findLatestVideos();
            $tagCollection = $videoCollection[0]->getTag();
            $firstTag = $tagCollection[0]->getName();
            break;

        case 'mostViewed':
            $videoCollection = $this->videoRepository->findLatestVideos();
            $tagCollection = $videoCollection[0]->getTag();
            $firstTag = $tagCollection[0]->getName();
            break;

            default:
            $videoCollection = $this->videoRepository->findAll();
            $tagCollection = $videoCollection[0]->getTag();
            $firstTag = $tagCollection[0]->getName();
            break;
        }

        $this->subtitle = count($videoCollection) . ' videos';
        $this->tags = $tagCollection;
        $this->mainTag = $firstTag;
        $this->videos = $videoCollection;
    }

    public function getMainTag(): string
    {
        return $this->mainTag;
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function getVideos(): array
    {
        return $this->videos;
    }

    public function getSubtitle(): string
    {
        return $this->subtitle;
    }
}
