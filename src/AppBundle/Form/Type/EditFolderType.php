<?php

/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 22/03/15
 * Time: 17:54.
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EditFolderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $folder = $builder->getData();
        $builder
            ->add('shared_with_users',  EntityType::class,  [
                'class' => User::class,
                'multiple' => true,
                'label' => 'label.users',
                'query_builder' => function (EntityRepository $entityRepository) use ($folder) {
                    return $entityRepository->createQueryBuilder('u')
                        ->leftJoin('u.sharedFolders', 'sf')
                        ->where('sf.id= :id')
                        ->setParameter('id', $folder->getId());
                },
            ])
        ;
    }

    public function getBlockPrefix()
    {
        return 'folder';
    }
}
