<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Redscorpio4Controller extends AbstractController
{
    #[Route('/redscorpio4', name: 'redscorpio4')]
    public function index(): Response
    {
        return $this->render('redscorpio4/index.html.twig', [
            'controller_name' => 'Redscorpio4Controller',
        ]);
    }

    /**
     * @Route ("/", name="name")
     */

     public function home() {
         return $this->render('redscorpio4/home.html.twig');
     }
}
