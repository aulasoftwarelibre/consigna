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


class FileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder
            ->add('filename')
            ->add('uploadDate')
            ->add('tags')
            ->add('usersWithAccess')
            ->add('password','password')
            ->add('save', 'submit')
            ->getForm();
    }

    public function getName(){
        return 'file';
    }
}