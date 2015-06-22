<?php

namespace Iag\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IagUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
