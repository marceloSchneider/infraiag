<?php

namespace Iag\SwitchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PortaSwitch
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Iag\SwitchBundle\Entity\PortaSwitchRepository")
 */
class PortaSwitch
{
    
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_porta", type="string")
     */
    private $numPorta;
    

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_POE", type="boolean", nullable=true)
     */
    private $isPOE;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="POE_status", type="boolean", nullable=true)
     */
    private $pOEStatus;

    /**
     *@ORM\ManyToOne(targetEntity="Switchs", inversedBy="portas")
     *@ORM\JoinColumn(name="switch_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $switch;
    
    /**
     *
     * @var type 
     * 
     * @ORM\OneToOne(targetEntity="Iag\InfraBundle\Entity\Espelhamento", mappedBy="porta")
     */
    private $espelhamento;
    
    /**
     *
     * @var type 
     * 
     *  @ORM\OneToOne(targetEntity="Iag\InfraBundle\Entity\PPorta", mappedBy="porta")
     *  @ORM\JoinColumn(name="pporta_id", referencedColumnName="id")
     */
    private $pporta;
    
    /**
     *
     * @var \Iag\VlanBundle\Entity\Vlan
     * 
     * @ORM\ManyToMany(targetEntity="Iag\VlanBundle\Entity\Vlan", inversedBy="portaSwitch")
     * @ORM\JoinColumn(name="vlan_id", referencedColumnName="id", nullable=true)
     */
    private $vlan;

    public function __toString() {
        return (string) $this->switch . ' - ' . $this->getNumPorta();
    }

    public function __construct() {
        $this->vlan = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set numPorta
     *
     * @param string $numPorta
     * @return PortaSwitch
     */
    public function setNumPorta($numPorta)
    {
        $this->numPorta = $numPorta;

        return $this;
    }

    /**
     * Get numPorta
     *
     * @return string 
     */
    public function getNumPorta()
    {
        return $this->numPorta;
    }

    /**
     * Set isPOE
     *
     * @param boolean $isPOE
     * @return PortaSwitch
     */
    public function setIsPOE($isPOE)
    {
        $this->isPOE = $isPOE;

        return $this;
    }

    /**
     * Get isPOE
     *
     * @return boolean 
     */
    public function getIsPOE()
    {
        return $this->isPOE;
    }

    /**
     * Set pOEStatus
     *
     * @param boolean $pOEStatus
     * @return PortaSwitch
     */
    public function setPOEStatus($pOEStatus)
    {
        $this->pOEStatus = $pOEStatus;

        return $this;
    }

    /**
     * Get pOEStatus
     *
     * @return boolean 
     */
    public function getPOEStatus()
    {
        return $this->pOEStatus;
    }

    /**
     * Set switch
     *
     * @param \Iag\SwitchBundle\Entity\Switchs $switch
     * @return PortaSwitch
     */
    public function setSwitch(\Iag\SwitchBundle\Entity\Switchs $switch = null)
    {
        $this->switch = $switch;

        return $this;
    }

    /**
     * Get switch
     *
     * @return \Iag\SwitchBundle\Entity\Switchs 
     */
    public function getSwitch()
    {
        return $this->switch;
    }

    /**
     * Set espelhamento
     *
     * @param \Iag\InfraBundle\Entity\Espelhamento $espelhamento
     * @return PortaSwitch
     */
    public function setEspelhamento(\Iag\InfraBundle\Entity\Espelhamento $espelhamento = null)
    {
        $this->espelhamento = $espelhamento;

        return $this;
    }

    /**
     * Get espelhamento
     *
     * @return \Iag\InfraBundle\Entity\Espelhamento 
     */
    public function getEspelhamento()
    {
        return $this->espelhamento;
    }

    /**
     * Set pporta
     *
     * @param \Iag\InfraBundle\Entity\PPorta $pporta
     * @return PortaSwitch
     */
    public function setPporta(\Iag\InfraBundle\Entity\PPorta $pporta = null)
    {
        $this->pporta = $pporta;

        return $this;
    }

    /**
     * Get pporta
     *
     * @return \Iag\InfraBundle\Entity\PPorta 
     */
    public function getPporta()
    {
        return $this->pporta;
    }

    /**
     * Set vlan
     *
     * @param \Iag\VlanBundle\Entity\Vlan $vlan
     * @return PortaSwitch
     */
    public function setVlan(\Iag\VlanBundle\Entity\Vlan $vlan = null)
    {
        $this->vlan[] = $vlan;

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

    /**
     * Add vlan
     *
     * @param \Iag\VlanBundle\Entity\Vlan $vlan
     * @return PortaSwitch
     */
    public function addVlan(\Iag\VlanBundle\Entity\Vlan $vlan)
    {
        $this->vlan[] = $vlan;

        return $this;
    }

    /**
     * Remove vlan
     *
     * @param \Iag\VlanBundle\Entity\Vlan $vlan
     */
    public function removeVlan(\Iag\VlanBundle\Entity\Vlan $vlan)
    {
        $this->vlan->removeElement($vlan);
    }
}
