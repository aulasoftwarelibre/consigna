<?php
/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 22/03/15
 * Time: 17:54
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;



class CreateFolderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder
            ->add('folderName')
            ->add('description')
            ->add('tags')
            ->add('password','password')
            ->add('upload', 'submit')
            ->getForm();
    }

    public function getName(){
        return 'folder';
    }
}