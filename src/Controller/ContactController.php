<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contact', name: 'app_')]
class ContactController extends AbstractController
{
    #[Route('/', name: 'contact', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Ton message a été enregistré'
            );

            return $this->redirectToRoute('app_contact', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contact/_form_contact.html.twig', [
            'form' => $form,
            'contact' => $contact,
        ]);
    }
}
