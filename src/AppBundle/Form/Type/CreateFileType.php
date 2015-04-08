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


class CreateFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder
            ->add('filename', 'file')
            ->add('tags')
            ->add('password', 'password')
            ->add('save', 'submit')
            ->getForm();
    }

    public function getName(){
        return 'file';
    }
}