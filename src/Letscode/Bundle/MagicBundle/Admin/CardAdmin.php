<?php

namespace Letscode\Bundle\MagicBundle\Admin;

use Letscode\Bundle\MagicBundle\Entity\Attribute;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Model\ModelManagerInterface;

class CardAdmin extends Admin
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * @var array
     */
    private $descriptionPatterns = [
        '/put.*[^\+]\d\/[^\+]\d.*token/i' => ['Creature', 'Token']
    ];

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->with("General")
        ->add('name', 'text')
        ->add('description', 'text')
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
        )->end()
        ->with('Creature')
            ->add('power', 'integer', array('required' => false))
            ->add('toughness', 'integer', array('required' => false));
    }

    /**
     * @inheritdoc
     */
    public function prePersist($object)
    {
        $result = null;
        $guessedAttribute = '';
        $em = $this->getEntityManager();
        $description = $object->getDescription();

        foreach ($this->descriptionPatterns as $pattern => $attributes) {
            //if (preg_match($pattern, $description) == 1) {
                foreach ($attributes as $attribute) {
                    $guessedAttribute = $attribute;

                    $result = $em->getRepository('LetscodeMagicBundle:Attribute')->findOneBy(array(
                        'name' => $guessedAttribute
                    ));

                    if ($result == null) {
                        $result = new Attribute();
                        $result->setName($guessedAttribute);
                        $em->persist($result);
                    }

                    if (!$object->hasAttribute($result)) {
                        $object->addAttribute($result);
                    }
                }
            //}
        }
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