<?php

namespace App\Controller\Dashboard;

use App\Entity\Activity\Media;
use App\Form\Activity\MediaType;
use App\Repository\Activity\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class MediaController extends AbstractController
{
    /**
     * @Route("/", name="media.index", methods={"GET"})
     */
    public function index(MediaRepository $mediaRepository): Response
    {
        return $this->render('dashboard/media/index.html.twig', [
            'medias' => $mediaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/media/new", name="media.new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $media = new Media();
        $form = $this->createForm(MediaType::class, $media);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($media);
            $entityManager->flush();

            return $this->redirectToRoute('media.index');
        }

        return $this->render('dashboard/media/new.html.twig', [
            'media' => $media,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/media/{id}", name="media.show", methods={"GET"})
     */
    public function show(Media $media): Response
    {
        return $this->render('dashboard/media/show.html.twig', [
            'media' => $media,
        ]);
    }

    /**
     * @Route("/media/{id}/edit", name="media.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Media $media): Response
    {
        $form = $this->createForm(MediaType::class, $media);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $media->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('media.index');
        }

        return $this->render('dashboard/media/edit.html.twig', [
            'media' => $media,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/media/{id}", name="media.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Media $media): Response
    {
        if ($this->isCsrfTokenValid('delete'.$media->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($media);
            $entityManager->flush();
        }

        return $this->redirectToRoute('media.index');
    }
}
