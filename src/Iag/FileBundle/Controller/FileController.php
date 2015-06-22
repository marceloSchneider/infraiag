<?php

namespace Iag\FileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Iag\FileBundle\Form\FileType;
use Iag\LocalBundle\Entity\Bloco;
use Iag\LocalBundle\Entity\Pavimento;
use Iag\InfraBundle\Entity\Rack;
use Iag\FileBundle\Entity\Data;

class FileController extends Controller
{
    private $bloco;
    private $pavimento;
    private $sala;
    private $rack;
    private $patch;
    private $vlan = array();
    private $ip;
    private $pilha;
    private $pporta;
    private $voicePanel;
    
    public function loadAction(Request $request)
    {
        $entity = array();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $updateForm = $this->createUpdateForm();
 
        if($form->isValid()){
            $fileName = 'data.csv';
            $dir = '/var/www/infra/src/Iag/FileBundle/Resources/public/upload/';
            //$root = $this->container->get('router')->getContext()->getBaseUrl();
            $form['arquivo']->getData()->move($dir, $fileName);
        }
        
        return $this->render('IagFileBundle:File:index.html.twig', array('form' => $form->createView(), 'updateForm'=>$updateForm->createView()));
    }
    
    public function updateAction()
    {
        $handle = fopen('/var/www/infra/src/Iag/FileBundle/Resources/public/upload/data.csv', 'r');
        while(($data = fgetcsv($handle, 9000, ',')) !== FALSE){
                
                //$this->loadData($data);
                
                $data = $this->trimArray($data);
                $this->insertBloco($data);
                $this->insertPavimento($data);
                $this->insertSala($data);
                
                $this->insertRack($data); 
                $this->insertPatch($data);
                $this->insertPPorta($data);
                $this->insertVoice($data);
                
                $this->insertVlan($data);
                $this->insertIP($data);
                $this->insertPilha($data);
                $this->insertSwitch($data);
                $this->espelharPatch($data);
                $this->setVoice($data);
                $this->setIsWirelles($data);
                $this->setIsCamera($data);
                $this->setVlanPortaSwitch($data);
        }
        fclose($handle);
        return $this->redirect($this->generateUrl('iag_file_upload'));
    }
    
    private function loadData($dados)
    {
        $data = new Data();
        
        $data->setBloco($dados[0]);
        $data->setAndar($dados[1]);
        $data->setSala($dados[2]);
        $data->setPatch($dados[3]);
        $data->setSwitch($dados[5]);
        $data->setIp($dados[6]);
        $data->setIdentSwitch($dados[7]);
        $data->setPortaSwitch($dados[8]);
        $data->setWireless($dados[9]);
        $data->setIpCamera($dados[10]);
        $data->setVlan($dados[11]);
        $data->setSalaRack($dados[12]);
        $data->setIdentRack($dados[13]);
        $data->setRamal($dados[14]);
        $data->setRackCentral($dados[15]);
        $data->setTelPassagemA([16]);
        $data->setTelPassagemB($dados[17]);
        
        
        $this->persist($data);
    }
    
    private function trimArray($array)
    {
        $dados = array();
        foreach ($array as $k=>$v)
        {
            $v = trim($v);
            $v = mb_strtoupper($v, 'utf-8');
            $dados[$k] = $v;
        }
        return $dados;
    }
    
    private function createCreateForm($entity)
    {
        
        $form = $this->createForm(new FileType(), $entity, array(
            'action' => $this->generateUrl('iag_file_upload'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Upload'));

        return $form;
    }
    
    private function createUpdateForm()
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('iag_file_update'))
            ->add('submit', 'submit', array('label' => 'Update'))
            ->getForm()
        ;
    }
    
    private function getEntity($e, array $param)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($e)->findOneBy($param);
        return $entity;
    }
    
    private function persist($entity)
    {        
        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
    }
    
    private function insertBloco($dados)
    {
        $param = array('nome' => $dados[0]);
        $entity = $this->getEntity('IagLocalBundle:Bloco', $param);
        if(!$entity){
            $b = new Bloco();
            $b->setNome($param['nome']);
            $this->persist($b);
           
            $entity = $b;
        }
        $this->bloco =  $entity;
    }
    
