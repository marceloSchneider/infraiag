<?php

namespace Iag\IpBundle\Entity;

use Doctrine\ORM\EntityRepository;

class IpRepository extends EntityRepository
{
    public function findFreeIp()
    {
        $sql = 'SELECT ip.id, ip.endereco '
                . 'FROM IpBundle:Ip ip '
                . 'WHERE ip.equipamento_id <> "NULL"';
        
        $rs = $this->getEntityManager()
                ->createQuery($sql)
                ->getResult();
        
        return $rs;
    }
}

