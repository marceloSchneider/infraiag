<?php

namespace Iag\InfraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class PPorta
{
    /**
     *
     * @var type 
     * 
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(name="numero", type="integer") 
     */
    private $numero;
    
    /**
     *
     * @var type 
     * 
     * @ORM\ManyToOne(targetEntity="Patch", inversedBy="pportas")
     * @ORM\JoinColumn(name="patch_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $patch;
    
    /**
     *
     * @var type 
     * 
     * @ORM\OneToOne(targetEntity="Iag\SwitchBundle\Entity\PortaSwitch", inversedBy="pporta")
     * @ORM\JoinColumn(name="porta_switch_id", referencedColumnName="id", nullable=true, unique=false)
     */
    private $porta;
    
    /**
     *
     * @var boolean
     * 
     * @ORM\Column(name="isWireless", type="boolean", nullable=true)
     */
    private $isWireless;
    
    /**
     *
     * @var boolean
     * 
     * @ORM\Column(name="isIpCamera", type="boolean", nullable=true)
     */
    private $isIpCamera;
            
    /**
     * 
     * @var type 
     * 
     * @ORM\OneToOne(targetEntity="Espelhamento", mappedBy="pporta")
     */
    private $espelhamento;
    
    /**
     *
     * @var \Iag\LocalBundle\Entity\Sala
     * @ORM\ManyToOne(targetEntity="Iag\LocalBundle\Entity\Sala", inversedBy="pontos")
     * @ORM\JoinColumn(name="sala_id", referencedColumnName="id", nullable=true)
     */
    private $sala;
    
    /**
     *
     * @var \Iag\InfraBundle\Entity\Voice
     * 
     * @ORM\OneToOne(targetEntity="Iag\InfraBundle\Entity\VoicePorta", mappedBy="pporta")
     */
    private $voice;
    
    public function __toString() {
        $pavimento = $this->getPatch()->getRack()->getSala()->getPavimento();
        $Rack = $this->getPatch()->getRack();
        $Patch = $this->getPatch();
         
        $p = $pavimento.$Rack.'-'.$Patch.'-'.$this->numero;
        
        return $p;
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
     * Set numero
     *
     * @param integer $numero
     * @return PPorta
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set isWireless
     *
     * @param boolean $isWireless
     * @return PPorta
     */
    public function setIsWireless($isWireless)
    {
        $this->isWireless = $isWireless;

        return $this;
    }

    /**
     * Get isWireless
     *
     * @return boolean 
     */
    public function getIsWireless()
    {
        return $this->isWireless;
    }

    /**
     * Set isIpCamera
     *
     * @param boolean $isIpCamera
     * @return PPorta
     */
    public function setIsIpCamera($isIpCamera)
    {
        $this->isIpCamera = $isIpCamera;

        return $this;
    }

    /**
     * Get isIpCamera
     *
     * @return boolean 
     */
    public function getIsIpCamera()
    {
        return $this->isIpCamera;
    }

    /**
     * Set patch
     *
     * @param \Iag\InfraBundle\Entity\Patch $patch
     * @return PPorta
     */
    public function setPatch(\Iag\InfraBundle\Entity\Patch $patch = null)
    {
        $this->patch = $patch;

        return $this;
    }

    /**
     * Get patch
     *
     * @return \Iag\InfraBundle\Entity\Patch 
     */
    public function getPatch()
    {
        return $this->patch;
    }

    /**
     * Set porta
     *
     * @param \Iag\SwitchBundle\Entity\PortaSwitch $porta
     * @return PPorta
     */
    public function setPorta(\Iag\SwitchBundle\Entity\PortaSwitch $porta = null)
    {
        $this->porta = $porta;

        return $this;
    }

    /**
     * Get porta
     *
     * @return \Iag\SwitchBundle\Entity\PortaSwitch 
     */
    public function getPorta()
    {
        return $this->porta;
    }

    /**
     * Set espelhamento
     *
     * @param \Iag\InfraBundle\Entity\Espelhamento $espelhamento
     * @return PPorta
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
     * Set sala
     *
     * @param \Iag\LocalBundle\Entity\Sala $sala
     * @return PPorta
     */
    public function setSala(\Iag\LocalBundle\Entity\Sala $sala = null)
    {
        $this->sala = $sala;

        return $this;
    }

    /**
     * Get sala
     *
     * @return \Iag\LocalBundle\Entity\Sala 
     */
    public function getSala()
    {
        return $this->sala;
    }

    /**
     * Set voice
     *
     * @param \Iag\InfraBundle\Entity\VoicePorta $voice
     * @return PPorta
     */
    public function setVoice(\Iag\InfraBundle\Entity\VoicePorta $voice = null)
    {
        $this->voice = $voice;

        return $this;
    }

    /**
     * Get voice
     *
     * @return \Iag\InfraBundle\Entity\VoicePorta 
     */
    public function getVoice()
    {
        return $this->voice;
    }
}
