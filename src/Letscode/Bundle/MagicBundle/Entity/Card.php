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
     * @var integer
     */
    private $convertedManaCost;

    /**
     * @var \Letscode\Bundle\MagicBundle\Entity\ManaCost
     */
    private $manaCosts;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $cardTypes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $effects;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $attributes;

    /**
     * @var integer
     */
    private $power;

    /**
     * @var integer
     */
    private $toughness;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \Letscode\Bundle\MagicBundle\Entity\Rarity
     */
    private $rarity;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $cardSubTypes;

    /**
     * @var string
     */
    private $flavorText;

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

    /**
     * Set convertedManaCost
     *
     * @param integer $convertedManaCost
     *
     * @return Card
     */
    public function setConvertedManaCost($convertedManaCost)
    {
        $this->convertedManaCost = $convertedManaCost;

        return $this;
    }

    /**
     * Get convertedManaCost
     *
     * @return integer
     */
    public function getConvertedManaCost()
    {
        return $this->convertedManaCost;
    }

    /**
     * Set manaCosts
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\ManaCost $manaCosts
     *
     * @return Card
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
     * @return Card
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
     * Add cardType
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\CardType $cardType
     *
     * @return Card
     */
    public function addCardType(\Letscode\Bundle\MagicBundle\Entity\CardType $cardType)
    {
        $this->cardTypes[] = $cardType;

        return $this;
    }

    /**
     * Remove cardType
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\CardType $cardType
     */
    public function removeCardType(\Letscode\Bundle\MagicBundle\Entity\CardType $cardType)
    {
        $this->cardTypes->removeElement($cardType);
    }

    /**
     * Get cardTypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCardTypes()
    {
        return $this->cardTypes;
    }

    /**
     * Add effect
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\Effect $effect
     *
     * @return Card
     */
    public function addEffect(\Letscode\Bundle\MagicBundle\Entity\Effect $effect)
    {
        $this->effects[] = $effect;

        return $this;
    }

    /**
     * Remove effect
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\Effect $effect
     */
    public function removeEffect(\Letscode\Bundle\MagicBundle\Entity\Effect $effect)
    {
        $this->effects->removeElement($effect);
    }

    /**
     * Get effects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEffects()
    {
        return $this->effects;
    }

    /**
     * Add attribute
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\Attribute $attribute
     *
     * @return Card
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
     * @param Attribute $attribute
     * @return bool
     */
    public function hasAttribute(\Letscode\Bundle\MagicBundle\Entity\Attribute $attribute)
    {
        if (is_object($this->attributes) && $this->attributes->contains($attribute)) {
            return true;
        }
        return false;
    }

    /**
     * Set power
     *
     * @param integer $power
     *
     * @return Card
     */
    public function setPower($power)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power
     *
     * @return integer
     */
    public function getPower()
    {
        return $this->power;
    }

    /**
     * Set toughness
     *
     * @param integer $toughness
     *
     * @return Card
     */
    public function setToughness($toughness)
    {
        $this->toughness = $toughness;

        return $this;
    }

    /**
     * Get toughness
     *
     * @return integer
     */
    public function getToughness()
    {
        return $this->toughness;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Card
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set rarity
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\Rarity $rarity
     *
     * @return Card
     */
    public function setRarity(\Letscode\Bundle\MagicBundle\Entity\Rarity $rarity = null)
    {
        $this->rarity = $rarity;

        return $this;
    }

    /**
     * Get rarity
     *
     * @return \Letscode\Bundle\MagicBundle\Entity\Rarity
     */
    public function getRarity()
    {
        return $this->rarity;
    }

    /**
     * Add cardSubType
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\CardSubType $cardSubType
     *
     * @return Card
     */
    public function addCardSubType(\Letscode\Bundle\MagicBundle\Entity\CardSubType $cardSubType)
    {
        $this->cardSubTypes[] = $cardSubType;

        return $this;
    }

    /**
     * Remove cardSubType
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\CardSubType $cardSubType
     */
    public function removeCardSubType(\Letscode\Bundle\MagicBundle\Entity\CardSubType $cardSubType)
    {
        $this->cardSubTypes->removeElement($cardSubType);
    }

    /**
     * Get cardSubTypes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCardSubTypes()
    {
        return $this->cardSubTypes;
    }


    /**
     * Set flavorText
     *
     * @param string $flavorText
     *
     * @return Card
     */
    public function setFlavorText($flavorText)
    {
        $this->flavorText = $flavorText;

        return $this;
    }

    /**
     * Get flavorText
     *
     * @return string
     */
    public function getFlavorText()
    {
        return $this->flavorText;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}
