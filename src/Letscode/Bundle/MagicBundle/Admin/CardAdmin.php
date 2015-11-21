<?php

namespace Letscode\Bundle\MagicBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CardAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->with("General")
        ->add('name', 'text')
        ->add('convertedManaCost', 'integer')
        ->add(
            'manaCosts', 'sonata_type_model', array(
                'class' => 'Letscode\Bundle\MagicBundle\Entity\ManaCost',
                'expanded' => false,
                'by_reference' => false,
                'multiple' => true
        ))
        ->add('cardTypes', 'sonata_type_model', array(
            'class' => 'Letscode\Bundle\MagicBundle\Entity\CardType',
            'expanded' => false,
            'by_reference' => false,
            'multiple' => true
        ))
        ->add(
            'colors', 'sonata_type_model', array(
                'class' => 'Letscode\Bundle\MagicBundle\Entity\Color',
                'property' => 'name',
                'expanded' => false,
                'by_reference' => false,
                'multiple' => true
            )
        )
        ->add(
            'attributes', 'sonata_type_model', array(
                'class' => 'Letscode\Bundle\MagicBundle\Entity\Attribute',
                'property' => 'name',
                'expanded' => false,
                'by_reference' => false,
                'multiple' => true,
                'required' => false
            )
        )
        ->add(
            'effects', 'sonata_type_model', array(
                'class' => 'Letscode\Bundle\MagicBundle\Entity\Effect',
                'property' => 'name',
                'expanded' => false,
                'by_reference' => false,
                'multiple' => true,
                'required' => false
            )
        )
        ->add(
            'editions', 'sonata_type_model', array(
                'class' => 'Letscode\Bundle\MagicBundle\Entity\Edition',
                'property' => 'name',
                'expanded' => false,
                'by_reference' => false,
                'multiple' => true
            )
        )->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')
        ->addIdentifier('colors')
        ->addIdentifier('editions');
    }
}