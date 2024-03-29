<?php

namespace App\Controller\Dashboard;

use App\Entity\Activity\Event;
use App\Form\Activity\EventType;
use App\Repository\Activity\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/")
 */
class EventController extends AbstractController
{
    /**
     * @Route("event", name="event.index")
     */
    public function index(EventRepository $repository)
    {
        return $this->render('dashboard/event/index.html.twig', [
            'events' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("event/new", name="event.new", methods={"GET", "POST"})
     */
    public function new(Request $request)
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($event);
            $manager->flush();

            return $this->redirectToRoute("event.index");
        }

        return $this->render('dashboard/event/new.html.twig', [
            'event' =>  $event,
            'form'  =>  $form->createView(),
        ]);
    }

    /**
     * @Route("event/{id}/edit", name="event.edit", methods="GET|POST")
     */
    public function edit(Request $request, Event $event)
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event.index');
        }

        return $this->render('dashboard/event/edit.html.twig', [
           'event'  =>  $event,
           'form'   =>  $form->createView(),
        ]);
    }

    /**
     * @Route("event/{id}/show", name="event.show", methods="GET")
     */
    public function show(Event $event)
    {
        return $this->render('dashboard/event/show.html.twig', [
            'event'  =>  $event,
        ]);
    }

}
