<?php

namespace ProyectoBundle\Entity;

use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehiculo
 *
 * @ORM\Table(name="vehiculo")
 * @ORM\Entity(repositoryClass="ProyectoBundle\Repository\VehiculoRepository")
 */
class Vehiculo
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_corta", type="string", length=255)
     */
    private $descripcionCorta;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=800)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="decimal", precision=10, scale=2)
     */
    private $precio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_adquisicion", type="date")
     */
    private $fechaAdquisicion;

    /**
     * @var string
     *
     * @ORM\Column(name="detalles", type="string", length=800, nullable=true)
     */
    private $detalles;

    /**
     * @var int
     *
     * @ORM\Column(name="kilometros", type="integer")
     */
    private $kilometros;

    /**
     * @var bool
     *
     * @ORM\Column(name="en_venta", type="boolean")
     */
    private $enVenta;

    /**
     * @var int
     *
     * @ORM\Column(name="usuario_id", type="integer", nullable=true)
     */
    private $usuarioId;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Vehiculo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcionCorta
     *
     * @param string $descripcionCorta
     *
     * @return Vehiculo
     */
    public function setDescripcionCorta($descripcionCorta)
    {
        $this->descripcionCorta = $descripcionCorta;

        return $this;
    }

    /**
     * Get descripcionCorta
     *
     * @return string
     */
    public function getDescripcionCorta()
    {
        return $this->descripcionCorta;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Vehiculo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Vehiculo
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set precio
     *
     * @param string $precio
     *
     * @return Vehiculo
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set fechaAdquisicion
     *
     * @param \DateTime $fechaAdquisicion
     *
     * @return Vehiculo
     */
    public function setFechaAdquisicion($fechaAdquisicion)
    {
        $this->fechaAdquisicion = $fechaAdquisicion;

        return $this;
    }

    /**
     * Get fechaAdquisicion
     *
     * @return \DateTime
     */
    public function getFechaAdquisicion()
    {
        return $this->fechaAdquisicion;
    }

    /**
     * Set enVenta
     *
     * @param boolean $enVenta
     *
     * @return Vehiculo
     */
    public function setEnVenta($enVenta)
    {
        $this->enVenta = $enVenta;

        return $this;
    }

    /**
     * Get enVenta
     *
     * @return bool
     */
    public function getEnVenta()
    {
        return $this->enVenta;
    }

    /**
     * Set detalles
     *
     * @param string $detalles
     *
     * @return Vehiculo
     */
    public function setDetalles($detalles)
    {
        $this->detalles = $detalles;

        return $this;
    }

    /**
     * Get detalles
     *
     * @return string
     */
    public function getDetalles()
    {
        return $this->detalles;
    }

    /**
     * Set kilometros
     *
     * @param integer $kilometros
     *
     * @return Vehiculo
     */
    public function setKilometros($kilometros)
    {
        $this->kilometros = $kilometros;

        return $this;
    }

    /**
     * Get kilometros
     *
     * @return int
     */
    public function getKilometros()
    {
        return $this->kilometros;
    }

    /**
     * Set usuarioId
     *
     * @param integer $usuarioId
     *
     * @return Vehiculo
     */
    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;

        return $this;
    }

    /**
     * Get usuarioId
     *
     * @return integer
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function setParameters(Request $request){
        $this->nombre = $request->request->get("nombre");
        $this->descripcionCorta = $request->request->get("descripcionCorta");
        $this->descripcion = $request->request->get("descripcion");
        $this->imagen = $request->request->get("imagen");
        $this->precio = $request->request->get("precio");
        $this->fechaAdquisicion = new \DateTime($request->request->get("fechaAdquisicion"));
        $this->detalles = $request->request->get("detalles");
        $this->kilometros = $request->request->get("kilometros");
        $this->enVenta = $request->request->get("enVenta");
        $this->usuarioId = $request->request->get("usuarioId");

        return $this;
    }

    public function setParametersFromJson($data){
        $this->nombre = $data->{'nombre'};
        $this->descripcionCorta = $data->{'descripcionCorta'};
        $this->descripcion = $data->{'descripcion'};
        $this->imagen = $data->{'imagen'};
        $this->precio = $data->{'precio'};
        $this->fechaAdquisicion = new \DateTime($data->{'fechaAdquisicion'});
        $this->detalles = $data->{'detalles'};
        $this->kilometros = $data->{'kilometros'};
        $this->enVenta = $data->{'enVenta'};
        //$this->usuarioId = $data->{'detalles'};

        return $this;
    }
}
