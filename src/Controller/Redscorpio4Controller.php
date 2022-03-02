<?php

namespace App\Controller;

use App\Entity\BoiteEmail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

class Redscorpio4Controller extends AbstractController
{
    #[Route('/', name: 'redscorpio4')]

    public function index(BoiteEmail $contact = null,Request $request,EntityManagerInterface $manager): Response
    {
        
        $contact = new BoiteEmail;
         
      
        $form = $this->createFormBuilder($contact)
                    ->add('Name', TextType::class, array('label' => false))
                    ->add('Mail', EmailType::class, array('label' => false)) 
                    ->add('Message', TextareaType::class, array('label' => false))  
                    ->getForm();
                       
          $form->handleRequest($request);
          if($form->isSubmitted() && $form->isValid()){
            
            $manager->persist($contact);
            $manager->flush();

            return $this->redirectToRoute('redscorpio4');
          }
        return $this->render('redscorpio4/index.html.twig', [
            'formContact' =>$form->createView(),
            'controller_name' => 'Redscorpio4Controller',
        ]);
    }
}
