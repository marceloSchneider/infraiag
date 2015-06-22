<?php

namespace Iag\SwitchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="SwitchCommon",uniqueConstraints={@ORM\UniqueConstraint(name="SwitchcommonIpHosnameRack", columns={"hostname", "ip_id", "rack_id"})})
 * @ORM\Entity
 */
class SwitchCommon 
{
    /**
     *
     * @var type integer
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     *
     * @var type Switchs
     * @ORM\OneToMany(targetEntity="Switchs", mappedBy="switchCommon")
     */
    private $switch;
    
    /**
     *
     * @var type Iag\IpBundle\Entity\Ip
     * @ORM\OneToOne(targetEntity="Iag\IpBundle\Entity\Ip", inversedBy="switch")
     * @ORM\JoinColumn(name="ip_id", referencedColumnName="id", unique=false)
     */
    private $ip;
    
    
   /**
     * @var string
     *
     * @ORM\Column(name="hostname", type="string", length=255)
     */
    private $hostname;
    
    
    /**
     *
     * @var type 
     * 
     * @ORM\ManyToOne(targetEntity="Iag\InfraBundle\Entity\Rack", inversedBy="switchs")
     * @ORM\JoinColumn(name="rack_id", referencedColumnName="id", nullable=true)
     */    
    private $rack;
    /**
     * Constructor
     */
    
    public function __toString() {
        return $this->hostname;
    }
    
    public function __construct()
    {
        $this->switch = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set hostname
     *
     * @param string $hostname
     * @return SwitchCommon
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * Get hostname
     *
     * @return string 
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * Add switch
     *
     * @param \Iag\SwitchBundle\Entity\Switchs $switch
     * @return SwitchCommon
     */
    public function addSwitch(\Iag\SwitchBundle\Entity\Switchs $switch)
    {
        $this->switch[] = $switch;

        return $this;
    }

    /**
     * Remove switch
     *
     * @param \Iag\SwitchBundle\Entity\Switchs $switch
     */
    public function removeSwitch(\Iag\SwitchBundle\Entity\Switchs $switch)
    {
        $this->switch->removeElement($switch);
    }

    /**
     * Get switch
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSwitch()
    {
        return $this->switch;
    }

    /**
     * Set ip
     *
     * @param \Iag\IpBundle\Entity\Ip $ip
     * @return SwitchCommon
     */
    public function setIp(\Iag\IpBundle\Entity\Ip $ip = null)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return \Iag\IpBundle\Entity\Ip 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set rack
     *
     * @param \Iag\InfraBundle\Entity\Rack $rack
     * @return SwitchCommon
     */
    public function setRack(\Iag\InfraBundle\Entity\Rack $rack)
    {
        $this->rack = $rack;

        return $this;
    }

    /**
     * Get rack
     *
     * @return \Iag\InfraBundle\Entity\Rack 
     */
    public function getRack()
    {
        return $this->rack;
    }
}
