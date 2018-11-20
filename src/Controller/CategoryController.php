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
use App\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    /**
     * @Route("category", name="category")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();
        if (!$categories) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            header("Location:/category");

        }
        return $this->render(
            'category.html.twig',
            ['categories' => $categories, 'form'=>$form->createView()]
        );
    }

    /**
     * @Route("/category/show/{categoryName}")
     * @param string $categoryName
     * @return Response
     */
    public function showJs(string $categoryName): Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(['category' => $category->getId()]);
        return $this->render('showJS.html.twig', ['category' => $category, 'articles' => $articles]);
    }

    /**
     * @Route("/category/{category}", name="category_show")
     * @return Response
     */
    public function showByCategory(string $category): Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $category]);
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(['category' => $category->getId()], ['id' => 'DESC'], 3, 0);
        return $this->render('showcategory.html.twig', [
            'articles' => $articles,
            'category' => $category,
        ]);

    }
}