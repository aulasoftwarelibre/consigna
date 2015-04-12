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
            ->add($builder->create('tags', 'text')
                ->addViewTransformer($transformer))
            ->add('plainPassword','password')
            ->add('upload', 'submit')
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