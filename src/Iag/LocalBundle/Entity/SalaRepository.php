<?php

namespace Iag\LocalBundle\Entity;

use Doctrine\ORM\EntityRepository;

class SalaRepository extends EntityRepository
{
    public function getLocalBySalaId($salaId)
    {
        return $this->getEntityManager()
                ->createQuery(
                            'SELECT p.nome pavimento, b.nome bloco, s.numero sala '
                            . 'FROM IagLocalBundle:Bloco as b '
                            . 'INNER JOIN IagLocalBundle:Pavimento as p WITH b.id = p.bloco '
                            . 'INNER JOIN IagLocalBundle:Sala as s WITH p.id = s.pavimento '
                            . 'WHERE s.id = :salaId'
                        )
                ->setParameter('salaId', $salaId)
                ->getResult();
    }
}


