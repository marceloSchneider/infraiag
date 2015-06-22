<?php

namespace Iag\SwitchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('IagSwitchBundle:Default:index.html.twig', array('name' => $name));
    }
}
