<?php

namespace Gsup\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $query = $this->get('doctrine_mongodb')
            ->getRepository('GsupForumBundle:Post')
            ->getListQuery()
        ;

        $pagination = $this->get('knp_paginator')->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('GsupForumBundle:Default:index.html.twig', array(
            'pagination' => $pagination,
            'title' => 'Posts'
        ));
    }
}
