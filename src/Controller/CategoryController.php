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
     * @Route("category", name="category")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        if (!$categories) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }
        return $this->render(
            '/category.html.twig',
            ['categories' => $categories]
        );
    }
    /**
     * @Route("/category/{id}", name="category_show")
     * @param Category $category
     * @return Response
     */
    public function show(Category $category) :Response
    {
        return $this->render('showcategory.html.twig', ['category'=>$category]);
    }
}