    private function insertPavimento($dados)
    {
        $param = array('nome' => $dados[1], 'bloco'=>$this->bloco);
        $entity = $this->getEntity('IagLocalBundle:Pavimento', $param); 
        if(!$entity){
            $p = new Pavimento();
            $p->setBloco($param['bloco']);
            $p->setNome($param['nome']);
            $this->persist($p);
            
            $entity = $p;
        }
        $this->pavimento = $entity;
    }
    
    private function insertSala($dados)
    {
        $param = array('numero' => $dados[2], 'pavimento'=>$this->pavimento, 'bloco' => $this->bloco);
        $entity = $this->getEntity('IagLocalBundle:Sala', $param);
        
        if(!$entity){
            $s = new \Iag\LocalBundle\Entity\Sala();
            $s->setPavimento($this->pavimento);
            $s->setNumero($param['numero']);
            $s->setBloco($param['bloco']);
            $this->persist($s);
            
            $entity = $s;
        }
        $this->sala = $entity;
    }
    
    private function insertRack_old($dados)
    {
        $salaRack = substr($dados[12], 1, 3);
        $blocoRack = substr($dados[12], 0, 1);
        
        $s = $this->getEntity('IagLocalBundle:Sala', array('numero' => $salaRack, 'bloco'=>$blocoRack));
        if(!$s){
            $b = $this->getEntity('IagLocalBundle:Bloco', array('nome'=>$blocoRack));
            $p = $this->getEntity('IagLocalBundle:Pavimento', array('nome'=>  $this->getPavimentoFromSala($salaRack), 'bloco'=>$b));
            $sr = new \Iag\LocalBundle\Entity\Sala();
            $sr->setPavimento($p);
            $sr->setBloco($b);
            $sr->setNumero($salaRack);
            $this->persist($sr);
            
            $param = array('identificacao'=>$dados[13], 'quantidadeU'=>48, 'sala'=>$sr);
            $entity = $this->getEntity('IagInfraBundle:Rack', $param);
            if(!$entity){
                $r = new Rack();
                $r->setIdentificacao($param['identificacao']);
                $r->setSala($param['sala']);
                $r->setQuantidadeU($param['quantidadeU']);
                
                $this->persist($r);
                return $r;
            }
        }
        $param = array('identificacao'=>$dados[13], 'quantidadeU'=>48, 'sala'=>$s);
        $entity = $this->getEntity('IagInfraBundle:Rack', $param);
        if(!$entity){
            $r = new Rack();
            $r->setIdentificacao($param['identificacao']);
            $r->setSala($param['sala']);
            $r->setQuantidadeU($param['quantidadeU']);

            $this->persist($r);
            return $r;
        }
        return $entity;
    }
    
    private function insertRack($dados)
    {
        $salaRack = substr($dados[12], 1, 3);
        $blocoRack = substr($dados[12], 0, 1);
        $entityBloco = $this->getEntity('IagLocalBundle:Bloco', array('nome'=>$blocoRack));
        $s = $this->getEntity('IagLocalBundle:Sala', array('numero' => $salaRack, 'bloco'=>$entityBloco));
        $pavimento = $this->getPavimentoFromSala($salaRack);
        
        if(!$s){
            $p = $this->getEntity('IagLocalBundle:Pavimento', array('nome'=>  $this->getPavimentoFromSala($salaRack), 'bloco'=>$entityBloco));
            if(!$p){
                $ePavimento = new Pavimento();
                $ePavimento->setBloco($entityBloco);
                $ePavimento->setNome($pavimento);
                
                $this->persist($ePavimento);
                $p = $ePavimento;
            }
            $sr = new \Iag\LocalBundle\Entity\Sala();
            $sr->setPavimento($p);
            $sr->setBloco($entityBloco);
            $sr->setNumero($salaRack);
            $this->persist($sr);
            $s = $sr;
        }    
        $paramRack = array('identificacao'=>$dados[13], 'quantidadeU'=>48, 'sala'=>$s);
        
        $rack = $this->getEntity('IagInfraBundle:Rack', $paramRack);
        
        if(!$rack){
            $r = new Rack();
            $r->setIdentificacao($paramRack['identificacao']);
            $r->setSala($paramRack['sala']);
            $r->setQuantidadeU($paramRack['quantidadeU']);

            $this->persist($r);
            $rack = $r;
        }
        $this->rack = $rack;
    }
    
    
    
