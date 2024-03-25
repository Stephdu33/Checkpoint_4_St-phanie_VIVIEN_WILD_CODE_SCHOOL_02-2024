<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/includes', name: 'download_cv', methods: ['GET', 'POST'])]
class CVController extends AbstractController
{

    public function index(): Response
    {
        $cvFilePath = $this->getParameter('kernel.project_dir') . '/../public/downloads/mon_cv_dev.pdf';
        return new BinaryFileResponse($cvFilePath);;
    }
}
