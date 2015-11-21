<?php

namespace Letscode\Bundle\MagicBundle\Entity;

/**
 * Color
 */
class Color
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Letscode\Bundle\MagicBundle\Entity\ManaCost
     */
    private $manaCosts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->manaCosts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Color
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
     * Set manaCosts
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\ManaCost $manaCosts
     *
     * @return Color
     */
    public function setManaCosts(\Letscode\Bundle\MagicBundle\Entity\ManaCost $manaCosts = null)
    {
        $this->manaCosts = $manaCosts;

        return $this;
    }

    /**
     * Get manaCosts
     *
     * @return \Letscode\Bundle\MagicBundle\Entity\ManaCost
     */
    public function getManaCosts()
    {
        return $this->manaCosts;
    }

    /**
     * Add manaCost
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\ManaCost $manaCost
     *
     * @return Color
     */
    public function addManaCost(\Letscode\Bundle\MagicBundle\Entity\ManaCost $manaCost)
    {
        $this->manaCosts[] = $manaCost;

        return $this;
    }

    /**
     * Remove manaCost
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\ManaCost $manaCost
     */
    public function removeManaCost(\Letscode\Bundle\MagicBundle\Entity\ManaCost $manaCost)
    {
        $this->manaCosts->removeElement($manaCost);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
