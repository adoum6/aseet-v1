<?php

namespace App\Controller\FrontEnd;

use App\Entity\Mailer\Contact;
use App\Repository\Activity\EventRepository;
use ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/aseet")
 */
class EventController extends AbstractController
{
    
    /**
     * @Route("/activites", name="events.list", methods="GET")
     */
    public function getAllActivities(EventRepository $repository)
    {
        return $this->render('frontend/activity/index.html.twig', [
            'events'  =>  $repository->findByEventDateDesc(),
        ]);
    }

    /**
     * @Route("/contact", name="aseet.contact")
     */
    public function contactUs(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return new Response("OK");
        }

        return $this->render('frontend/index.html.twig', [
            'contact'   =>  $contact,
            'form'      =>  $form->createView(),
        ]);

    }

}
