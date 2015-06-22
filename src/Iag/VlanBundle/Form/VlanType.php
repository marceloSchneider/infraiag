<?php

namespace Iag\VlanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VlanType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descricao')
            ->add('endereco')
            ->add('vlanRange')
            ->add('portaSwitch', null, array('label' => 'Porta do Switch'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Iag\VlanBundle\Entity\Vlan'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'iag_vlanbundle_vlan';
    }
}
