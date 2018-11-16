<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 12/11/18
 * Time: 11:32
 */

namespace App\Controller;


use App\Entity\Article;
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
     * @Route("/category/{category}", name="category_show")
     * @return Response
     */
    public function showByCategory(string $category) :Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name'=> $category]);
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(['category' => $category->getId()], ['id' => 'DESC'], 3 , 0);
        return $this->render('showcategory.html.twig', [
            'articles'=>$articles,
            'category'=>$category,
            ]);

        /*
         * Les truc qui vont pas dans ton code :
         *        - ligne 39 *
         *        - ligne 45 (nom de la variable) *
         *        - ligne 46*
         *        - ligne 47 (Je t'aide parce que la c'est chiant, c'est category qu'il faut mettre et pas category_id après le findBy)*
         *        - ligne 47 aussi*
         *        - ligne 49 (Tu return que $category alors que dans l'énoncé demande de renvoyé 1 catégorie et 3 articles donc c'est 2 trucs différents)
         */
    }

    /**
     * @Route("/category/Javascript")
     * @param Category $category
     * @return Response
     */
    public function showJs(Category $category) :Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        return $this->render('showJS.html.twig', ['category' => $category]);
    }
}