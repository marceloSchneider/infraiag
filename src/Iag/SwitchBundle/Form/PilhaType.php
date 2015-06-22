<?php

namespace Iag\SwitchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Iag\SwitchBundle\Form\SwitchPilhaType;

class PilhaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ip')
            ->add('hostname')
            ->add('rack')
            ->add('switchs')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Iag\SwitchBundle\Entity\Pilha'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'iag_switchbundle_pilha';
    }
}
