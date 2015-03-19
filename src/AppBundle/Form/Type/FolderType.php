<?php
/**
 * Created by PhpStorm.
 * User: jamartinez
 * Date: 19/03/15
 * Time: 12:58
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\Folder;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Session\Session;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\True;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class FolderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $folderPassword=$builder->getData()->getPassword();
        $user=$builder->getAction();
//        if (!$builder->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
        if($user){
        $builder
                ->add('password', 'password', array(
                    'constraints' => new Assert\EqualTo(array(
                        'value' => $folderPassword,
                        'message' => 'The password is not correct'
                    ))))
                ->add('submit', 'submit')
                ->getForm();
        }
        else{


            $builder
                ->add('password', 'password', array(
                    'constraints' => new Assert\EqualTo(array(
                        'value' => $folderPassword,
                        'message' => 'The password is not correct'
                    ))))
                ->add('captcha', 'ewz_recaptcha', array(
                    'attr' => array(
                        'options' => array(
                            'theme' => 'light',
                            'type'  => 'image'
                        )
                    ),
                    'mapped'      => false,
                    'constraints' => array(
                        new True()
                    )
                ))
                ->add('submit', 'submit')
                ->getForm();
//        }
//        $builder->handleRequest($request);
    }
    }

//    public function setDefaultOptions(OptionsResolverInterface $resolver){
//        $resolver->setDefaults(array(
//            'data_class' => 'AppBundle\Entity\Folder',
//        ));
//    }

    public function getName(){
        return 'folder';
    }

}