<?php

namespace App\Service;

use FFMpeg\FFMpeg;
use FFMpeg\Media\Video;
use FFMpeg\Coordinate\TimeCode;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class UploadService
{
    public function __construct(private ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function extractThumbnail(string $fileName): string
    {

        $ffmpeg = FFMpeg::create();
        /** @var Video $videoThumb */
        $videoThumb = $ffmpeg->open($this->params->get('temp_directory') . '/' . $fileName);
        $fileNameThumb = pathinfo($fileName, PATHINFO_FILENAME);
        $fileNameThumb = $fileNameThumb . '.jpg';
        $videoThumb
            ->frame(TimeCode::fromSeconds(40))
            ->save($this->params->get('image_directory') . '/' . $fileNameThumb);

        return $fileNameThumb;
    }
}
