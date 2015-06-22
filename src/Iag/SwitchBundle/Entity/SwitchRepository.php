<?php

namespace Iag\SwitchBundle\Entity;

use Doctrine\ORM\EntityRepository;

class SwitchRepository extends EntityRepository
{
    public function findAllRegs()
    {
        $rs = $this->getEntityManager()
                ->createQuery(
                        'SELECT s, ip.endereco'
                        . 'FROM SwitchBundle s'
                        . 'INNER JOIN IpBundle as ip ON ip.equipament = s.id'
                  )
                ->getResult();
        return $rs;
    }
}