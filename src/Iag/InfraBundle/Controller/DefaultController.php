<?php

namespace Iag\InfraBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IagInfraBundle:Default:index.html.twig', array('name' => $name));
    }
}
