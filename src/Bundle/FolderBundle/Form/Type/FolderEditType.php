<?php
/**
 * This file is part of the Consigna project.
 *
 * (c) Juan Antonio Martínez <juanto1990@gmail.com>
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bundle\FolderBundle\Form\Type;

use Bundle\UserBundle\Entity\Interfaces\UserInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FolderEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $folder = $builder->getData();
        $builder
            ->add('shared_with_users',  EntityType::class,  [
                'class' => UserInterface::class,
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
        return 'consigna_folder_edit';
    }
}