    private function getPavimentoFromSala($numSala)
    {
        $n = substr($numSala, 0, 1) - 1;
        return $n == 0 ? 'T': $n;
    }
    
    private function insertPatch($dados)
    {
        $p = explode('-', $dados[3]);
        $param = array('numPortas' => 24, 'pilha'=>$p[1], 'rack'=>$this->rack);
        $entity = $this->getEntity('IagInfraBundle:Patch', $param);
        if(!$entity){
            $p = new \Iag\InfraBundle\Entity\Patch();
            $p->setNumPortas($param['numPortas']);
            $p->setPilha($param['pilha']);
            $p->setRack($param['rack']);
            $this->persist($p);
            $entity = $p;
        }
        $this->patch =  $entity;
    }
    
    private function insertPPorta($dados)
    {
        if ($dados[3])
        {
            $porta = substr($dados[3], -2);
            
            $paramPorta = array('patch'=>$this->patch, 'numero'=>$porta);
            $pporta = $this->getEntity('IagInfraBundle:PPorta', $paramPorta);
            
            if (!$pporta){
                $p = new \Iag\InfraBundle\Entity\PPorta();
                $p->setPatch($this->patch);
                $p->setNumero($porta);
                $p->setSala($this->sala);
                
                $this->persist($p);
                $pporta = $p;
            }
            $this->pporta = $pporta;
        }
    }
    
    private function createPPortas($numPortas, \Iag\InfraBundle\Entity\Patch $patch)
    {
        for($i = 1; $i <= $numPortas ; $i++)
        {
            $pporta = new \Iag\InfraBundle\Entity\PPorta();
            $pporta->setNumero($i);
            $pporta->setPatch($patch);
            $pporta->setSala($this->sala);
            $this->persist($pporta);
        }
    }
    
    private function insertVoice($dados)
    {
        if ($dados[17]){
            $param = array('numPortas' =>48 , 'numero'=>1, 'rack'=>$this->rack);
            $entity = $this->getEntity('IagInfraBundle:VoicePanel', $param);

            if(!$entity){
                $v = new \Iag\InfraBundle\Entity\VoicePanel();
                $v->setNumPortas($param['numPortas']);
                $v->setNumero($param['numero']);
                $v->setRack($param['rack']);
                
                $this->persist($v);
                $this->createVoicePanelPorts($v);
                
                $entity =  $v;
            }
            $this->voicePanel = $entity;
        }
    }
    
    private function createVoicePanelPorts(\Iag\InfraBundle\Entity\VoicePanel $entity)
    {
        $numPortas = $entity->getNumPortas();
        
        for ($i=1; $i<=$numPortas; $i++)
        {
            $voicePorta = new \Iag\InfraBundle\Entity\VoicePorta();
            $voicePorta->setNumero($i);
            $voicePorta->setVoicePanel($entity);
            $this->persist($voicePorta);
        }
    }
    
    private function insertVlan($dados)
    {
        if ($dados[11]){
            unset($this->vlan);
            $ipExpl = explode('.', $dados[6]);
            $vl = explode(',', $dados[11]);
            
            foreach ($vl as $v){
                $param = array('descricao' => $v, 'endereco'=>$v, 'vlanrange'=>$ipExpl[0] .'.'.$v.'.0.0/23');
                $entity = $this->getEntity('IagVlanBundle:Vlan', array('endereco'=>$v));

                if(!$entity){
                    $newVlan = new \Iag\VlanBundle\Entity\Vlan();
                    $newVlan->setDescricao($param['descricao']);
                    $newVlan->setEndereco($param['endereco']);
                    $newVlan->setVlanRange($param['vlanrange']);

                    $this->persist($newVlan);

                    $entity = $newVlan;
                }
                $this->vlan[] = $entity;
            }
        }
    }
    
