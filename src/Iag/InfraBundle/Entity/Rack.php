<?php


namespace Iag\InfraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Rack
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
     * @var integer
     *
     * @ORM\Column(name="quantidadeU", type="integer")
     */
    private $quantidadeU;
        
    /**
     *
     * @ORM\ManyToOne(targetEntity="Iag\LocalBundle\Entity\Sala", inversedBy="racks")
     * @ORM\JoinColumn(name="sala_id", referencedColumnName="id")
     */
    private $sala;
    
    /**
     *
     * @var type 
     * 
     * @ORM\OneToMany(targetEntity="Iag\LocalBundle\Entity\Sala", mappedBy="rackAtendente")
     */
    private $atendeLocais;

    /**
     *
     * @var type 
     * 
     * @ORM\OneToMany(targetEntity="Patch", mappedBy="rack")
     */
    private $patchs;
   
    /**
     *
     * @var type 
     * 
     * @ORM\OneToMany(targetEntity="Iag\SwitchBundle\Entity\Switchs", mappedBy="rack")
     */
    private $switchs;
    
    /**
     *
     * @var \Iag\InfraBundle\Entity\VoicePanel
     * 
     * @ORM\OneToMany(targetEntity="VoicePanel", mappedBy="rack")
     */
    private $voicePanels;
    
    
    /**
     * @ORM\Column(name="identificacao", type="string")
     */
    private $identificacao;
    
    public function __construct() {
        $this->switchs = new ArrayCollection();
        $this->patchs = new ArrayCollection();
        $this->pilha = new ArrayCollection();
        $this->atendeLocais = new ArrayCollection();
        $this->voicePanels = new ArrayCollection();
    }
    
    public function __toString() {
        return $this->getIdentificacao();
    }


    public function getRack()
   {
       return $this;
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
     * Set quantidadeU
     *
     * @param integer $quantidadeU
     * @return Rack
     */
    public function setQuantidadeU($quantidadeU)
    {
        $this->quantidadeU = $quantidadeU;

        return $this;
    }

    /**
     * Get quantidadeU
     *
     * @return integer 
     */
    public function getQuantidadeU()
    {
        return $this->quantidadeU;
    }

    /**
     * Set sala
     *
     * @param integer $sala
     * @return Rack
     */
    public function setSala($sala)
    {
        $this->sala = $sala;

        return $this;
    }

    /**
     * Get sala
     *
     * @return integer 
     */
    public function getSala()
    {
        return $this->sala;
    }

    /**
     * Set identificacao
     *
     * @param string $identificacao
     * @return Rack
     */
    public function setIdentificacao($identificacao)
    {
        $this->identificacao = $identificacao;

        return $this;
    }

    /**
     * Get identificacao
     *
     * @return string 
     */
    public function getIdentificacao()
    {
        return $this->identificacao;
    }

    /**
     * Add switchs
     *
     * @param \Iag\InfraBundle\Entity\Iag/SwitchBundle/Entity/Switchs $switchs
     * @return Rack
     */
    public function addSwitch(\Iag\SwitchBundle\Entity\Switchs $switchs)
    {
        $this->switchs[] = $switchs;

        return $this;
    }

    /**
     * Remove switchs
     *
     * @param \Iag\InfraBundle\Entity\Iag/SwitchBundle/Entity/Switchs $switchs
     */
    public function removeSwitch(\Iag\SwitchBundle\Entity\Switchs $switchs)
    {
        $this->switchs->removeElement($switchs);
    }

    /**
     * Get switchs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSwitchs()
    {
        return $this->switchs;
    }

    /**
     * Set bloco
     *
     * @param \Iag\InfraBundle\Entity\Iag/LocalBundle/Entity/Bloco $bloco
     * @return Rack
     */
    public function setBloco(\Iag\LocalBundle\Entity\Bloco $bloco = null)
    {
        $this->bloco = $bloco;

        return $this;
    }

    /**
     * Get bloco
     *
     * @return \Iag\InfraBundle\Entity\Iag/LocalBundle/Entity/Bloco 
     */
    public function getBloco()
    {
        return $this->bloco;
    }

    /**
     * Add patchs
     *
     * @param \Iag\InfraBundle\Entity\Patch $patchs
     * @return Rack
     */
    public function addPatch(\Iag\InfraBundle\Entity\Patch $patchs)
    {
        $this->patchs[] = $patchs;

        return $this;
    }

    /**
     * Remove patchs
     *
     * @param \Iag\InfraBundle\Entity\Patch $patchs
     */
    public function removePatch(\Iag\InfraBundle\Entity\Patch $patchs)
    {
        $this->patchs->removeElement($patchs);
    }

    /**
     * Get patchs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPatchs()
    {
        return $this->patchs;
    }

    /**
     * Add pilha
     *
     * @param \Iag\InfraBundle\Entity\Pilha
     * @return Rack
     */
    public function addPilha(\Iag\SwitchBundle\Entity\Pilha $pilha)
    {
        $this->pilha[] = $pilha;

        return $this;
    }

    /**
     * Remove pilha
     *
     * @param \Iag\InfraBundle\Entity\Iag/SwitchBundle/Entity/Pilha $pilha
     */
    public function removePilha(\Iag\SwitchBundle\Entity\Pilha $pilha)
    {
        $this->pilha->removeElement($pilha);
    }

    /**
     * Get pilha
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPilha()
    {
        return $this->pilha;
    }

    /**
     * Add atendeLocais
     *
     * @param \Iag\LocalBundle\Entity\Sala $atendeLocais
     * @return Rack
     */
    public function addAtendeLocai(\Iag\LocalBundle\Entity\Sala $atendeLocais)
    {
        $this->atendeLocais[] = $atendeLocais;

        return $this;
    }

    /**
     * Remove atendeLocais
     *
     * @param \Iag\LocalBundle\Entity\Sala $atendeLocais
     */
    public function removeAtendeLocai(\Iag\LocalBundle\Entity\Sala $atendeLocais)
    {
        $this->atendeLocais->removeElement($atendeLocais);
    }

    /**
     * Get atendeLocais
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAtendeLocais()
    {
        return $this->atendeLocais;
    }

    /**
     * Set atendeLocais
     *
     * @param string $atendeLocais
     * @return Rack
     */
    public function setAtendeLocais($atendeLocais)
    {
        $this->atendeLocais = $atendeLocais;

        return $this;
    }

    /**
     * Add voicePanels
     *
     * @param \Iag\InfraBundle\Entity\VoicePanel $voicePanels
     * @return Rack
     */
    public function addVoicePanel(\Iag\InfraBundle\Entity\VoicePanel $voicePanels)
    {
        $this->voicePanels[] = $voicePanels;

        return $this;
    }

    /**
     * Remove voicePanels
     *
     * @param \Iag\InfraBundle\Entity\VoicePanel $voicePanels
     */
    public function removeVoicePanel(\Iag\InfraBundle\Entity\VoicePanel $voicePanels)
    {
        $this->voicePanels->removeElement($voicePanels);
    }

    /**
     * Get voicePanels
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVoicePanels()
    {
        return $this->voicePanels;
    }
}
