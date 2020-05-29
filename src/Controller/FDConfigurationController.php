<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FDConfigurationController extends AbstractController
{
    /**
     * @Route("/f/d/configuration", name="f_d_configuration")
     */
    public function index()
    {
        return $this->render('fd_configuration/index.html.twig', [
            'controller_name' => 'FDConfigurationController',
        ]);
    }
}