    private function insertIP($dados)
    {
        if($dados[6]){
            $vExpl = explode('.', $dados[6]);
            $vlan = $this->getEntity('IagVlanBundle:Vlan', array('endereco'=>$vExpl[1]));
            $ipExpl = explode('.', $dados[6]);
            
            if(!$vlan){
                $v = new \Iag\VlanBundle\Entity\Vlan();
                $v->setDescricao($vExpl[1]);
                $v->setEndereco($vExpl[1]);
                $v->setVlanRange($ipExpl[0] .'.'.$ipExpl[1].'.0.0/23');
                
                $this->persist($v);
                $vlan = $v;
            }
            
            $entity = $this->getEntity('IagIpBundle:Ip', array('endereco'=>$dados[6]));

            if(!$entity){
                $ip = new \Iag\IpBundle\Entity\Ip();
                $ip->setEndereco($dados[6]);
                $ip->setVlan($vlan);

                $this->persist($ip);
                $entity = $ip;
            }
            $this->ip =  $entity;
        }
    }
    
    
    private function insertPilha($dados)
    {
        if($dados[5]){
            //$bloco = $this->getEntity('IagLocalBundle:Bloco', array('nome' => substr($dados[12], 0, 1)));           
            //$salaRack = $this->getEntity('IagLocalBundle:Sala', array('numero'=>  substr($dados[12], 1, 3), 'bloco'=> $bloco));
            //$rack = $this->getEntity('IagInfraBundle:Rack', array('identificacao'=>$dados[13], 'sala'=>$salaRack));
//echo $dados[18] . '<br>';
            $ip = $this->getEntity('IagIpBundle:Ip', array('endereco'=>$dados[6]));
            $hostname = $dados[5];
            $param = array('ip'=>$ip, 'hostname'=>$hostname);
            $entity = $this->getEntity('IagSwitchBundle:SwitchCommon', $param);

            if (!$entity){
                $p = new \Iag\SwitchBundle\Entity\SwitchCommon();
                $p->setHostname($param['hostname']);
                $p->setIp($param['ip']);
                //$p->setRack($param['rack']);
                $this->persist($p);
                $entity = $p;
            }
            $this->pilha = $entity;
        }
    }
    
    private function insertSwitch($dados)
    {   
        if($dados[5]){
            $switchExp = explode('_', $dados[5]);
            $sala = $this->getEntity('IagLocalBundle:Sala', array('bloco'=>  substr($dados[12], 0, 1), 'numero'=> substr($dados[12], 1)));
            $rack = $this->getEntity('IagInfraBundle:Rack', array('identificacao'=>$dados[13], 'sala'=>$sala));
            $switchcommon = $this->getEntity('IagSwitchBundle:SwitchCommon', array('hostname'=>$dados[5]));
            $pilhaExpl = explode('_', $dados[7]);
            if (count($pilhaExpl) === 4)
            {
                $posicaoPilha = $pilhaExpl[3];
            }else{
                $posicaoPilha = 0;
            }
            $pilha = $pilhaExpl[2];
            $identificacao = $dados[7];
            $numPortas = substr($dados[5], -2, 1) == 'P' ? 48 : 48;
            $isGiga = substr($dados[5], 0, 1) == 'G' ? 1 : 0;
            $marca = $switchExp[2];

            $param = array( 'switchCommon'=>$switchcommon, 
                            'pilha'=>$pilha, 
                            'identificacao' => $identificacao, 
                            'numPortas'=>$numPortas,
                            'isGiga' => $isGiga,
                            'marca' => $marca,
                            'patrimonio' => 'preencher',
                            'posicaoPilha' => $posicaoPilha,
                );
            $entity = $this->getEntity('IagSwitchBundle:Switchs', $param);
            if (!$entity){
                $s = new \Iag\SwitchBundle\Entity\Switchs();
                $s->setIdentificacao($param['identificacao']);
                $s->setIsGiga($param['isGiga']);
                $s->setMarca($param['marca']);
                $s->setNumPortas($param['numPortas']);
                $s->setPatrimonio($param['patrimonio']);
                $s->setPilha($param['pilha']);
                $s->setPosicaoPilha($param['posicaoPilha']);
                $s->setSwitchCommon($param['switchCommon']);
                
                $this->persist($s);
                
                $this->insertPortaSwitch($s);
                
                $entity = $s;
            }
            $this->switch = $entity;
        }
    }
    
