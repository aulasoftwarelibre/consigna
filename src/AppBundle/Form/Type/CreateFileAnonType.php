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
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\True;


class CreateFileAnonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder
            ->add('filename', 'file')
            ->add('tags')
            ->add('plainPassword','repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'The password fields must match.',
                    'first_options'  => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'))
            )
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
            ->add('upload', 'submit')
            ->getForm();
    }

    public function getName(){
        return 'file';
    }
}