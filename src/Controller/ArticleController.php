<?php
/**
 * Created by PhpStorm.
 * User: aurel
 * Date: 25/03/2018
 * Time: 18:38
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    /**
     * @Route("/")
     * @return Response
     */
    public function homepage(){
        return new Response('IT WORKS !!!');
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug){
        $comments = ['1', '2', '3'];
        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'comments' => $comments
        ]);
    }
}