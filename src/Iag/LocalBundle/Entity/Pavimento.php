<?php

namespace Iag\LocalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Table()
 * @ORM\Entity
 */
class Pavimento
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
     * @ORM\OneToMany(targetEntity="Sala", mappedBy="sala")
     */
    private $salas;
    
    /**
     *
     * @var type 
     * 
     * @ORM\ManyToOne(targetEntity="Bloco", inversedBy="blocos")
     * @ORM\JoinColumn(name="bloco_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $bloco;

    public function __construct() {
        $this->salas = new ArrayCollection();
    }
    
    public function __toString() {
        return $this->nome . '-' . $this->bloco;
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
     * @return Pavimento
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
     * Add salas
     *
     * @param \Iag\LocalBundle\Entity\Sala $salas
     * @return Pavimento
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

    /**
     * Set bloco
     *
     * @param \Iag\LocalBundle\Entity\Bloco $bloco
     * @return Pavimento
     */
    public function setBloco(\Iag\LocalBundle\Entity\Bloco $bloco = null)
    {
        $this->bloco = $bloco;

        return $this;
    }

    /**
     * Get bloco
     *
     * @return \Iag\LocalBundle\Entity\Bloco 
     */
    public function getBloco()
    {
        return $this->bloco;
    }
}
