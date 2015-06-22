<?php

namespace Iag\InfraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PPortaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero', null, array('label' => 'Número da porta'))
            ->add('patch', null, array('label' => 'Patch Panel'))
            ->add('porta', null, array('label' => 'Porta do Switch'))
            ->add('isWireless', null, array(
                'label' => 'É Wirelless'
            ))
            ->add('isIpCamera', null, array(
                'label' => 'É camera IP'
            ))
            ->add('sala', null, array('label' => 'Localização do ponto'))   
            ->add('voice', null, array('label' => 'Porta do Voice Panel'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Iag\InfraBundle\Entity\PPorta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'iag_infrabundle_pporta';
    }
}
