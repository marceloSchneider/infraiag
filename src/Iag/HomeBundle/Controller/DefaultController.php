<?php

namespace Iag\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IagHomeBundle:Default:index.html.twig', array('name' => $name));
    }
}
