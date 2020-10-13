<?php

namespace App\Controller\Mailer;

use App\Entity\Mailer\University;
use App\Form\Mailer\UniversityType;
use App\Repository\Mailer\UniversityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/university")
 */
class UniversityController extends AbstractController
{
    /**
     * @Route("/index", name="university.index")
     */
    public function index(Request $request, UniversityRepository $repository)
    {
        $university = new University();
        $form = $this->createForm(UniversityType::class, $university);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($university);
            $manager->flush();

            return $this->redirectToRoute("university.index");
        }
        return $this->render('dashboard/university/index.html.twig', [
            'universities'    =>  $repository->findAll(),
            'university'      =>  $university,
            'form'          =>  $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="university.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, University $university)
    {
        $form = $this->createForm(UniversityType::class, $university);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("university.index");
        }

        return $this->render('dashboard/university/edit.html.twig', [
            'university'      =>  $university,
            'form'          =>  $form->createView(),
        ]);
    }
}
