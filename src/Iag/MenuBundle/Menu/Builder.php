<?php

namespace Iag\MenuBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        
        $menu->addChild('Home', array('route' => 'iag_home_lista_geral'));
        $menu->addChild('Local')->addChild('Bloco', array('route' => 'bloco'));
        
        $menu['Local']->addChild('Pavimento', array('route' => 'pavimento'));
        $menu['Local']->addChild('Sala', array('route' => 'sala'));
        
       $menu->addChild('Ativos');
       $menu['Ativos']->addChild('Switch', array('route' => 'switchs'));
      
       $menu->addChild('Infra');
       $menu['Infra']->addChild('Rack', array('route' => 'rack_index'));
       $menu['Infra']->addChild('Patch Panel', array('route' => 'patch_index'));
       $menu['Infra']->addChild('Voice Panel', array('route' => 'voicepanel'));
       
       $menu->addChild('Rede');
       $menu['Rede']->addChild('Ip', array('route' => 'ip'));
       $menu['Rede']->addChild('Vlan', array('route' => 'vlan'));
        
        
        return $menu;
    }
}

