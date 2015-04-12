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
use AppBundle\Form\DataTransformer\TagsToStringTransformer;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreateFolderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){

        $entityManager = $options['em'];
        $transformer = new TagsToStringTransformer($entityManager);

        $builder
            ->add('folderName')
            ->add($builder->create('tags', 'text', array('label' => 'Tags (add tags separated by commas)'))
                ->addViewTransformer($transformer))
            ->add('plainPassword','repeated', array(
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'))
            )
            ->add('create', 'submit')
            ->getForm();
    }

    public function getName(){
        return 'folder';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => 'AppBundle\Entity\Folder',
            ))
            ->setRequired(array('em'))
            ->setAllowedTypes('em', 'Doctrine\Common\Persistence\ObjectManager');
    }
}