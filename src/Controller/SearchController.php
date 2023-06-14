<?php

namespace App\Controller;

use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/search', name: 'search_')]
class SearchController extends AbstractController
{
    #[Route('/{name}', name: 'index')]
    public function index(
        Tag $tag,
    ): Response {
        return $this->render('search/index.html.twig', [
            'tag' => $tag,
        ]);
    }
}
