<?php

namespace Iag\InfraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table()
 */
class VoicePorta
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
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;
    
    /**
     * Numero no dg central
     * 
     * @var int
     * 
     * @ORM\Column(name="central", type="integer", nullable=true)
     */
    private $central;
    
    /**
     * Número no dg de distribuição
     * @var int
     * 
     * @ORM\Column(name="distribuicao", type="integer", nullable=true)
     */
    private $distribuicao;


    /**
     *
     * @var integer
     * 
     * @ORM\Column(name="ramal", type="integer", nullable=true)
     */
    private $ramal;
    
    
    /**
     *
     * @var \Iag\InfraBundle\Entity\VoicePanel
     * 
     * @ORM\ManyToOne(targetEntity="VoicePanel", inversedBy="portas")
     * @ORM\JoinColumn(name="voicePanel_id", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     */
    private $voicePanel;

    /**
     *
     * @var \Iag\InfraBundle\Entity\VoicePorta
     * 
     * @ORM\OneToOne(targetEntity="Iag\InfraBundle\Entity\PPorta", inversedBy="voice")
     * @ORM\JoinColumn(name="pporta_id", referencedColumnName="id")
     */
    private $pporta;
    
    
    public function __toString() {
        return (string) $this->numero;
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
     * @return VoicePorta
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
     * Set central
     *
     * @param integer $central
     * @return VoicePorta
     */
    public function setCentral($central)
    {
        $this->central = $central;

        return $this;
    }

    /**
     * Get central
     *
     * @return integer 
     */
    public function getCentral()
    {
        return $this->central;
    }

    /**
     * Set distribuicao
     *
     * @param integer $distribuicao
     * @return VoicePorta
     */
    public function setDistribuicao($distribuicao)
    {
        $this->distribuicao = $distribuicao;

        return $this;
    }

    /**
     * Get distribuicao
     *
     * @return integer 
     */
    public function getDistribuicao()
    {
        return $this->distribuicao;
    }

    /**
     * Set ramal
     *
     * @param integer $ramal
     * @return VoicePorta
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
     * Set voicePanel
     *
     * @param \Iag\InfraBundle\Entity\VoicePanel $voicePanel
     * @return VoicePorta
     */
    public function setVoicePanel(\Iag\InfraBundle\Entity\VoicePanel $voicePanel = null)
    {
        $this->voicePanel = $voicePanel;

        return $this;
    }

    /**
     * Get voicePanel
     *
     * @return \Iag\InfraBundle\Entity\VoicePanel 
     */
    public function getVoicePanel()
    {
        return $this->voicePanel;
    }

    /**
     * Set pporta
     *
     * @param \Iag\InfraBundle\Entity\PPorta $pporta
     * @return VoicePorta
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
}
