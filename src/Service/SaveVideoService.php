<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class SaveVideoService
{
    public function __construct(private RequestStack $requestStack, private ParameterBagInterface $params)
    {
        $this->requestStack = $requestStack;
        $this->params = $params;
    }

    public function deleteSessionFilename(): void
    {
        $session = $this->requestStack->getSession();
        $session->remove('fileName');
    }

    public function getVideoName(): string
    {
        $session = $this->requestStack->getSession();
        $fileName = '';
        if ($session->has('fileName')) {
            $fileName = $session->get('fileName');
        }
        self::deleteSessionFilename();
        return $fileName;
    }

    public function saveVideoFile(string $fileName): void
    {
        $source = $this->params->get('temp_directory') . '/' . $fileName;
        $destination = $this->params->get('video_directory') . '/' . $fileName;
        rename($source, $destination);
    }
}
