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
use AppBundle\Form\DataTransformer\TagsToStringTransformer;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreateFileAnonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){

        $entityManager = $options['em'];
        $transformer = new TagsToStringTransformer($entityManager);
        $builder
            ->add('filename', 'file')
            ->add($builder->create('tags', 'text', array('label' => 'Tags (add tags separated by commas)'))
                ->addViewTransformer($transformer))
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

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => 'AppBundle\Entity\File',
            ))
            ->setRequired(array('em'))
            ->setAllowedTypes('em', 'Doctrine\Common\Persistence\ObjectManager');
    }
}