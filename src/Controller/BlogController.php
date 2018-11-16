<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 29/10/18
 * Time: 14:23
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
    /**
     * @param $page
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/blog/{page}", requirements={"page"="[a-z0-9-]+"}, name="blog_list" )
     */
    public function show($page = "article-sans-titre")
    {
        $page = ucwords(str_replace('-', ' ', $page));
        return $this->render('Blog/blog.html.twig', ['page' => $page]);
    }

    /**
     * Show all row from article's entity
     *
     * @Route("/", name="homepage")
     * @return Response
     */
    public function index() :Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        return $this->render(
            'Blog/index.html.twig',
            ['articles' => $articles]
        );
    }

}