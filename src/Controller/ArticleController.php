<?php
/**
 * Created by PhpStorm.
 * User: aurel
 * Date: 25/03/2018
 * Time: 18:38
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController
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
        return new Response(sprintf(
            'Future page about %s',
            $slug
            ));
    }
}