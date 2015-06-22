<?php
 
namespace Iag\SwitchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Iag\SwitchBundle\Entity\SwitchRepository")
 */
class Switchs
{
    
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     *
     * @var type SwitchCommon
     * @ORM\ManyToOne(targetEntity="SwitchCommon", inversedBy="switch")
     * @ORM\JoinColumn(name="switch_common_id", referencedColumnName="id")
     */
    private $switchCommon;
    
    /**
     *
     * @var type 
     * 
     * @ORM\Column(name="identificacao", type="string")
     */
    private $identificacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_portas", type="integer")
     */
    private $numPortas;

    /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=255)
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(name="patrimonio", type="string", length=255)
     */
    private $patrimonio;

    /**
     * @var integer
     *
     * @ORM\Column(name="posicao_pilha", type="integer")
     */
    private $posicaoPilha;

    /**
     * @ORM\OneToMany(targetEntity="PortaSwitch", mappedBy="switch")
     */
    protected $portas;
    
    /**
     *
     * @var type 
     * 
     * @ORM\Column(name="isGiga", type="boolean", nullable=true)
     */
    protected $isGiga;
    
    /**
     *
     * @var type 
     * 
     * @ORM\Column(name="pilha", type="string", nullable=true)
     */
    private $pilha;
    
    public function getHostPilha()
    {
        return $this->hostname . ' ' . $this->posicaoPilha;
    }

    public function __toString() {
        return $this->switchCommon . ' ' . $this->posicaoPilha;
    }

    public function __construct() {
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
     * Set identificacao
     *
     * @param string $identificacao
     * @return Switchs
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
     * Set numPortas
     *
     * @param integer $numPortas
     * @return Switchs
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
     * Set marca
     *
     * @param string $marca
     * @return Switchs
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return string 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set patrimonio
     *
     * @param string $patrimonio
     * @return Switchs
     */
    public function setPatrimonio($patrimonio)
    {
        $this->patrimonio = $patrimonio;

        return $this;
    }

    /**
     * Get patrimonio
     *
     * @return string 
     */
    public function getPatrimonio()
    {
        return $this->patrimonio;
    }

    /**
     * Set posicaoPilha
     *
     * @param integer $posicaoPilha
     * @return Switchs
     */
    public function setPosicaoPilha($posicaoPilha)
    {
        $this->posicaoPilha = $posicaoPilha;

        return $this;
    }

    /**
     * Get posicaoPilha
     *
     * @return integer 
     */
    public function getPosicaoPilha()
    {
        return $this->posicaoPilha;
    }

    /**
     * Set isGiga
     *
     * @param boolean $isGiga
     * @return Switchs
     */
    public function setIsGiga($isGiga)
    {
        $this->isGiga = $isGiga;

        return $this;
    }

    /**
     * Get isGiga
     *
     * @return boolean 
     */
    public function getIsGiga()
    {
        return $this->isGiga;
    }

    /**
     * Set pilha
     *
     * @param string $pilha
     * @return Switchs
     */
    public function setPilha($pilha)
    {
        $this->pilha = $pilha;

        return $this;
    }

    /**
     * Get pilha
     *
     * @return string 
     */
    public function getPilha()
    {
        return $this->pilha;
    }

    /**
     * Set switchCommon
     *
     * @param \Iag\SwitchBundle\Entity\SwitchCommon $switchCommon
     * @return Switchs
     */
    public function setSwitchCommon(\Iag\SwitchBundle\Entity\SwitchCommon $switchCommon = null)
    {
        $this->switchCommon = $switchCommon;

        return $this;
    }

    /**
     * Get switchCommon
     *
     * @return \Iag\SwitchBundle\Entity\SwitchCommon 
     */
    public function getSwitchCommon()
    {
        return $this->switchCommon;
    }

    /**
     * Add portas
     *
     * @param \Iag\SwitchBundle\Entity\PortaSwitch $portas
     * @return Switchs
     */
    public function addPorta(\Iag\SwitchBundle\Entity\PortaSwitch $portas)
    {
        $this->portas[] = $portas;

        return $this;
    }

    /**
     * Remove portas
     *
     * @param \Iag\SwitchBundle\Entity\PortaSwitch $portas
     */
    public function removePorta(\Iag\SwitchBundle\Entity\PortaSwitch $portas)
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
     * Set pilhaIn
     *
     * @param \Iag\SwitchBundle\Entity\Switchs $pilhaIn
     * @return Switchs
     */
    public function setPilhaIn(\Iag\SwitchBundle\Entity\Switchs $pilhaIn = null)
    {
        $this->pilhaIn = $pilhaIn;

        return $this;
    }
}
