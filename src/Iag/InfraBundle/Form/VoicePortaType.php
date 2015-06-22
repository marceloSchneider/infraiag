<?php

namespace Iag\InfraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VoicePortaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero', null, array('label' => 'Número'))
            ->add('central', null, array('label' => 'Número do ponto no DG central'))
            ->add('distribuicao', null, array('label' => 'Número do ponto na sala A104'))
            ->add('ramal')
            ->add('voicePanel')
            ->add('pporta', null, array('label' => 'Porta do Patch Panel'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Iag\InfraBundle\Entity\VoicePorta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'iag_infrabundle_voiceporta';
    }
}
