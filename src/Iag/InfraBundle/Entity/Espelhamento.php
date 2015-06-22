<?php

namespace Iag\InfraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity
 */
class Espelhamento
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
     * @ORM\OneToOne(targetEntity="PPorta", inversedBy="espelhamento")
     * @ORM\JoinColumn(name="pporta_id", referencedColumnName="id", unique=true)
     */
    private $pporta;
    
    /**
     *
     * @var type 
     * 
     * @ORM\OneToOne(targetEntity="Iag\SwitchBundle\Entity\PortaSwitch", inversedBy="espelhamento")
     * @ORM\JoinColumn(name="porta_id", referencedColumnName="id")
     */
    private $porta;
    
    
    /**
     *
     * @var type 
     * 
     * @ORM\Column(name="tipo", type="string")
     */
    private $tipo;
   

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
     * Set tipo
     *
     * @param string $tipo
     * @return Espelhamento
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set pporta
     *
     * @param \Iag\InfraBundle\Entity\PPorta $pporta
     * @return Espelhamento
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

    /**
     * Set porta
     *
     * @param \Iag\SwitchBundle\Entity\Porta $porta
     * @return Espelhamento
     */
    public function setPorta(\Iag\SwitchBundle\Entity\PortaSwitch $porta = null)
    {
        $this->porta = $porta;

        return $this;
    }

    /**
     * Get porta
     *
     * @return \Iag\SwitchBundle\Entity\Porta 
     */
    public function getPorta()
    {
        return $this->porta;
    }
}
