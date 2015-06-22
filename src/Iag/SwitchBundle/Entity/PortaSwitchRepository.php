<?php

namespace Iag\SwitchBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PortaSwitchRepository extends EntityRepository
{
    public function deletePortasBySwitchId($switchId)
    {
        $em = $this->getEntityManager()
                ->createQuery('DELETE FROM IagSwitchBundle:PortaSwitch p WHERE p.switch = :switchId')
                ->setParameter('switchId', $switchId)
                ->execute();
    }
}

