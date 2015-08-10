<?php

/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 22/03/15
 * Time: 17:54.
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'file', array(
                'label' => 'label.file',
                'attr' => ['class' => 'filestyle', 'data-buttonBefore'=> 'true', 'data-buttonText' => 'label.choose_file'],
            ))
            ->add('tags', 'tags_text', array(
                'label' => 'label.tags',
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'first_options'  => array('label' => 'label.password'),
                'second_options' => array('label' => 'label.repeat_password'),
            ))
        ;
    }

    public function getName()
    {
        return 'upload_file';
    }
}
