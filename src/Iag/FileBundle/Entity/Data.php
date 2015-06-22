<?php

namespace Iag\FileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="LoadData")
 */
class Data 
{
    /**
     *
     * @var int
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     *
     * @var string
     * @ORM\Column(name="bloco", type="string", nullable=true) 
     */
    private $bloco;
    
    /**
     *
     * @var string
     * @ORM\Column(name="andar", type="string", nullable=true)
     */
    private $andar;
    
    /**
     *
     * @var string
     * @ORM\Column(name="sala", type="string", nullable=true)
     */
    private $sala;
    
    /**
     *
     * @var string
     * @ORM\Column(name="patch", type="string", nullable=true)
     */
    private $patch;
    
    /**
     *
     * @var string
     * @ORM\Column(name="switch", type="string", nullable=true)
     */
    private $switch;
    
    /**
     *
     * @var string
     * @ORM\Column(name="ip", type="string", nullable=true)
     */
    private $ip;
    
    /**
     *
     * @var string
     * @ORM\Column(name="identSwitch", type="string", nullable=true)
     */
    private $identSwitch;
    
    /**
     *
     * @var int
     * @ORM\Column(name="porta_switch", type="integer", nullable=true)
     */
    private $portaSwitch;
    
    /**
     *
     * @var string
     * @ORM\Column(name="wireless", type="string", nullable=true)
     */
    private $wireless;
    
    /**
     *
     * @var string
     * @ORM\Column(name="ip_camera", type="string", nullable=true)
     */
    private $ipCamera;
    
    /**
     *
     * @var int
     * @ORM\Column(name="vlan", type="integer", nullable=true)
     */
    private $vlan;
    
    /**
     *
     * @var string
     * @ORM\Column(name="sala_rack", type="string", nullable=true)
     */
    private $salaRack;
    
    /**
     *
     * @var string
     * @ORM\Column(name="ident_rack", type="string", nullable=true)
     */
    private $identRack;
    
    /**
     *
     * @var int
     * @ORM\Column(name="ramal", type="integer", nullable=true)
     */
    private $ramal;
    
    /**
     *
     * @var int
     * @ORM\Column(name="rack_central", type="integer", nullable=true)
     */
    private $rackCentral;
    
    /**
     *
     * @var int
     * @ORM\Column(name="tel_a04", type="integer", nullable=true)
     */
    private $telPassagemA;
    
    /**
     *
     * @var int
     * @ORM\Column(name="tel_g212", type="integer", nullable=true)
     */
    private $telPassagemB;

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
     * Set bloco
     *
     * @param string $bloco
     *
     * @return Data
     */
    public function setBloco($bloco)
    {
        $this->bloco = $bloco;

        return $this;
    }

    /**
     * Get bloco
     *
     * @return string
     */
    public function getBloco()
    {
        return $this->bloco;
    }

    /**
     * Set andar
     *
     * @param string $andar
     *
     * @return Data
     */
    public function setAndar($andar)
    {
        $this->andar = $andar;

        return $this;
    }

    /**
     * Get andar
     *
     * @return string
     */
    public function getAndar()
    {
        return $this->andar;
    }

    /**
     * Set sala
     *
     * @param string $sala
     *
     * @return Data
     */
    public function setSala($sala)
    {
        $this->sala = $sala;

        return $this;
    }

    /**
     * Get sala
     *
     * @return string
     */
    public function getSala()
    {
        return $this->sala;
    }

    /**
     * Set patch
     *
     * @param string $patch
     *
     * @return Data
     */
    public function setPatch($patch)
    {
        $this->patch = $patch;

        return $this;
    }

    /**
     * Get patch
     *
     * @return string
     */
    public function getPatch()
    {
        return $this->patch;
    }

    /**
     * Set switch
     *
     * @param string $switch
     *
     * @return Data
     */
    public function setSwitch($switch)
    {
        $this->switch = $switch;

        return $this;
    }

