<?php

namespace Cupon\CiudadBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Cupon\CiudadBundle\Entity\CiudadRepository")
 */
class Fichero
{
    /** @ORM\Id
    /** @ORM\Column(type="integer")
     ** @ORM\GeneratedValue*/
    protected $id;

    /** @ORM\Column(type="string", length=100)   */
    protected $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_subida", type="datetime")
     */
    protected $fechaSubida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_borrado", type="datetime")
     */
    protected $fechaBorrado;

    /** @ORM\ManyToOne(targetEntity="AppBundle\UsuarioBundle\Entity\Usuario") */
    protected $propietario;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId(){
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Fichero
     */
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * Set fechaSubida
     *
     * @param \DateTime $fechaSubida
     * @return Fichero
     */
    public function setFechaSubida($fechaSubida){
        $this->fechaSubida=$fechaSubida;
    }

    /**
     * Get fechaSubida
     *
     * @return \DateTime 
     */
    public function getFechaSubida(){
        return $this->fechaSubida;
    }

    /**
     * Set fechaBorrado
     *
     * @param \DateTime $fechaBorrado
     * @return Fichero
     */
    public function setFechaBorrado(){
        $this->fechaBorrado=$fechaBorrado;
    }

    /**
     * Get fechaBorrado
     *
     * @return \DateTime 
     */
    public function getFechaBorrado(){
        return $this->fechaBorrado;
    }

    public function __toString(){
        return $this->getNombre();
    }
}