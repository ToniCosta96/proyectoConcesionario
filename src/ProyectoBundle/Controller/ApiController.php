<?php

namespace ProyectoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use ProyectoBundle\Entity\Vehiculo;

class ApiController extends Controller
{
    /**
     * @Route("/api/vehiculo/id={id}", name="api_vehiculo_id", requirements={"id"="\d+"}, methods={"GET","HEAD"})
     */
    public function apiVehiculoAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Vehiculo::class);
        $vehiculo = $repository->find($id);
        $response = new JsonResponse(array(
          'id' => $vehiculo->getId(),
          'nombre' => $vehiculo->getNombre(),
          'descripcionCorta' => $vehiculo->getDescripcionCorta(),
          'descripcion' => $vehiculo->getDescripcion(),
          'imagen' => $vehiculo->getImagen(),
          'precio' => $vehiculo->getPrecio(),
          'fechaAdquisicion' => $vehiculo->getFechaAdquisicion(),
          'enVenta' => $vehiculo->getEnVenta(),
          'detalles' => $vehiculo->getDetalles(),
          'kilometros' => $vehiculo->getKilometros()
          //'usuario' => $vehiculo->getUsuarioId()
        ));
        return $response;
    }

    /**
     * @Route("/api/vehiculos", name="api_vehiculos", requirements={"id"="\d+"}, methods={"GET","HEAD"})
     */
    public function apiVehiculosAction()
    {
        $repository = $this->getDoctrine()->getRepository(Vehiculo::class);
        $vehiculo = $repository->findAll();

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($vehiculo, 'json');

        $response = new Response(
            $jsonContent,
            Response::HTTP_OK,
            array('content-type' => 'json')
        );

        return $response;
    }
}
