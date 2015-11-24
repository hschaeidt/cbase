<?php

namespace Letscode\Bundle\MagicBundle\Model;

use \Doctrine\ORM\EntityManager;
use Letscode\Bundle\MagicBundle\Entity\Attribute;
use Letscode\Bundle\MagicBundle\Entity\Card;

class CardMetadata
{
    /**
     * Card object is used and modified internally
     * @var Card
     */
    private $card;

    /**
     * Attributes mapped with Card
     * @var array
     */
    private $attributes = [];

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * Card object description text
     * @var string
     */
    private $description;

    /**
     * Regex search patterns with mapped resulting attributes
     * @var array
     */
    private $descriptionPatterns = [
        '/put.*[^\+]\d\/\d.*token/i' => ['Creature', 'Token']
    ];

    /**
     * CardMetaData constructor.
     * @param Card $card
     * @param EntityManager $em
     */
    public function __construct($card, $em)
    {
        $this->card = $card;
        $this->em = $em;
        $this->description = $this->card->getDescription();
    }

    /**
     * Sets the cards description text
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Matches the description text with the descriptionPatterns.
     * Adds matched attributes to array.
     * @return $this
     */
    public function parse()
    {
        foreach ($this->descriptionPatterns as $pattern => $attributes) {
            if (preg_match($pattern, $this->description) == 1) {
                $this->attributes = array_merge($this->attributes, $attributes);
            }
        }

        return $this;
    }

    /**
     * Searches or create new metadata objects and attaches them to the Card.
     * This function does not persist the Card object itself, as it might be good
     * practice to call it in prePersist methods from doctrine.
     *
     * It persists all newly created metadata objects.
     * @return Card
     */
    public function attachToCard()
    {
        foreach ($this->attributes as $attribute) {
            $result = $this->em->getRepository('LetscodeMagicBundle:Attribute')->findOneBy(array(
                'name' => $attribute
            ));

            if ($result == null) {
                $result = new Attribute();
                $result->setName($attribute);
                $this->em->persist($result);
            }

            if (!$this->card->hasAttribute($result)) {
                $this->card->addAttribute($result);
            }
        }

        return $this->card;
    }
}