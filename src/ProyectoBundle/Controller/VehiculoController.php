<?php

namespace ProyectoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use ProyectoBundle\Entity\Vehiculo;

class VehiculoController extends Controller
{
    /**
     * @Route("/vehiculo/id={id}", name="vehiculo_id", requirements={"id": "\d+"})
     */
    public function vehiculoAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Vehiculo::class);
        $vehiculo = $repository->find($id);
        return $this->render('ProyectoBundle:Vehiculo:vehiculo.html.twig',array('vehiculo'=>$vehiculo));
    }
}
