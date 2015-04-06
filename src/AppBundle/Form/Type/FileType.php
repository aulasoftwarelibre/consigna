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
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use AppBundle\Entity\User;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\True;


class FileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){

        $user=$options['user'];

        if($user!='') {
            $builder
                ->add('filename', 'file')
                ->add('tags')
                ->add('password', 'password')
                ->add('save', 'submit')
                ->getForm();
        }
        else{
            $builder
                ->add('filename', 'file')
                ->add('tags')
                ->add('password', 'password')
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
    }

    public function getName(){
        return 'file';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver){
        $resolver->setDefaults(array(
            'user' => $this->user->getUsername()
        ));
    }

    public function __construct(User $user){
        $this-> user = $user;
    }
}