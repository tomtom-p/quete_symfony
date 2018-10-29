<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 29/10/18
 * Time: 11:28
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home_page")
     */
    public function index ()
    {
        return $this->render('Home/home.html.twig');
    }
}