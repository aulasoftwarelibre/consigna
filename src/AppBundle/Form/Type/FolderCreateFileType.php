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

class FolderCreateFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'file', array(
                'label' => 'file.create.file',
                'attr' => ['class' => 'filestyle', 'data-buttonBefore'=> 'true'],
            ))
        ;
    }

    public function getName()
    {
        return 'folder_create_file';
    }
}
