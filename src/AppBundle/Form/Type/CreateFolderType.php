<?php
/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 22/03/15
 * Time: 17:54
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class CreateFolderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder
            ->add('folderName')
            ->add('uploadDate')
            ->add('description')
            ->add('tags')
            ->add('usersWithAccess')
            ->add('password','password')
            ->add('save', 'submit')
            ->getForm();
    }

    public function getName(){
        return 'folder';
    }

//    public function setDefaultOptions(OptionsResolverInterface $resolver){
//        $resolver->setDefaults(array(
//            'user' => $this->user->getId()
//        ));
//    }
//
//    public function __construct(User $user){
//
//        $this->user=$user;
//    }

}