<?php

namespace App\Controller\Mailer;

use App\Entity\Mailer\Demande;
use App\Form\Mailer\DemandeType;
use App\Repository\Mailer\DemandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

use Symfony\Component\Routing\Annotation\Route;

class DemandeController extends AbstractController
{
    private $mailer;
    private $demande;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        $this->demande = new Demande();
    }

    /**
     * @Route("/aseet/demande-carte", name="aseet.carte")
     */
    public function forAseet(Request $request) 
    {
        $form = $this->createForm(DemandeType::class, $this->demande);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->manageMailer("aseet@test.com", $this->demande);
            //return $this->redirectToRoute('aseet.home');
        }

        return $this->render('mailer/demande/carte_aseet.html.twig', [
            'demande' => $this->demande,
            'form'    => $form->createView(),
        ]);
    }

    /**
     * @Route("/aseet/demande-carte-consulaire", name="aseet.carte-consulaire")
     */
    public function forConsul(Request $request)
    {
        $form = $this->createForm(DemandeType::class, $this->demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manageMailer("consul@test.com", $this->demande);
            // return $this->redirectToRoute('aseet.home');
        }

        return $this->render('mailer/demande/carte_consulaire.html.twig', [
            'demande' => $this->demande,
            'form'    => $form->createView(),
        ]);
    }

    /**
     * Cette methode appelle d'abord la method add pour stocker les informations dans la DB avant de gérer l'envoie des emails
     *
     * @param string $sendTo
     * @param Demande $demande
     * @return void
     */
    private function manageMailer(string $sendTo, Demande $demande)
    {
        $this->add($demande);
        $message = (new Email())
            ->from($demande->getEmail())
            ->to($sendTo)
            ->subject('Demande de Carte numero ')
            ->text('Mon petit message')
            ->html('<p> Mon petit message</p>')
        ;
        $this->mailer->send($message);
        $this->addFlash("Votre demande a bien été envoyé, nous vous revennons", 'success');
    }

    /**
     * Stock les données dans la base
     *
     * @param Demande $demande
     * @return void
     */
    private function add(Demande $demande)
    {
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($demande);
        $manager->flush();

    }

}
