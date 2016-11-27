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

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class OrganizationAdmin extends AbstractAdmin
{
    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'ASC',
        '_sort_by' => 'name',
    ];

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name', null, [
                'label' => 'label.name',
            ])
            ->add('code', null, [
                'label' => 'label.code',
            ])
            ->add('isEnabled', null, [
                'label' => 'label.enabled',
            ])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name', null, [
                'label' => 'label.name',
            ])
            ->add('code', null, [
                'label' => 'label.code',
            ])
            ->add('isEnabled', null, [
                'label' => 'label.enabled',
                'editable' => true,
            ])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                ),
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', null, [
                'label' => 'label.name',
                'required' => true,
            ])
            ->add('code', null, [
                'label' => 'label.code',
                'required' => true,
            ])
            ->add('isEnabled', 'checkbox', [
                'label' => 'label.enabled',
            ])
            ->setHelps([
                'isEnabled' => 'help.organization.enabled',
            ])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name', null, [
                'label' => 'label.name',
            ])
            ->add('code', null, [
                'label' => 'label.code',
            ])
            ->add('isEnabled', null, [
                'label' => 'label.enabled',
            ])
        ;
    }
}
