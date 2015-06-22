<?php

namespace Iag\InfraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class EspelharType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rack', 'entity', array(
                'class' => 'IagInfraBundle:Rack',
                'placeholder' => ''
            ))
                
            ->addEventListener(
                    FormEvents::PRE_SET_DATA,
                    function (FormEvent $event){
                        $form = $event->getForm();
                        $data = $event->getData();
                        
                        $rack = $data->getRack();
                        $switchs = null === $rack ? array() : $rack->getSwitchs();
                        
                        $form->add('switchs', 'entity', array(
                            'class' => 'IagSwitchBundle:Switchs',
                            'placeholder' => '',
                            'choices' => $switchs,
                            'required' => false,
                        ));
                    }
              )
              
            
        ;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'iag_infrabundle_espelhar';
    }
}

