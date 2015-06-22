<?php

namespace Iag\SwitchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity
 */
class SwitchPilha
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
     *
     * @var type 
     * 
     * @ORM\Column(name="hostname", type="string")
     */
    private $hostname;
    
    /**
     *
     * @var type 
     * 
     * @ORM\Column(name="numPortas", type="integer")
     */
    private $numPortas;
    
    /**
     *
     * @var type 
     * 
     * @ORM\Column(name="marca", type="string")
     */
    private $marca;
    
    /**
     *
     * @var type 
     * 
     * @ORM\Column(name="patrimonio", type="string")
     */
    private $patrimonio;
    
    
    /**
     *
     * @var type 
     * 
     * @ORM\Column(name="pilhaFisica", type="string")
     */
    private $pilhaFisica;
    
    /**
     *
     * @var type 
     * 
     * @ORM\OneToMany(targetEntity="PortaSwitch", mappedBy="switch")
     */
    private $portas;
    
    /**
     *
     * @var type 
     * 
     * @ORM\ManyToOne(targetEntity="Pilha", inversedBy="switchs")
     * @ORM\JoinColumn(name="pilha_id", referencedColumnName="id")
     */
    private $pilhaLogica;
    
    /**
     *
     * @var type 
     * 
     * @ORM\Column(name="posicaoPilhaLogica", type="integer")
     */
    private $posicaoPilhaLogica;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->portas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return SwitchPilha
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
     * Set numPortas
     *
     * @param integer $numPortas
     * @return SwitchPilha
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
     * @return SwitchPilha
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
     * @return SwitchPilha
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
     * Set pilhaFisica
     *
     * @param string $pilhaFisica
     * @return SwitchPilha
     */
    public function setPilhaFisica($pilhaFisica)
    {
        $this->pilhaFisica = $pilhaFisica;

        return $this;
    }

    /**
     * Get pilhaFisica
     *
     * @return string 
     */
    public function getPilhaFisica()
    {
        return $this->pilhaFisica;
    }

    /**
     * Add portas
     *
     * @param \Iag\SwitchBundle\Entity\PortaSwitch $portas
     * @return SwitchPilha
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
     * Set posicaoPilhaLogica
     *
     * @param integer $posicaoPilhaLogica
     * @return SwitchPilha
     */
    public function setPosicaoPilhaLogica($posicaoPilhaLogica)
    {
        $this->posicaoPilhaLogica = $posicaoPilhaLogica;

        return $this;
    }

    /**
     * Get posicaoPilhaLogica
     *
     * @return integer 
     */
    public function getPosicaoPilhaLogica()
    {
        return $this->posicaoPilhaLogica;
    }

    /**
     * Set pilhaLogica
     *
     * @param \Iag\SwitchBundle\Entity\Pilha $pilhaLogica
     * @return SwitchPilha
     */
    public function setPilhaLogica(\Iag\SwitchBundle\Entity\Pilha $pilhaLogica = null)
    {
        $this->pilhaLogica = $pilhaLogica;

        return $this;
    }

    /**
     * Get pilhaLogica
     *
     * @return \Iag\SwitchBundle\Entity\Pilha 
     */
    public function getPilhaLogica()
    {
        return $this->pilhaLogica;
    }
}
