<?php

namespace App\Controller;

use App\Entity\BoiteEmail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RedScorpio4Controller extends AbstractController
{
    /**
     * @Route("/", name="redscorpio4")
     */

    public function sendEmail(BoiteEmail $contact = null,Request $request,EntityManagerInterface $manager, MailerInterface $mailer): Response
    {
        
        $contact = new BoiteEmail;
         
      
        $form = $this->createFormBuilder($contact)
                    ->add('Name', TextType::class, array('label' => false))
                    ->add('Mail', EmailType::class, array('label' => false)) 
                    ->add('Message', TextareaType::class, array('label' => false))
                    ->add('captcha', Recaptcha3Type::class, [
                      'constraints' => new Recaptcha3(),
                      'action_name' => 'contact',
                    ])
                    ->getForm();
                       
          $form->handleRequest($request);
          if($form->isSubmitted() && $form->isValid()){
            $this->addFlash('success', 'Your message has been sent !');
            $manager->persist($contact);
            $manager->flush();

            $email = (new TemplatedEmail())
            ->from($contact->getMail())
            ->to('alois.patoor@redscorpio4.com')    
            ->subject($contact->getName())    
            // path of the Twig template to render
            ->htmlTemplate('emails/contact.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'contact' => $contact,
                'username' => 'alois.patoor',
            ]);
           
            $mailer->send($email);
  
            return $this->redirectToRoute('redscorpio4');
          }
        return $this->render('redscorpio4/index.html.twig', [
            'formContact' =>$form->createView(),
            'controller_name' => 'Redscorpio4Controller',
        ]);
    }
    
}
