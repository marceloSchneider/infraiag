<?php

namespace Iag\InfraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Patch
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Patch
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
     * @ORM\Column(name="numPortas", type="integer")
     */
    private $numPortas;
    
    /**
     *
     * @var type 
     * 
     * @ORM\OneToMany(targetEntity="PPorta", mappedBy="patch")
     */
    private $pportas;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Rack", inversedBy="patchs")
     * @ORM\JoinColumn(name="rack_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $rack;
    
    /**
     *
     * @var type 
     * 
     * @ORM\Column(name="pilha", type="integer")
     */
    private $pilha;
    
    public function __toString() {
        return (string) $this->pilha;
    }

    public function __construct() {
        $this->pportas = new ArrayCollection();
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
     * @return Patch
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
     * Set pilha
     *
     * @param integer $pilha
     * @return Patch
     */
    public function setPilha($pilha)
    {
        $this->pilha = $pilha;

        return $this;
    }

    /**
     * Get pilha
     *
     * @return integer 
     */
    public function getPilha()
    {
        return $this->pilha;
    }

    /**
     * Add pportas
     *
     * @param \Iag\InfraBundle\Entity\PPortas $pportas
     * @return Patch
     */
    public function addPporta(\Iag\InfraBundle\Entity\PPorta $pportas)
    {
        $this->pportas[] = $pportas;

        return $this;
    }

    /**
     * Remove pportas
     *
     * @param \Iag\InfraBundle\Entity\PPortas $pportas
     */
    public function removePporta(\Iag\InfraBundle\Entity\PPorta $pportas)
    {
        $this->pportas->removeElement($pportas);
    }

    /**
     * Get pportas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPportas()
    {
        return $this->pportas;
    }

    /**
     * Set rack
     *
     * @param \Iag\InfraBundle\Entity\Rack $rack
     * @return Patch
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
