<?php

namespace Iag\InfraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PatchType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numPortas', 'choice', array(
                'choices' => array('24' => '24', '48' => '48'),
                'required' => 'true',
                'label' => 'Número de portas'
            ))
            ->add('pilha', null, array('label' => 'Patch Panel'))
            ->add('rack')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Iag\InfraBundle\Entity\Patch'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'iag_infrabundle_patch';
    }
}
