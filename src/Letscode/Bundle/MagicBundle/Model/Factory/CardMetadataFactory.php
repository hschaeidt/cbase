<?php

namespace Letscode\Bundle\MagicBundle\Model\Factory;

use Doctrine\ORM\EntityManager;
use Letscode\Bundle\MagicBundle\Entity\Card;
use Letscode\Bundle\MagicBundle\Model\CardMetadata;

class CardMetadataFactory
{
    /** @var EntityManager */
    private $entityManager;

    /**
     * CardMetadataFactory constructor.
     * @param EntityManager $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Card $card
     * @return CardMetadata
     */
    public function create($card)
    {
        return new CardMetadata($card, $this->entityManager);
    }
}