    /**
     * Get switch
     *
     * @return string
     */
    public function getSwitch()
    {
        return $this->switch;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Data
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
     * Set identSwitch
     *
     * @param string $identSwitch
     *
     * @return Data
     */
    public function setIdentSwitch($identSwitch)
    {
        $this->identSwitch = $identSwitch;

        return $this;
    }

    /**
     * Get identSwitch
     *
     * @return string
     */
    public function getIdentSwitch()
    {
        return $this->identSwitch;
    }

    /**
     * Set portaSwitch
     *
     * @param integer $portaSwitch
     *
     * @return Data
     */
    public function setPortaSwitch($portaSwitch)
    {
        $this->portaSwitch = $portaSwitch;

        return $this;
    }

    /**
     * Get portaSwitch
     *
     * @return integer
     */
    public function getPortaSwitch()
    {
        return $this->portaSwitch;
    }

    /**
     * Set wireless
     *
     * @param string $wireless
     *
     * @return Data
     */
    public function setWireless($wireless)
    {
        $this->wireless = $wireless;

        return $this;
    }

    /**
     * Get wireless
     *
     * @return string
     */
    public function getWireless()
    {
        return $this->wireless;
    }

    /**
     * Set ipCamera
     *
     * @param string $ipCamera
     *
     * @return Data
     */
    public function setIpCamera($ipCamera)
    {
        $this->ipCamera = $ipCamera;

        return $this;
    }

    /**
     * Get ipCamera
     *
     * @return string
     */
    public function getIpCamera()
    {
        return $this->ipCamera;
    }

    /**
     * Set vlan
     *
     * @param integer $vlan
     *
     * @return Data
     */
    public function setVlan($vlan)
    {
        $this->vlan = $vlan;

        return $this;
    }

    /**
     * Get vlan
     *
     * @return integer
     */
    public function getVlan()
    {
        return $this->vlan;
    }

    /**
     * Set salaRack
     *
     * @param string $salaRack
     *
     * @return Data
     */
    public function setSalaRack($salaRack)
    {
        $this->salaRack = $salaRack;

        return $this;
    }

    /**
     * Get salaRack
     *
     * @return string
     */
    public function getSalaRack()
    {
        return $this->salaRack;
    }

    /**
     * Set identRack
     *
     * @param string $identRack
     *
     * @return Data
     */
    public function setIdentRack($identRack)
    {
        $this->identRack = $identRack;

        return $this;
    }

    /**
     * Get identRack
     *
     * @return string
     */
    public function getIdentRack()
    {
        return $this->identRack;
    }

    /**
     * Set ramal
     *
     * @param integer $ramal
     *
     * @return Data
     */
    public function setRamal($ramal)
    {
        $this->ramal = $ramal;

        return $this;
    }

    /**
     * Get ramal
     *
     * @return integer
     */
    public function getRamal()
    {
        return $this->ramal;
    }

    /**
     * Set rackCentral
     *
     * @param integer $rackCentral
     *
     * @return Data
     */
    public function setRackCentral($rackCentral)
    {
        $this->rackCentral = $rackCentral;

        return $this;
    }

    /**
     * Get rackCentral
     *
     * @return integer
     */
    public function getRackCentral()
    {
        return $this->rackCentral;
    }

    /**
     * Set telPassagemA
     *
     * @param integer $telPassagemA
     *
     * @return Data
     */
    public function setTelPassagemA($telPassagemA)
    {
        $this->telPassagemA = $telPassagemA;

        return $this;
    }

    /**
     * Get telPassagemA
     *
     * @return integer
     */
    public function getTelPassagemA()
    {
        return $this->telPassagemA;
    }

    /**
     * Set telPassagemB
     *
     * @param integer $telPassagemB
     *
     * @return Data
     */
    public function setTelPassagemB($telPassagemB)
    {
        $this->telPassagemB = $telPassagemB;

        return $this;
    }

    /**
     * Get telPassagemB
     *
     * @return integer
     */
    public function getTelPassagemB()
    {
        return $this->telPassagemB;
    }
}
