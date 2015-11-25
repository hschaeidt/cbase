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
     * Regex search patterns with mapped resulting attributes
     * @var array
     */
    private $descriptionPatterns = [];

    /**
     * CardMetaData constructor.
     * @param Card $card
     * @param EntityManager $em
     */
    public function __construct($card, $em)
    {
        $this->card = $card;
        $this->em = $em;
        $this->initSearchPatterns();
    }

    /**
     * Matches the description text with the descriptionPatterns.
     * Adds matched attributes to array.
     * @return $this
     */
    public function parse()
    {
        foreach ($this->descriptionPatterns as $pattern => $attributes) {
            if (preg_match($pattern, $this->card->getDescription()) == 1) {
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

    /**
     * Initializes the search pattern dynamically for all card descriptions to attribute mapping.
     */
    protected function initSearchPatterns()
    {
        $this->descriptionPatterns = array_merge($this->descriptionPatterns, [
            // Put a 3/3 token creature ...
            '/put.*[^\+]\d\/\d.*token/i' => [Attribute::CREATURE, Attribute::TOKEN],
            '/rally.\-/i' => [Attribute::RALLY],
            '/(^target.*)|(.*?\..target)/i' => [Attribute::ENHANCEMENT],
            '/gets?\s\+\d\/\+\d/i' => [Attribute::ENHANCEMENT],
            '/(^prevent.*)|(.*?\..prevent)/i' => [Attribute::PROTECTION],
            '/destroy/i' => [Attribute::DESTRUCTION],
            '/sacrifice/i' => [Attribute::SACRIFICE],
            '/awaken.\d/i' => [Attribute::AWAKEN],
            '/landfall.\-/i' => [Attribute::LANDFALL],
        ]);

        // Insert passives dynamically
        foreach (Attribute::getPassives() as $attribute) {
            $this->descriptionPatterns = array_merge($this->descriptionPatterns, [
                // If the card has the attribute itself on it, it is considered as passive attribute
                '/(^|,\s)'. Attribute::constToRegEx($attribute) .'/i' => [$attribute, Attribute::PASSIVE],
                // If the card grants the attribute temporary to another card or itself it is considered as active attribute
                '/gains?\s'. Attribute::constToRegEx($attribute) .'/i' => [$attribute, Attribute::ACTIVE]
            ]);
        }
    }
}