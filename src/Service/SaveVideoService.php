<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SaveVideoService extends AbstractController
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
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
        $source = $this->getParameter('temp_directory') . '/' . $fileName;
        $destination = $this->getParameter('video_directory') . '/' . $fileName;
        rename($source, $destination);
    }
}
