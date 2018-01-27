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
        $vehiculos = $repository->findAll();

        // Serializer
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        // Se crea el json de vehiculos
        $jsonContent = $serializer->serialize($vehiculos, 'json');
        // Se genera la respuesta incluyendo el json
        $response = JsonResponse::fromJsonString($jsonContent);
        /*$response = new Response(
            $jsonContent,
            Response::HTTP_OK,
            array('content-type' => 'json')
        );*/

        return $response;
    }

    /**
     * @Route("/api/insertarVehiculo", name="api_insertar_vehiculo")
     * @Method({"POST"})
     */
    public function apiInsertarVehiculoAction(Request $request)
    {
        $vehiculo = new Vehiculo();

        $vehiculo->setParameters($request);

        // Guardar nuevo vehiculo en la base de datos
        $em = $this->getDoctrine()->getManager();
        $em->persist($vehiculo);
        $em->flush();

        // Serializer
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        // Se crea el json de vehiculo y se introduce en el response
        $jsonContent = $serializer->serialize($vehiculo, 'json');
        $response = JsonResponse::fromJsonString($jsonContent);

        return $response;
    }

    /**
     * @Route("/api/modificarVehiculo/id={id}", name="api_modificar_vehiculo")
     * @Method({"PUT"})
     */
    public function apiModificarVehiculoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $vehiculo = $em->getRepository(Vehiculo::class)->find($id);
        if (!$vehiculo) {
            throw $this->createNotFoundException(
                'Ningún vehiculo coincide con la id '.$id
            );
        }

        // Llena vehiculo con los datos del json
        $data = json_decode($request->getContent());
        $vehiculo->setParametersFromJson($data);

        // Guardar cambios en la base de datos
        $em = $this->getDoctrine()->getManager();
        $em->persist($vehiculo);
        $em->flush();

        // Serializer
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        // Se crea el json de vehiculo y se introduce en el response
        $jsonContent = $serializer->serialize($vehiculo, 'json');
        $response = JsonResponse::fromJsonString($jsonContent);

        return $response;
    }

    /**
     * @Route("/api/eliminarVehiculo/id={id}", name="api_eliminnar_vehiculo", requirements={"id": "\d+"})
     * @Method({"DELETE"})
     */
    public function apiEliminarVehiculoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $vehiculo = $em->getRepository(Vehiculo::class)->find($id);
        if (!$vehiculo) {
            throw $this->createNotFoundException(
                'Ningún vehiculo coincide con la id '.$id
            );
        }
        // Eliminar vehiculo de la base de datos
        $em->remove($vehiculo);
        $em->flush();

        // Serializer
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        // Se crea el json de vehiculo y se introduce en el response
        $jsonContent = $serializer->serialize($vehiculo, 'json');
        $response = JsonResponse::fromJsonString($jsonContent);

        return $response;
    }
}
