<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 12/11/18
 * Time: 11:32
 */

namespace App\Controller;


use App\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{

    /**
     * @Route("/category/{id}", name="category_show")
     * @param Category $category
     * @return Response
     */
    public function show(Category $category) :Response
    {
        return $this->render('category.html.twig', ['category'=>$category]);
    }
}