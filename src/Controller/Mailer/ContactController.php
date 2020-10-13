<?php

namespace App\Controller\Mailer;

use App\Entity\Mailer\Contact;
use ContactType;
//use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/aseet/contact", name="aseet.contact")
     */
    public function index(Request $request, MailerInterface $mailer)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new Email())
                ->from($contact->getEmail())
                ->to("test@aseet.com")
                ->subject('Objet du message')
                ->text($contact->getMessage())
                ->html('<p>' . $contact->getMessage() . '</p>');
            $mailer->send($email);
        }
        
        return $this->render('mailer/contact/contact.html.twig', [
            'contact' => $contact,
            'form'    => $form->createView(),
        ]);
    }

}
