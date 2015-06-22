<?php

namespace Iag\VlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Vlan
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Iag\VlanBundle\Entity\VlanRepository")
 */
class Vlan
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
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255)
     */
    private $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="endereco", type="string", length=255)
     */
    private $endereco;

    /**
     * @var string
     *
     * @ORM\Column(name="vlan_range", type="string", length=255)
     */
    private $vlanRange;
    
    /**
     *@ORM\OneToMany(targetEntity="Iag\IpBundle\Entity\Ip", mappedBy="vlan")
     */
    protected $ips;
    
    /**
     *
     * @var \Iag\SwitchBundle\Entity\PortaSwitch
     * 
     * @ORM\ManyToMany(targetEntity="Iag\SwitchBundle\Entity\PortaSwitch", mappedBy="vlan")
     */
    protected $portaSwitch;


    public function __toString() {
        return (String) $this->descricao;
    }
    
    public function __construct() {
        $this->ips = new ArrayCollection();
        $this->portaSwitch = new ArrayCollection();
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
     * Set descricao
     *
     * @param string $descricao
     * @return Vlan
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set endereco
     *
     * @param string $endereco
     * @return Vlan
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
     * Set vlanRange
     *
     * @param string $vlanRange
     * @return Vlan
     */
    public function setVlanRange($vlanRange)
    {
        $this->vlanRange = $vlanRange;

        return $this;
    }

    /**
     * Get vlanRange
     *
     * @return string 
     */
    public function getVlanRange()
    {
        return $this->vlanRange;
    }

    /**
     * Add ips
     *
     * @param \Iag\IpBundle\Entity\Ip $ips
     * @return Vlan
     */
    public function addIp(\Iag\IpBundle\Entity\Ip $ips)
    {
        $this->ips[] = $ips;

        return $this;
    }

    /**
     * Remove ips
     *
     * @param \Iag\IpBundle\Entity\Ip $ips
     */
    public function removeIp(\Iag\IpBundle\Entity\Ip $ips)
    {
        $this->ips->removeElement($ips);
    }

    /**
     * Get ips
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIps()
    {
        return $this->ips;
    }

    /**
     * Set portaSwitch
     *
     * @param \Iag\SwitchBundle\Entity\PortaSwitch $portaSwitch
     * @return Vlan
     */
    public function setPortaSwitch(\Iag\SwitchBundle\Entity\PortaSwitch $portaSwitch = null)
    {
        $this->portaSwitch = $portaSwitch;

        return $this;
    }

    /**
     * Get portaSwitch
     *
     * @return \Iag\SwitchBundle\Entity\PortaSwitch 
     */
    public function getPortaSwitch()
    {
        return $this->portaSwitch;
    }
}
