<?php

namespace App\EventListener;

use Oneup\UploaderBundle\Event\PostUploadEvent;
use Oneup\UploaderBundle\Uploader\Response\ResponseInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class UploadFormDropzoneListener
{
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }
    public function onUpload(PostUploadEvent $event): ResponseInterface
    {
        //if everything went fine
        $response = $event->getResponse();

        $fileName = $event->getFile()->getFilename();

        $session = $this->requestStack->getSession();
        $session->remove('fileName');
        $session->set('fileName', $fileName);

        $response['success'] = true;
        return $response;
    }
}
