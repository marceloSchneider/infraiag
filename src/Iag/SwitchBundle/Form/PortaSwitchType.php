<?php

namespace Iag\SwitchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PortaSwitchType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numPorta', null, array('label' => 'Número da porta'))
            ->add('isPOE', null, array('label' => 'É POE'))
            ->add('pOEStatus', null, array('label' => 'POE ativado'))
            ->add('switch')
            ->add('pporta', null, array('label' => 'Porta do Patch Panel'))
            ->add('vlan')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Iag\SwitchBundle\Entity\PortaSwitch'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'iag_switchbundle_portaswitch';
    }
}
