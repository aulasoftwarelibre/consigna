<?php

/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 22/03/15
 * Time: 17:54.
 */

namespace AppBundle\Form\Type;

use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EditFolderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $folder=$builder->getData();
        $builder
            ->add('usersWithAccess','entity', array(
                'class' => 'AppBundle\Entity\User',
                'multiple' => true,
                'query_builder' => function (EntityRepository $entityRepository) use ($folder){
                    return $entityRepository->createQueryBuilder('u')
                        ->leftJoin('u.sharedFolders', 'sf')
                        ->where('sf.id= :id')
                        ->setParameter('id',$folder->getId());
                }
            ))
            ->add('update', 'submit')
            ->getForm();
    }

    public function getName()
    {
        return 'folder';
    }
}
