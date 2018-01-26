<?php

namespace ProyectoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
     * @Route("/api/vehiculo/id={id}", name="api_vehiculo_id", requirements={"id"="\d+"})
     * @Method({"GET","HEAD"})
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
     * @Route("/api/vehiculos", name="api_vehiculos", requirements={"id"="\d+"})
     * @Method({"GET","HEAD"})
     */
    public function apiVehiculosAction()
    {
        $repository = $this->getDoctrine()->getRepository(Vehiculo::class);
        $vehiculo = $repository->findAll();

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $jsonContent = $serializer->serialize($vehiculo, 'json');

        $response = JsonResponse::fromJsonString($jsonContent);
        // $response = new Response(
        //     $jsonContent,
        //     Response::HTTP_OK,
        //     array('content-type' => 'json')
        // );

        return $response;
    }

    /**
     * @Route("/api/insertarVehiculo", name="api_insertar_vehiculo")
     * @Method({"GET","POST"})
     */
    public function apiInsertarVehiculoAction(Request $request)
    {
        $vehiculo = new Vehiculo();

        $vehiculo->setParameters($request);

        $em = $this->getDoctrine()->getManager();
        $em->persist($vehiculo);
        $em->flush();

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($vehiculo, 'json');
        $response = JsonResponse::fromJsonString($jsonContent);
        return $response;
    }
}
