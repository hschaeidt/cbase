<?php

namespace Letscode\Bundle\MagicBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Card
 */
class Card
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
     * @var Collection
     */
    private $colors;

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
     * @return Card
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
     * Constructor
     */
    public function __construct()
    {
        $this->colors = new ArrayCollection();
    }

    /**
     * Add color
     *
     * @param Color $color
     *
     * @return Card
     */
    public function addColor(Color $color)
    {
        $this->colors[] = $color;

        return $this;
    }

    /**
     * Remove color
     *
     * @param Color $color
     */
    public function removeColor(Color $color)
    {
        $this->colors->removeElement($color);
    }

    /**
     * Get colors
     *
     * @return Collection
     */
    public function getColors()
    {
        return $this->colors;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $editions;


    /**
     * Add edition
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\Edition $edition
     *
     * @return Card
     */
    public function addEdition(\Letscode\Bundle\MagicBundle\Entity\Edition $edition)
    {
        $this->editions[] = $edition;

        return $this;
    }

    /**
     * Remove edition
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\Edition $edition
     */
    public function removeEdition(\Letscode\Bundle\MagicBundle\Entity\Edition $edition)
    {
        $this->editions->removeElement($edition);
    }

    /**
     * Get editions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEditions()
    {
        return $this->editions;
    }
}