    private function insertPortaSwitch(\Iag\SwitchBundle\Entity\Switchs $switch)
    {
        $posicaoPilha = $switch->getPosicaoPilha();
        $numPortas = $switch->getNumPortas();
        
        $isPoe = 0;
        for($i=1; $i <= $numPortas; $i++)
        { 
            $porta = new \Iag\SwitchBundle\Entity\PortaSwitch();
            $porta->setIsPOE($isPoe)
                    ->setPOEStatus(0)
                    ->setNumPorta($posicaoPilha.'/'.'0'.'/'.$i)
                    ->setSwitch($switch);
            $this->persist($porta);
        }
    }
    
    private function espelharPatch($dados)
    {   
        if ($dados[8]){
            $patchExpl = explode('-', $dados[3]);
            $pporta = $patchExpl[2];

            $param = array('numero'=>$pporta, 'patch'=>  $this->patch);

            $entity = $this->getEntity('IagInfraBundle:PPorta', $param);
            
            if ($entity){
                $dadosPortaSwitch = $dados[8];
                $numPorta = $this->switch->getPosicaoPilha(). '/' . '0' . '/' . $dadosPortaSwitch;
                
                echo $numPorta .'<br>';
                
                $paramPortaSwitch = array('numPorta'=>$numPorta, 'switch'=>  $this->switch);
                $portaS = $this->getEntity('IagSwitchBundle:PortaSwitch', $paramPortaSwitch);

                $portaS->setPporta($entity);
                $this->persist($portaS);
                
                $entity->setPorta($portaS);   
                $this->persist($entity);
            }
        }
    }
    
    private function setVoice($dados)
    {
        if ($dados[17])
        {   
            $paramVoicePorta = array('voicePanel'=>$this->voicePanel, 'numero'=>$dados[17]);
            $voicePorta = $this->getEntity('IagInfraBundle:VoicePorta', $paramVoicePorta);
            
            $voicePorta->setRamal($dados[14]);
            $voicePorta->setCentral($dados[15]);
            $voicePorta->setDistribuicao($dados[16]);
            $this->persist($voicePorta);

            $this->pporta->setVoice($voicePorta);
            $this->persist($this->pporta);
            
            $voicePorta->setPporta($this->pporta);
            $this->persist($voicePorta);
        }
    }
    
    private function setIsWirelles($dados)
    {
        if($dados[9]){
            $isW = $dados[9] === 'S' ? 1 : 0;
            $this->pporta->setIsWireless($isW);
            $this->persist($this->pporta);
        }
    }
    
    private function setIsCamera($dados)
    {
        if($dados[10]){
            $isC = $dados[10] === 'S' ? 1 : 0;
            $this->pporta->setIsIpCamera($isC);
            $this->persist($this->pporta);
        }
    }
    
    private function setVlanPortaSwitch($dados)
    {
        if($dados[11] && $dados[5]){
            $paramPortaSwitch = array('numPorta'=>$this->switch->getPosicaoPilha().'/'.'0'.'/'.$dados[8], 'switch'=>$this->switch);
            $portaSwitch = $this->getEntity('IagSwitchBundle:PortaSwitch', $paramPortaSwitch);
            foreach ($this->vlan as $vlan){
                $alread = $portaSwitch->getVlan()->contains($vlan);
                if($vlan && !$alread){
                    $portaSwitch->setVlan($vlan);
                }
            }
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($portaSwitch);
            $em->flush();
        }
    }
}

