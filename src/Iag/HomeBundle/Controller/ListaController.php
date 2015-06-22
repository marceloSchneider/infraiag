<?php

namespace Iag\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Iag\HomeBundle\Form\ListaType;
use Iag\HomeBundle\Entity\Lista;

class ListaController extends Controller
{
    public function geralAction(Request $request)
    {
        $form = $this->createFilterForm();
        
        $form->handleRequest($request);
        if ($form->isValid()){
            $data = $form->getData();
        }
        
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('IagInfraBundle:PPorta')->findAll();
        
        return $this->render('IagHomeBundle:Geral:index.html.twig', array('entities' => $entities, 'form' => $form->createView()));
    }
    
    private function createCreateForm(Lista $entity)
    {
        $form = $this->createForm(new ListaType(), $entity, array(
            'action' => $this->generateUrl('iag_home_lista_lista'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Enviar'));

        return $form;
    }
    
    public function listaAction(Request $request) 
    {   
        $entity = new Lista();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        $isAnalista = $this->get('security.context')->isGranted('ROLE_ANALISTA');
        $isManutencao = $this->get('security.context')->isGranted('ROLE_MANUTENCAO');
        
        $where = $this->createWhere($entity);
        $em = $this->getDoctrine()->getManager();
        if(empty($where)){
            $entities = $em->getRepository('IagHomeBundle:Lista')->findAll();
        }else {
            $entities = $em->getRepository('IagHomeBundle:Lista')->findBy($where);
        }
        
        //$paginator = $this->get('knp_paginator');
        //$pagination = $paginator->paginate($entities, $request->query->get('page', 1)/*page number*/,20/*limit per page*/);
        
        return $this->render('IagHomeBundle:Geral:lista.html.twig', array('entities' => $entities, 'analista' => $isAnalista, 'manutencao' => $isManutencao, 'form' => $form->createView()));
    }
    
    private function createWhere(Lista $entity)
    {   
        $where = array();
        
        if ($entity->getAndar() != NULL){ $where['andar'] = $entity->getAndar();}
        if ($entity->getBloco() != NULL){ $where['bloco'] = $entity->getBloco();}
        if ($entity->getIdSwitch() != NULL){ $where['IdSwitch'] = $entity->getIdSwitch();}
        if ($entity->getIp() != NULL){ $where['ip'] = $entity->getIp();}
        if ($entity->getIpCamera() != NULL){ $where['IpCamera'] = $entity->getIpCamera();}
        if ($entity->getNomeSwitch() != NULL){ $where['nomeSwitch'] = $entity->getNomeSwitch();}
        if ($entity->getNumVoicePanel() != NULL){ $where['numVoicePanel'] = $entity->getNumVoicePanel();}
        if ($entity->getPatch() != NULL){ $where['patch'] = $entity->getPatch();}
        if ($entity->getPonto() != NULL){ $where['ponto'] = $entity->getPonto();}
        if ($entity->getPorta() != NULL){ $where['porta'] = $entity->getPorta();}
        if ($entity->getSala() != NULL){ $where['sala'] = $entity->getSala();}
        if ($entity->getSalaRack() != NULL){ $where['salaRack'] = $entity->getSalaRack();}
        if ($entity->getStatus() != NULL){ $where['status'] = $entity->getStatus();}
        if ($entity->getTelefonia() != NULL){ $where['telefonia'] = $entity->getTelefonia();}
        if ($entity->getVlan() != NULL){ $where['vlan'] = $entity->getVlan();}
        if ($entity->getWireless() != NULL){ $where['wireless'] = $entity->getWireless();}
        if ($entity->getCentral() != NULL){ $where['central'] = $entity->getCentral();}
        if ($entity->getDistribuicao() != NULL){ $where['distribuicao'] = $entity->getDistribuicao();}
        
        return $where;
    }  
}

