<?php

namespace App\Controller\Activity;

use App\Entity\Activity\Category;
use App\Form\Activity\CategoryType;
use App\Repository\Activity\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/category/")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("", name="category.index")
     */
    public function index(CategoryRepository $repository)
    {
        return $this->render('activity/category/index.html.twig', [
            'categories' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("new", name="category.index")
     */
    public function new(Request $request, CategoryRepository $repository)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($category);
            $manager->flush();
        }
        return $this->render('activity/category/index.html.twig', [
            //'categories'    =>  $repository->findAll(),
            'category'      =>  $category,
            'form'          =>  $form->createView(),
        ]);
    }

}
