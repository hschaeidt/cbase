<?php

namespace Letscode\Bundle\MagicBundle\Entity;

/**
 * Attribute
 */
class Attribute
{
    const TOKEN = 'Token';
    const CREATURE = 'Creature';
    const TRAMPLE = 'Trample';
    const RALLY = 'Rally';
    const ENHANCEMENT = 'Enhancement';
    const PROTECTION = 'Protection';
    const DESTRUCTION = 'Destruction';
    const AWAKEN = 'Awaken';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->effects = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Attribute
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
