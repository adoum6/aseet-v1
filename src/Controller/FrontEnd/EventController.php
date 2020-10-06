<?php

namespace App\Controller\FrontEnd;

use App\Repository\Activity\EventRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
}
