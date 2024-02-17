<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/image', name: 'app_admin_image_')]
class ImageController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ImageRepository $imageRepository): Response
    {
        return $this->render('admin/image/index.html.twig', [
            'images' => $imageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $image = new Image();
        $formImage = $this->createForm(ImageType::class, $image);
        $formImage->handleRequest($request);

        if ($formImage->isSubmitted() && $formImage->isValid()) {
            $entityManager->persist($image);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Ta nouvelle photo a été enregistrée'
            );
            return $this->redirectToRoute('app_admin_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/image/new.html.twig', [
            'image' => $image,
            'formImage' => $formImage,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Image $image, EntityManagerInterface $entityManager): Response
    {
        $formImage = $this->createForm(ImageType::class, $image);
        $formImage->handleRequest($request);

        if ($formImage->isSubmitted() && $formImage->isValid()) {
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Ta photo a été mise à jour'
            );
            return $this->redirectToRoute('app_admin_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/image/edit.html.twig', [
            'image' => $image,
            'formImage' => $formImage,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Image $image, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($image);
        $entityManager->flush();
        $this->addFlash(
            'notice',
            'Cette image a bien été supprimée'
        );

        return $this->redirectToRoute('app_admin_image_index', [], Response::HTTP_SEE_OTHER);
    }
}
