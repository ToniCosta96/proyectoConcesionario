<?php

namespace ProyectoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use ProyectoBundle\Entity\Vehiculo;

class ApiController extends Controller
{
    /**
     * @Route("/api/vehiculo/id={id}", name="api_vehiculo_id", requirements={"id"="\d+"}, methods={"GET","HEAD"})
     */
    public function vehiculoAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Vehiculo::class);
        $vehiculo = $repository->find($id);
        return $this->render('ProyectoBundle:Vehiculo:vehiculo.html.twig',array('vehiculo'=>$vehiculo));
    }
}
