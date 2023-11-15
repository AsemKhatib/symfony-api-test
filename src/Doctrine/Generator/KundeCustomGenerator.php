<?php

namespace App\Doctrine\Generator;

use Doctrine\ORM\EntityManager;
use Exception;
use Throwable;
use Doctrine\ORM\Id\AbstractIdGenerator;

class KundeCustomGenerator extends AbstractIdGenerator
{
    private const LENGTH = 8;
    private const CHARACTERS = '0123456789ABCDEF';

    /**
     * @throws Throwable
     */
    public function generate(EntityManager $em, $entity): string
    {
        return $this->idMaker();
    }

    /**
     * @throws Throwable
     */
    private function idMaker(): string
    {
        $id = '';

        for ($i = 0; $i < self::LENGTH; $i++) {
            $id .= $this->generateRandomCharacter();
        }

        return $id;
    }

    /**
     * @throws Throwable
     */
    private function generateRandomCharacter(): string
    {
        try {
            return self::CHARACTERS[random_int(0, strlen(self::CHARACTERS) - 1)];
        } catch (Throwable $throwable) {
            throw new Exception(
                $throwable->getMessage(),
                $throwable->getCode(),
                $throwable->getPrevious()
            );
        }
    }
}
