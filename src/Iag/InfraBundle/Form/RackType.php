<?php

namespace Iag\InfraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RackType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('identificacao', null, array('label' => 'Identificação'))
            ->add('quantidadeU', null , array('label' => 'Quantidade de U\'s'))
            ->add('sala')
            ->add('atendeLocais', null, array('label' => 'Atende os locais'));
            
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Iag\InfraBundle\Entity\Rack'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'iag_infrabundle_rack';
    }
}
