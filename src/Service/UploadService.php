<?php

namespace App\Service;

use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Media\Video;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class UploadService
{
    public function __construct(private ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function extractThumbnail(string $fileName): string
    {
        //videoThumb part
        $ffmpeg = FFMpeg::create();
        /** @var Video $videoThumb */
        $videoThumb = $ffmpeg->open($this->params->get('temp_directory') . '/' . $fileName);
        $fileNameThumb = pathinfo($fileName, PATHINFO_FILENAME);
        $fileNameThumb = $fileNameThumb . '.jpg';
        $videoThumb
            ->frame(TimeCode::fromSeconds(20))
            ->save($this->params->get('image_directory') . '/' . $fileNameThumb);

        //videoGif part
        /** @var Video $videoGif */
        $videoGif = $ffmpeg->open($this->params->get('temp_directory') . '/' . $fileName);
        $fileNameGif = pathinfo($fileName, PATHINFO_FILENAME);
        $fileNameGif = $fileNameGif . '.gif';

        $videoGif
        ->gif(TimeCode::fromSeconds(20), new Dimension(280, 240), 4)
        ->save($this->params->get('image_directory') . '/' . $fileNameGif);

        return $fileNameThumb;
    }
}
