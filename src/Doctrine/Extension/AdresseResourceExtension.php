<?php

namespace App\Doctrine\Extension;

use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use App\Entity\Adresse;
use App\Entity\Kunde;
use App\Entity\KundeAdresse;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\SecurityBundle\Security;
use Doctrine\ORM\Query\Expr;

final class AdresseResourceExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
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

        if ($resourceClass === Adresse::class) {
            $queryBuilder->leftJoin(KundeAdresse::class, 'ka', Expr\Join::WITH, sprintf('ka.adresseId = %s.adresseId', $alias));
            $queryBuilder->leftJoin(Kunde::class, 'ko', Expr\Join::WITH, 'ka.kunde = ko.id');
            $queryBuilder->andWhere('ka.geloescht = false');
            $queryBuilder->andWhere('ko.vermittlerId = :vermittlerId');
            $queryBuilder->andWhere('ko.geloescht != 1');
            $queryBuilder->setParameter('vermittlerId', $vermittlerUserId);
        }
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, Operation $operation = null, array $context = []) : void
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }
}