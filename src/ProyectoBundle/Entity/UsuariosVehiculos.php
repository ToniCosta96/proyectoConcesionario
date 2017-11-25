<?php

namespace ProyectoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsuariosVehiculos
 *
 * @ORM\Table(name="usuarios_vehiculos")
 * @ORM\Entity(repositoryClass="ProyectoBundle\Repository\UsuariosVehiculosRepository")
 */
class UsuariosVehiculos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_vehiculo", type="integer")
     */
    private $idVehiculo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_compra", type="date")
     */
    private $fechaCompra;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idVehiculo
     *
     * @param integer $idVehiculo
     *
     * @return UsuariosVehiculos
     */
    public function setIdVehiculo($idVehiculo)
    {
        $this->idVehiculo = $idVehiculo;

        return $this;
    }

    /**
     * Get idVehiculo
     *
     * @return int
     */
    public function getIdVehiculo()
    {
        return $this->idVehiculo;
    }

    /**
     * Set fechaCompra
     *
     * @param \DateTime $fechaCompra
     *
     * @return UsuariosVehiculos
     */
    public function setFechaCompra($fechaCompra)
    {
        $this->fechaCompra = $fechaCompra;

        return $this;
    }

    /**
     * Get fechaCompra
     *
     * @return \DateTime
     */
    public function getFechaCompra()
    {
        return $this->fechaCompra;
    }
}

