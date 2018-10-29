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
}