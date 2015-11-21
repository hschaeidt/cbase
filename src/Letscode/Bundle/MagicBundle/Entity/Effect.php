<?php

namespace Letscode\Bundle\MagicBundle\Entity;

/**
 * Effect
 */
class Effect
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $manaCosts;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $attributes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attributes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Effect
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
     * Add attribute
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\Attribute $attribute
     *
     * @return Effect
     */
    public function addAttribute(\Letscode\Bundle\MagicBundle\Entity\Attribute $attribute)
    {
        $this->attributes[] = $attribute;

        return $this;
    }

    /**
     * Remove attribute
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\Attribute $attribute
     */
    public function removeAttribute(\Letscode\Bundle\MagicBundle\Entity\Attribute $attribute)
    {
        $this->attributes->removeElement($attribute);
    }

    /**
     * Get attributes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Add manaCost
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\ManaCost $manaCost
     *
     * @return Effect
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
     * Get manaCosts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getManaCosts()
    {
        return $this->manaCosts;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
