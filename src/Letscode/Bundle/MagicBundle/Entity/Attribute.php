<?php

namespace Letscode\Bundle\MagicBundle\Entity;

/**
 * Attribute
 */
class Attribute
{
    const ACTIVE = 'Active';
    const PASSIVE = 'Passive';
    # Passives, actives
    # Permanent effects applied to cards without the need for activation or interaction.
    # Some cards may also assign passives to other cards (temporary), in this case we treat it as an active.
    const VIGILANCE = 'Vigilance';
    const MENACE = 'Menace';
    const HASTE = 'Haste';
    const FIRST_STRIKE = 'First strike';
    const FLYING = 'Flying';
    const TRAMPLE = 'Trample';

    # Markers
    # Used for search and filtering
    const TOKEN = 'Token';
    const CREATURE = 'Creature';
    const RALLY = 'Rally';
    const ENHANCEMENT = 'Enhancement';
    const PROTECTION = 'Protection';
    const DESTRUCTION = 'Destruction';
    const AWAKEN = 'Awaken';
    const LANDFALL = 'Landfall';
    const SACRIFICE = 'Sacrifice';

    /**
     * Gets a list of all passive attributes (effects)
     *
     * @return array
     */
    public static function getPassives()
    {
        return [
            static::MENACE,
            static::HASTE,
            static::VIGILANCE,
            static::FLYING,
            static::FIRST_STRIKE,
        ];
    }

    /**
     * Transforms a attribute constant into the regex format.
     * Useful for parsing descriptions for attributes.
     *
     * @param $const
     * @return string
     */
    public static function constToRegEx($const)
    {
        return strtolower(str_replace(' ', '\s', $const));
    }

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
