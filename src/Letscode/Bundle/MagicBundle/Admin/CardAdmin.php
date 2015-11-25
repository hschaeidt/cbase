<?php

namespace Letscode\Bundle\MagicBundle\Admin;

use Letscode\Bundle\MagicBundle\Model\Factory\CardMetadataFactory;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Model\ModelManagerInterface;

class CardAdmin extends Admin
{
    /** @var CardMetadataFactory */
    protected $metadataFactory;

    /**
     * @param CardMetadataFactory $metadataFactory
     */
    public function setMetadataFactory($metadataFactory)
    {
        $this->metadataFactory = $metadataFactory;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->with("General")
        ->add('name', 'text')
        ->add('description', 'textarea', array('required' => false))
        ->add('flavorText', 'textarea', array('required' => false))
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
        ->add('cardSubTypes', 'sonata_type_model', array(
            'class' => 'Letscode\Bundle\MagicBundle\Entity\CardSubType',
            'expanded' => false,
            'by_reference' => false,
            'multiple' => true,
            'required' => false
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
            'rarity', 'sonata_type_model', array(
                'class' => 'Letscode\Bundle\MagicBundle\Entity\Rarity',
                'property' => 'name',
                'expanded' => false,
                'by_reference' => false,
                'multiple' => false
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
        )->end()
        ->with('Creature')
            ->add('power', 'integer', array('required' => false))
            ->add('toughness', 'integer', array('required' => false))
            ->end()
        ->with('Auto Filled')
            ->add('convertedManaCost', 'integer', array('required' => false))
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
            );
    }

    /**
     * @inheritdoc
     * @param Card
     */
    public function prePersist($card)
    {
        $metaData = $this->metadataFactory->create($card);
        $metaData->parse()->attachToCard();
    }

    public function preUpdate($card)
    {
        $this->prePersist($card);
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