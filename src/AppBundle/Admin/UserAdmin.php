<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UserAdmin extends AbstractAdmin
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
            ->add('username', null, [
                'label' => 'label.username',
            ])
            ->add('organization', null, [
                'label' => 'label.organization',
            ])
            ->add('email', null, [
                'label' => 'label.email',
            ])
            ->add('enabled', null, [
                'label' => 'label.enabled',
            ])
            ->add('lastLogin', null, [
                'label' => 'label.last_login',
            ])
            ->add('locked', null, [
                'label' => 'label.locked',
            ])
            ->add('roles', null, [
                'label' => 'label.roles',
            ])
            ->add('sir_id', null, [
                'label' => 'label.sir_id',
            ])
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('username', null, [
                'label' => 'label.username',
            ])
            ->add('organization', null, [
                'label' => 'label.organization',
            ])
            ->add('email', null, [
                'label' => 'label.email',
            ])
            ->add('enabled', null, [
                'label' => 'label.enabled',
                'editable' => true,
            ])
            ->add('locked', null, [
                'label' => 'label.locked',
                'editable' => true,
            ])
            ->add('roles', null, [
                'label' => 'label.roles',
                'template' => 'SonataAdminBundle:CRUD:list_roles.html.twig',
            ])
            ->add('sir_id', null, [
                'label' => 'label.sir_id',
            ])
            ->add('_action', 'actions', [
                    'actions' => [
                        'show' => [],
                        'edit' => [],
                        'delete' => [],
                    ],
                ]
            );
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('username', null, [
                'label' => 'label.username',
            ])
            ->add('organization', null, [
                'label' => 'label.organization',
            ])
            ->add('email', 'email', [
                'label' => 'label.email',
            ])
            ->add('plainPassword', 'repeated', [
                    'type' => 'password',
                    'options' => ['translation_domain' => 'FOSUserBundle'],
                    'first_options' => ['label' => 'form.new_password'],
                    'second_options' => ['label' => 'form.new_password_confirmation'],
                    'invalid_message' => 'fos_user.password.mismatch',
                    'required' => false,
                ]
            )
            ->add('enabled', null, [
                'label' => 'label.enabled',
                'required' => false,
            ])
            ->add('locked', null, [
                'label' => 'label.locked',
                'required' => false,
            ])
            ->add('roles', 'choice', [
                'label' => 'label.roles',
                'required' => true,
                'multiple' => true,
                'choices' => $this->refactorRoles(),
            ])
            ->add('sir_id', null, [
                'label' => 'label.sir_id',
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
            ->add('username', null, [
                'label' => 'label.username',
            ])
            ->add('email', null, [
                'label' => 'label.email',
            ])
            ->add('enabled', null, [
                'label' => 'label.enabled',
            ])
            ->add('locked', null, [
                'label' => 'label.locked',
            ])
            ->add('lastLogin', null, [
                'label' => 'label.last_login',
            ])
            ->add('roles', null, [
                'label' => 'label.roles',
            ])
            ->add('sir_id', null, [
                'label' => 'label.sir_id',
            ])
            ->add('folders', null, [
                'label' => 'label.folders',
            ])
            ->add('files', null, [
                'label' => 'label.files',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function postUpdate($object)
    {
        $userManager = $this->getConfigurationPool()->getContainer()->get('fos_user.user_manager');
        $userManager->updateUser($object);
    }

    private function refactorRoles()
    {
        $originRoles = $this->getConfigurationPool()->getContainer()->getParameter('security.role_hierarchy.roles');
        $roles = [];
        $rolesAdded = [];

        // Add herited roles
        foreach ($originRoles as $roleParent => $rolesHerit) {
            $tmpRoles = array_values($rolesHerit);
            $rolesAdded = array_merge($rolesAdded, $tmpRoles);
            $roles[$roleParent] = array_combine($tmpRoles, $tmpRoles);
        }
        // Add missing superparent roles
        $rolesParent = array_keys($originRoles);
        foreach ($rolesParent as $roleParent) {
            if (!in_array($roleParent, $rolesAdded)) {
                $roles['-----'][$roleParent] = $roleParent;
            }
        }

        return $roles;
    }
}
