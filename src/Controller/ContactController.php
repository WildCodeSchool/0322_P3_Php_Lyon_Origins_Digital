<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact_index')]
    public function index(
        Request $request,
        ContactRepository $contactRepository
    ): Response {
        $user = $this->getUser();
        $contact = new Contact();

        if ($user) {
            $contact->setUser($user);
            $contact->setEmail($user->getEmail());
        }

        $contactForm = $this->createForm(ContactType::class, $contact);
        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $contactRepository->save($contact, true);
            $this->addFlash('secondary', 'Message bien envoyé !');
            return $this->redirect($request->getUri());
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $contactForm,
        ]);
    }
}
