<?php

namespace Iag\InfraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class VoicePanel
{
    /**
     *
     * @var int
     * 
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    
    /**
     *
     * @var int
     * 
     * @ORM\Column(name="numPortas", type="integer")
     */
    private $numPortas;
    
    /**
     *
     * @var int
     * 
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;
    
    
    /**
     *
     * @var \Iag\InfraBundle\Entity\VoicePorta
     * 
     * @ORM\OneToMany(targetEntity="VoicePorta", mappedBy="voicePanel")
     */
    private $portas;
    
    /**
     *
     * @var \Iag\InfraBundle\Entity\Rack
     * 
     * @ORM\ManyToOne(targetEntity="Rack", inversedBy="voicePanels")
     * @ORM\JoinColumn(name="rack_id", referencedColumnName="id")
     */
    private $rack;
    
    public function __toString() {
        return (string) $this->numero;
    }


    public function __construct()
    {
        $this->portas = new ArrayCollection();
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
     * Set numPortas
     *
     * @param integer $numPortas
     * @return VoicePanel
     */
    public function setNumPortas($numPortas)
    {
        $this->numPortas = $numPortas;

        return $this;
    }

    /**
     * Get numPortas
     *
     * @return integer 
     */
    public function getNumPortas()
    {
        return $this->numPortas;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     * @return VoicePanel
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
     * Add portas
     *
     * @param \Iag\InfraBundle\Entity\VoicePorta $portas
     * @return VoicePanel
     */
    public function addPorta(\Iag\InfraBundle\Entity\VoicePorta $portas)
    {
        $this->portas[] = $portas;

        return $this;
    }

    /**
     * Remove portas
     *
     * @param \Iag\InfraBundle\Entity\VoicePorta $portas
     */
    public function removePorta(\Iag\InfraBundle\Entity\VoicePorta $portas)
    {
        $this->portas->removeElement($portas);
    }

    /**
     * Get portas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPortas()
    {
        return $this->portas;
    }

    /**
     * Set rack
     *
     * @param \Iag\InfraBundle\Entity\Rack $rack
     * @return VoicePanel
     */
    public function setRack(\Iag\InfraBundle\Entity\Rack $rack = null)
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
