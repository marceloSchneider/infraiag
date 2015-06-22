<?php

namespace Iag\HomeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ListaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bloco')
            ->add('andar')
            ->add('sala')
            ->add('patch', null, array('label' => 'Patch Panel'))
            ->add('ponto')
            ->add('status')
            ->add('telefonia')
            ->add('numVoicePanel', null, array('label' => 'Voice Panel'))
            ->add('central', null, array('label' => 'Voice Panel Central'))
            ->add('distribuicao', null, array('label' => 'Voice Panel A04'))
            ->add('nomeSwitch')
            ->add('ip')
            ->add('porta', null, array('label' => 'Porta do Switch'))
            ->add('wireless')
            ->add('vlan')
            ->add('salaRack', null, array('label' => 'Sala do Rack'))
            ->add('idSwitch', null, array('label' => 'Identiicação do Switch'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Iag\HomeBundle\Entity\Lista'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'iag_homebundle_lista';
    }
}
