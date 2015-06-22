<?php

namespace Iag\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="view_geral")
 */
class Lista
{
    /**
     *
     * @var type 
     * @ORM\Column(name="bloco", nullable=true, type="string")
     */
    private $bloco;
    
    /**
     * @ORM\Column(name="bloco_id", nullable=true, type="integer")
     */
    private $blocoId;
    
    /**
     *
     * @var type 
     * @ORM\Column(name="andar", nullable=true, type="string")
     */
    private $andar;
    
     /**
     * @ORM\Column(name="pavimento_id", nullable=true, type="integer")
     */
    private $andarId;
    
    /**
     *
     * @var type 
     * @ORM\Column(name="sala", nullable=true, type="string")
     */
    private $sala;
    
     /**
     * @ORM\Column(name="sala_id", nullable=true, type="integer")
     */
    private $salaId;
    
    /**
     *
     * @var type 
     * @ORM\Column(name="patch", nullable=true, type="string")
     */
    private $patch;
    
     /**
     * @ORM\Column(name="patch_id", nullable=true, type="integer")
     */
    private $patchId;
    
    
    /**
     *@ORM\Id
     * @var type 
     * @ORM\Column(name="ponto", nullable=true, type="string")
     */
    private $ponto;    
    
    /**
     *
     * @var type 
     * @ORM\Column(name="status", nullable=true, type="string")
     */
    private $status;
    
     /**
     * @ORM\Column(name="porta_id", nullable=true, type="integer")
     */
    private $statusId;
    
    /**
     *
     * @var type 
     * @ORM\Column(name="telefonia", nullable=true, type="integer")
     */
    private $telefonia;
    
     /**
     * @ORM\Column(name="voiceporta_id", nullable=true, type="integer")
     */
    private $telefoniaId;
    
    /**
     *
     * @var type 
     * @ORM\Column(name="numVoicePanel", nullable=true, type="integer")
     */
    private $numVoicePanel;
    
    /**
     *
     * @var type 
     * @ORM\Column(name="central", type="integer", nullable=true)
     */
    private $central;
    
    /**
     *
     * @var type 
     * @ORM\Column(name="distribuicao", type="integer", nullable=true)
     */
    private $distribuicao;
    
    /**
     *
     * @var type 
     * @ORM\Column(name="nomeSwitch", nullable=true, type="string")
     */
    private $nomeSwitch;
    
     /**
     * @ORM\Column(name="switch_id", nullable=true, type="integer")
     */
    private $switchId;
    
    /**
     *
     * @var type 
     * @ORM\Column(name="ip", nullable=true, type="string")
     */
    private $ip;
    
     /**
     * @ORM\Column(name="ipswitch_id", nullable=true, type="integer")
     */
    private $ipId;
    /**
     *
     * @var type 
     * @ORM\Column(name="porta", nullable=true, type="string")
     */
    private $porta;
    
     /**
     * @ORM\Column(name="portaswitch_id", nullable=true, type="integer")
     */
    private $portaId; 
    
    /**
     *
     * @var type 
     * @ORM\Column(name="wireless", nullable=true, type="string")
     */
    private $wireless;
    
    /**
     *
     * @var type 
     * @ORM\Column(name="ipCamera", nullable=true, type="string")
     */
    private $ipCamera;
    
    /**
     *
     * @var type 
     * @ORM\Column(name="vlan", nullable=true, type="string")
     */
    private $vlan;
    
     /**
     * @ORM\Column(name="vlan_id", nullable=true, type="integer")
     */
    private $vlanId;
    
    /**
     *
     * @var type 
     * @ORM\Column(name="salaRack", nullable=true, type="integer")
     */
    private $salaRack;
    
     /**
     * @ORM\Column(name="sala_rack_id", nullable=true, type="integer")
     */
    private $salaRackId;
    /**
     *
     * @var type 
     * @ORM\Column(name="idSwitch", nullable=true, type="string")
     */
    private $idSwitch;

    /**
     * Set bloco
     *
     * @param string $bloco
     * @return Lista
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
     * Set blocoId
     *
     * @param integer $blocoId
     * @return Lista
     */
    public function setBlocoId($blocoId)
    {
        $this->blocoId = $blocoId;

        return $this;
    }

    /**
     * Get blocoId
     *
     * @return integer 
     */
    public function getBlocoId()
    {
        return $this->blocoId;
    }

    /**
     * Set andar
     *
     * @param string $andar
     * @return Lista
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
     * Set andarId
     *
     * @param integer $andarId
     * @return Lista
     */
    public function setAndarId($andarId)
    {
        $this->andarId = $andarId;

        return $this;
    }

    /**
     * Get andarId
     *
     * @return integer 
     */
    public function getAndarId()
    {
        return $this->andarId;
    }

    /**
     * Set sala
     *
     * @param integer $sala
     * @return Lista
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
     * Set salaId
     *
     * @param integer $salaId
     * @return Lista
     */
    public function setSalaId($salaId)
    {
        $this->salaId = $salaId;

        return $this;
    }

    /**
     * Get salaId
     *
     * @return integer 
     */
    public function getSalaId()
    {
        return $this->salaId;
    }

    /**
     * Set patch
     *
     * @param string $patch
     * @return Lista
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
     * Set patchId
     *
     * @param integer $patchId
     * @return Lista
     */
    public function setPatchId($patchId)
    {
        $this->patchId = $patchId;

        return $this;
    }

