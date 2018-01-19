<?php

namespace ProyectoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use ProyectoBundle\Entity\Vehiculo;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        return $this->render('ProyectoBundle:Default:index.html.twig');
    }

    /**
     * @Route("/vehiculos/page={page}", name="vehiculos")
     */
    public function vehiculosAction($page)
    {
        $repository = $this->getDoctrine()->getRepository(Vehiculo::class);
        $vehiculos = $repository->getVehiculos($page,6);
        return $this->render('ProyectoBundle:Default:vehiculos.html.twig', array('vehiculos'=>$vehiculos, 'pagina'=>$page));
    }

    /**
     * @Route("/personal", name="personal")
     */
    public function personalAction()
    {
        $repository = $this->getDoctrine()->getRepository(Vehiculo::class);
        $vehiculos = $repository->findAll();
        return $this->render('ProyectoBundle:Default:personal.html.twig', array('vehiculos'=>$vehiculos));
    }
}
