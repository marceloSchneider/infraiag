<?php

namespace Iag\InfraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Iag\InfraBundle\Form\EspelharType;

class EspelharController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('IagInfraBundle:Rack')->find(6);
        $form = $this->createCreateForm($entity);

        if($request->isXmlHttpRequest())
        {
            $rackId = $request->request->get('rackId');
            $entity = $em->getRepository('IagInfraBundle:Rack')->find($rackId);
            $switchId = $request->request->get('switchId');
            $form = $this->createCreateForm($entity);
            
            $pontos = $this->getPortasBySwitchId($switchId);
            
            $page = $this->render('IagInfraBundle:Espelhar:index.html.twig', array('form'=>$form->createView(), 'pontos' => $pontos));
            
            $response = new Response($page->getContent());
            return $response;
        }        
        return $this->render('IagInfraBundle:Espelhar:index.html.twig', array('form'=>$form->createView()));
    }
    
    private function createCreateForm($entity, $switchId = null)
    {
        $form = $this->createForm(new EspelharType(), $entity, array(
            'action' => $this->generateUrl('espelhar_create'),
            'method' => 'POST',
        ));
        
        return $form;
    }
    
    private function getPortasBySwitchId($switchId)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $pontos = $em->getRepository('IagSwitchBundle:PortaSwitch')->findBy(array('switch' => $switchId));
        return $pontos;
    }
}


