<?php

namespace Letscode\Bundle\MagicBundle\Entity;

/**
 * ManaCost
 */
class ManaCost
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $sum;

    /**
     * @var \Letscode\Bundle\MagicBundle\Entity\Card
     */
    private $card;

    /**
     * @var \Letscode\Bundle\MagicBundle\Entity\Color
     */
    private $color;

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
     * Set sum
     *
     * @param integer $sum
     *
     * @return ManaCost
     */
    public function setSum($sum)
    {
        $this->sum = $sum;

        return $this;
    }

    /**
     * Get sum
     *
     * @return integer
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * Set card
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\Card $card
     *
     * @return ManaCost
     */
    public function setCard(\Letscode\Bundle\MagicBundle\Entity\Card $card = null)
    {
        $this->card = $card;

        return $this;
    }

    /**
     * Get card
     *
     * @return \Letscode\Bundle\MagicBundle\Entity\Card
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * Set color
     *
     * @param \Letscode\Bundle\MagicBundle\Entity\Color $color
     *
     * @return ManaCost
     */
    public function setColor(\Letscode\Bundle\MagicBundle\Entity\Color $color = null)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return \Letscode\Bundle\MagicBundle\Entity\Color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->color . ": " . $this->sum;
    }
}
