<?php

namespace App\Doctrine\Extension;

use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use App\Entity\Kunde;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\SecurityBundle\Security;

final class KundeResourceExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{

    private Security $security;


    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, Operation $operation = null, array $context = []): void
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }


    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass): void
    {
        $alias = current($queryBuilder->getRootAliases());
        $vermittlerUserId = $this->security->getUser()->getVermittler()->getId();

        if ($resourceClass === Kunde::class) {
            $queryBuilder->andWhere(sprintf('%s.geloescht != 1', $alias));
            $queryBuilder->andWhere(sprintf('%s.vermittlerId = :vermittlerId', $alias));
            $queryBuilder->setParameter('vermittlerId', $vermittlerUserId);
        }
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, Operation $operation = null, array $context = []) : void
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }
}