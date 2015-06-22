<?php

namespace Iag\InfraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VoicePanelType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numPortas', null, array(
                'label' => 'Número de portas'
            ))
            ->add('numero', null, array(
                'label' => 'Número'
            ))
            ->add('rack')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Iag\InfraBundle\Entity\VoicePanel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'iag_infrabundle_voicepanel';
    }
}
