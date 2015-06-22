<?php

namespace Iag\LocalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table()
 * @ORM\Entity
 */
class Bloco
{
    /**
     *
     * @var type 
     * 
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     *
     * @var type 
     * 
     * @ORM\Column(name="nome", type="string")
     */
    private $nome;
    
    /**
     * @ORM\OneToMany(targetEntity="Iag\InfraBundle\Entity\Rack", mappedBy="bloco")
     */
    private $racks;


    /**
     * @ORM\OneToMany(targetEntity="Sala", mappedBy="bloco")
     */
    private $salas;
    
    public function __construct() {
        $this->salas = new ArrayCollection();
        $this->racks = new ArrayCollection();
    }
    
    public function __toString() {
        return $this->nome;
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
     * Set nome
     *
     * @param string $nome
     * @return Bloco
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Add pavimentos
     *
     * @param \Iag\LocalBundle\Entity\Pavimento $pavimentos
     * @return Bloco
     */
    public function addPavimento(\Iag\LocalBundle\Entity\Pavimento $pavimentos)
    {
        $this->pavimentos[] = $pavimentos;

        return $this;
    }

    /**
     * Remove pavimentos
     *
     * @param \Iag\LocalBundle\Entity\Pavimento $pavimentos
     */
    public function removePavimento(\Iag\LocalBundle\Entity\Pavimento $pavimentos)
    {
        $this->pavimentos->removeElement($pavimentos);
    }

    /**
     * Get pavimentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPavimentos()
    {
        return $this->pavimentos;
    }

    /**
     * Add racks
     *
     * @param Iag\InfraBundle\Entity\Rack $racks
     * @return Bloco
     */
    public function addRack(\Iag\InfraBundle\Entity\Rack $racks)
    {
        $this->racks[] = $racks;

        return $this;
    }

    /**
     * Remove racks
     *
     * @param \Iag/InfraBundle\Entity\Rack $racks
     */
    public function removeRack(\Iag\InfraBundle\Entity\Rack $racks)
    {
        $this->racks->removeElement($racks);
    }

    /**
     * Get racks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRacks()
    {
        return $this->racks;
    }

    /**
     * Add salas
     *
     * @param \Iag\LocalBundle\Entity\Sala $salas
     * @return Bloco
     */
    public function addSala(\Iag\LocalBundle\Entity\Sala $salas)
    {
        $this->salas[] = $salas;

        return $this;
    }

    /**
     * Remove salas
     *
     * @param \Iag\LocalBundle\Entity\Sala $salas
     */
    public function removeSala(\Iag\LocalBundle\Entity\Sala $salas)
    {
        $this->salas->removeElement($salas);
    }

    /**
     * Get salas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSalas()
    {
        return $this->salas;
    }
}
