<?php

namespace App\Controller\admin;

use App\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminAdController extends AbstractController
{
    /**
     * @Route("/admin/ads", name="admin_ads_index")
     */
    public function index(AdRepository $repos)
    {
        return $this->render('admin/ad/index.html.twig', [
            'ads' => $repos->findAll()
        ]);
    }
}