    /**
     * Get patchId
     *
     * @return integer 
     */
    public function getPatchId()
    {
        return $this->patchId;
    }

    /**
     * Set ponto
     *
     * @param string $ponto
     * @return Lista
     */
    public function setPonto($ponto)
    {
        $this->ponto = $ponto;

        return $this;
    }

    /**
     * Get ponto
     *
     * @return string 
     */
    public function getPonto()
    {
        return $this->ponto;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Lista
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set statusId
     *
     * @param integer $statusId
     * @return Lista
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;

        return $this;
    }

    /**
     * Get statusId
     *
     * @return integer 
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * Set telefonia
     *
     * @param integer $telefonia
     * @return Lista
     */
    public function setTelefonia($telefonia)
    {
        $this->telefonia = $telefonia;

        return $this;
    }

    /**
     * Get telefonia
     *
     * @return integer 
     */
    public function getTelefonia()
    {
        return $this->telefonia;
    }

    /**
     * Set telefoniaId
     *
     * @param integer $telefoniaId
     * @return Lista
     */
    public function setTelefoniaId($telefoniaId)
    {
        $this->telefoniaId = $telefoniaId;

        return $this;
    }

    /**
     * Get telefoniaId
     *
     * @return integer 
     */
    public function getTelefoniaId()
    {
        return $this->telefoniaId;
    }

    /**
     * Set numVoicePanel
     *
     * @param integer $numVoicePanel
     * @return Lista
     */
    public function setNumVoicePanel($numVoicePanel)
    {
        $this->numVoicePanel = $numVoicePanel;

        return $this;
    }

    /**
     * Get numVoicePanel
     *
     * @return integer 
     */
    public function getNumVoicePanel()
    {
        return $this->numVoicePanel;
    }

    /**
     * Set nomeSwitch
     *
     * @param string $nomeSwitch
     * @return Lista
     */
    public function setNomeSwitch($nomeSwitch)
    {
        $this->nomeSwitch = $nomeSwitch;

        return $this;
    }

    /**
     * Get nomeSwitch
     *
     * @return string 
     */
    public function getNomeSwitch()
    {
        return $this->nomeSwitch;
    }

    /**
     * Set switchId
     *
     * @param integer $switchId
     * @return Lista
     */
    public function setSwitchId($switchId)
    {
        $this->switchId = $switchId;

        return $this;
    }

    /**
     * Get switchId
     *
     * @return integer 
     */
    public function getSwitchId()
    {
        return $this->switchId;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Lista
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
     * Set ipId
     *
     * @param integer $ipId
     * @return Lista
     */
    public function setIpId($ipId)
    {
        $this->ipId = $ipId;

        return $this;
    }

    /**
     * Get ipId
     *
     * @return integer 
     */
    public function getIpId()
    {
        return $this->ipId;
    }

    /**
     * Set porta
     *
     * @param integer $porta
     * @return Lista
     */
    public function setPorta($porta)
    {
        $this->porta = $porta;

        return $this;
    }

    /**
     * Get porta
     *
     * @return integer 
     */
    public function getPorta()
    {
        return $this->porta;
    }

    /**
     * Set portaId
     *
     * @param integer $portaId
     * @return Lista
     */
    public function setPortaId($portaId)
    {
        $this->portaId = $portaId;

        return $this;
    }

    /**
     * Get portaId
     *
     * @return integer 
     */
    public function getPortaId()
    {
        return $this->portaId;
    }

    /**
     * Set wireless
     *
     * @param string $wireless
     * @return Lista
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
     * @return Lista
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
     * @param string $vlan
     * @return Lista
     */
    public function setVlan($vlan)
    {
        $this->vlan = $vlan;

        return $this;
    }

    /**
     * Get vlan
     *
     * @return string 
     */
    public function getVlan()
    {
        return $this->vlan;
    }

    /**
     * Set vlanId
     *
     * @param integer $vlanId
     * @return Lista
     */
    public function setVlanId($vlanId)
    {
        $this->vlanId = $vlanId;

        return $this;
    }

    /**
     * Get vlanId
     *
     * @return integer 
     */
    public function getVlanId()
    {
        return $this->vlanId;
    }

    /**
     * Set salaRack
     *
     * @param integer $salaRack
     * @return Lista
     */
    public function setSalaRack($salaRack)
    {
        $this->salaRack = $salaRack;

        return $this;
    }

    /**
     * Get salaRack
     *
     * @return integer 
     */
    public function getSalaRack()
    {
        return $this->salaRack;
    }

    /**
     * Set salaRackId
     *
     * @param integer $salaRackId
     * @return Lista
     */
    public function setSalaRackId($salaRackId)
    {
        $this->salaRackId = $salaRackId;

        return $this;
    }

    /**
     * Get salaRackId
     *
     * @return integer 
     */
    public function getSalaRackId()
    {
        return $this->salaRackId;
    }

    /**
     * Set idSwitch
     *
     * @param string $idSwitch
     * @return Lista
     */
    public function setIdSwitch($idSwitch)
    {
        $this->idSwitch = $idSwitch;

        return $this;
    }

    /**
     * Get idSwitch
     *
     * @return string 
     */
    public function getIdSwitch()
    {
        return $this->idSwitch;
    }

    /**
     * Set central
     *
     * @param integer $central
     * @return Lista
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
     * @return Lista
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
}
