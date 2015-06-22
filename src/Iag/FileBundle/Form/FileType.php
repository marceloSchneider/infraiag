<?php

namespace Iag\FileBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class FileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('arquivo', 'file')
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'iag_filebundle_file';
    }
}