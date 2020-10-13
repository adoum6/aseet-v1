<?php

namespace App\Controller\Mailer;

use Symfony\Component\Mime\Email;
use App\Entity\Mailer\Preinscription;
use App\Form\Mailer\PreinscriptionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

class PreinscriptionController extends AbstractController
{
    /**
     * @Route("/aseet/preinscription", name="aseet.preinscription")
     */
    public function index(Request $request, MailerInterface $mailer)
    {
        $preinscription = new Preinscription();
        $form = $this->createForm(PreinscriptionType::class, $preinscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message = (new Email())
                ->from($preinscription->getEmail())
                ->to('aseet@test.com')
                ->subject('Pré-inscription')
                ->text('Mon petit message')
                ->html('<p> Mon petit message</p>')
            ;
            $mailer->send($message);
        }

        return $this->render('mailer/preinscription/index.html.twig', [
            'preinscription' => $preinscription,
            'form' => $form->createView(),
        ]);
    }
}
