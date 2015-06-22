<?php

namespace Iag\IpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ip
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Iag\IpBundle\Entity\IpRepository")
 */
class Ip
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Iag\VlanBundle\Entity\Vlan", inversedBy="ips")
     * @ORM\JoinColumn(name="vlan_id", referencedColumnName="id")
     */
    protected $vlan;

    
    /**
     * @ORM\Column(type="boolean", options={"default":0}, nullable=true)
     */
    protected $status;
            
    /**
     * @Assert\Ip
     * @var strings
     * @ORM\Column(name="endereco", type="string", length=255, unique=true)
     */
    private $endereco;
    
    /**
     *
     * @var \Iag\IpBundle\Entity\Ip
     * 
     * @ORM\OneToOne(targetEntity="Iag\SwitchBundle\Entity\SwitchCommon", mappedBy="ip")
     */
    private $switch;
    
   
    public function __toString() {
        $endereco = $this->endereco . ' Vlan ' . $this->vlan;
        return $endereco;
    }
    
   

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Ip
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set endereco
     *
     * @param string $endereco
     * @return Ip
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get endereco
     *
     * @return string 
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set vlan
     *
     * @param \Iag\VlanBundle\Entity\Vlan $vlan
     * @return Ip
     */
    public function setVlan(\Iag\VlanBundle\Entity\Vlan $vlan = null)
    {
        $this->vlan = $vlan;

        return $this;
    }

    /**
     * Get vlan
     *
     * @return \Iag\VlanBundle\Entity\Vlan 
     */
    public function getVlan()
    {
        return $this->vlan;
    }
}
