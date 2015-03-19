<?php
/**
 * Created by PhpStorm.
 * User: jamartinez
 * Date: 19/03/15
 * Time: 12:58
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;

class FolderType extends AbstractType
{

    public function protectFolder(FormBuilderInterface $builder, Folder $folder, Request $request){

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $builder
                ->add('password', 'password', array(
                    'constraints' => new Assert\EqualTo(array(
                        'value' => $folder->getPassword(),
                        'message' => 'The password is not correct'
                    ))))
                ->add('submit', 'submit')
                ->getForm();
        }

        else{
            $builder
                ->add('password', 'password', array(
                    'constraints' => new Assert\EqualTo(array(
                        'value' => $folder->getPassword(),
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
        }
        $builder->handleRequest($request);
    }

    public function getName()
    {
        return 'folder';
    }

}