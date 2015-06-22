<?php

namespace Iag\SwitchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Pilha
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Pilha
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
     * @ORM\ManyToOne(targetEntity="Iag\InfraBundle\Entity\Rack", inversedBy="racks")
     * @ORM\JoinColumn(name="rack_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $rack;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="Switchs", mappedBy="pilha")
     */
    private $switchs;

    /**
     * @var string
     *
     * @ORM\Column(name="hostname", type="string", length=255)
     */
    private $hostname;

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
     * Set ip
     *
     * @param string $ip
     * @return Pilha
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set rack
     *
     * @param string $rack
     * @return Pilha
     */
    public function setRack($rack)
    {
        $this->rack = $rack;

        return $this;
    }

    /**
     * Get rack
     *
     * @return string 
     */
    public function getRack()
    {
        return $this->rack;
    }

    /**
     * Set switchs
     *
     * @param string $switchs
     * @return Pilha
     */
    public function setSwitchs($switchs)
    {
        $this->switchs = $switchs;

        return $this;
    }

    /**
     * Get switchs
     *
     * @return string 
     */
    public function getSwitchs()
    {
        return $this->switchs;
    }

    /**
     * Set hostname
     *
     * @param string $hostname
     * @return Pilha
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
     * Constructor
     */
    public function __construct()
    {
        $this->switchs = new ArrayCollection();
    }

    /**
     * Add switchs
     *
     * @param \Iag\SwitchBundle\Entity\Iag/SwitchBundle/Switchs $switchs
     * @return Pilha
     */
    public function addSwitch(\Iag\SwitchBundle\Entity\Switchs $switchs)
    {
        $this->switchs[] = $switchs;

        return $this;
    }

    /**
     * Remove switchs
     *
     * @param \Iag\SwitchBundle\Entity\Iag/SwitchBundle/Switchs $switchs
     */
    public function removeSwitch(\Iag\SwitchBundle\Entity\Switchs $switchs)
    {
        $this->switchs->removeElement($switchs);
    }
}
