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

class CreateFolderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => 'foldername.create.folder'))
            ->add('tags', 'tags_text', array(
                'label' => 'tag.create.folder', ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'first_options'  => array('label' => 'password.create.folder'),
                'second_options' => array('label' => 'repeat.create.folder'), )
            )
        ;
    }

    public function getName()
    {
        return 'folder';
    }
}
