<?php

namespace Iag\LocalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Iag\LocalBundle\Entity\SalaRepository")
 */
class Sala
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
     * @ORM\Column(name="numero", type="string")
     */
    private $numero;
    
    /**
     * @ORM\ManyToOne(targetEntity="Pavimento", inversedBy="pavimentos")
     * @ORM\JoinColumn(name="pavimento_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $pavimento;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bloco", inversedBy="salas")
     * @ORM\JoinColumn(name="bloco_id", referencedColumnName="id")
     */
    private $bloco;
    
    /**
     * @ORM\OneToMany(targetEntity="Iag\InfraBundle\Entity\Rack", mappedBy="sala")
     */
    private $racks;
    
    /**
     *
     * @var \Iag\LocalBundle\Entity\PPorta
     * @ORM\OneToMany(targetEntity="Iag\LocalBundle\Entity\Sala", mappedBy="sala")
     */
    private $pontos;

    /**
     *
     * @var type 
     * 
     * @ORM\ManyToOne(targetEntity="Iag\InfraBundle\Entity\Rack", inversedBy="atendeLocais")
     * @ORM\JoinColumn(name="rackAtendente", referencedColumnName="id", nullable=true)
     */
    private $rackAtendente;

    public function __construct() {
        $this->racks = new ArrayCollection();
        $this->pontos = new ArrayCollection();
    }
    
    public function __toString() {
       return (string) $this->bloco . ' ' . $this->numero . ' '. $this->pavimento;
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
     * @param string $numero
     * @return Sala
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set pavimento
     *
     * @param \Iag\LocalBundle\Entity\Pavimento $pavimento
     * @return Sala
     */
    public function setPavimento(\Iag\LocalBundle\Entity\Pavimento $pavimento = null)
    {
        $this->pavimento = $pavimento;

        return $this;
    }

    /**
     * Get pavimento
     *
     * @return \Iag\LocalBundle\Entity\Pavimento 
     */
    public function getPavimento()
    {
        return $this->pavimento;
    }

    /**
     * Set bloco
     *
     * @param \Iag\LocalBundle\Entity\Bloco $bloco
     * @return Sala
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

    /**
     * Add racks
     *
     * @param \Iag\InfraBundle\Entity\Rack $racks
     * @return Sala
     */
    public function addRack(\Iag\InfraBundle\Entity\Rack $racks)
    {
        $this->racks[] = $racks;

        return $this;
    }

    /**
     * Remove racks
     *
     * @param \Iag\InfraBundle\Entity\Rack $racks
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
     * Add pontos
     *
     * @param \Iag\InfraBundle\Entity\Sala $pontos
     * @return Sala
     */
    public function addPonto(\Iag\LocalBundle\Entity\Sala $pontos)
    {
        $this->pontos[] = $pontos;

        return $this;
    }

    /**
     * Remove pontos
     *
     * @param \Iag\InfraBundle\Entity\Sala $pontos
     */
    public function removePonto(\Iag\LocalBundle\Entity\Sala $pontos)
    {
        $this->pontos->removeElement($pontos);
    }

    /**
     * Get pontos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPontos()
    {
        return $this->pontos;
    }

    /**
     * Set rackAtendente
     *
     * @param \Iag\InfraBundle\Entity\Rack $rackAtendente
     * @return Sala
     */
    public function setRackAtendente(\Iag\InfraBundle\Entity\Rack $rackAtendente = null)
    {
        $this->rackAtendente = $rackAtendente;

        return $this;
    }

    /**
     * Get rackAtendente
     *
     * @return \Iag\InfraBundle\Entity\Rack 
     */
    public function getRackAtendente()
    {
        return $this->rackAtendente;
    }
}
