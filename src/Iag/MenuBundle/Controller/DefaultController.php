<?php

namespace Iag\MenuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IagMenuBundle:Default:index.html.twig', array('name' => $name));
    }
}
