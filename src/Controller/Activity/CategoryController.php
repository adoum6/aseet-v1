<?php

namespace App\Controller\Activity;

use App\Repository\Activity\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

}
