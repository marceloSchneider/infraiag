<?php

namespace Iag\LocalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class LocalController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
                      'SELECT p.nome pavimento, b.nome bloco, s.numero sala '
                    . 'FROM IagLocalBundle:Bloco as b '
                    . 'INNER JOIN IagLocalBundle:Pavimento as p WITH b.id = p.bloco '
                    . 'INNER JOIN IagLocalBundle:Sala as s WITH p.id = s.pavimento'
                );
        
        $locais = $query->getResult();
        return $this->render('IagLocalBundle:Local:index.html.twig', array('locais' => $locais));
    }
}


