<?php

namespace App\Controller\Dashboard;

use App\Entity\Activity\Category;
use App\Form\Activity\CategoryType;
use App\Repository\Activity\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/category")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/index", name="category.index")
     */
    public function index(Request $request, CategoryRepository $repository)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($category);
            $manager->flush();

            return $this->redirectToRoute("category.index");
        }
        return $this->render('dashboard/category/index.html.twig', [
            'categories'    =>  $repository->findAll(),
            'category'      =>  $category,
            'form'          =>  $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="category.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Category $category)
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("category.index");
        }

        return $this->render('dashboard/category/edit.html.twig', [
            'category'      =>  $category,
            'form'          =>  $form->createView(),
        ]);
    }

}
