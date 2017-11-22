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
        return $this->render('ProyectoBundle:Default:vehiculos.html.twig',array('vehiculos'=>$vehiculos, 'pagina'=>$page));
    }

    /**
     * @Route("/vehiculoNombre/{nombre}", name="vehiculo_nombre")
     */
    public function vehiculoNombreAction($nombre = "Vehiculo1")
    {
        $repository = $this->getDoctrine()->getRepository(Vehiculo::class);
        $vehiculos = $repository->findByNombre($nombre);
        return $this->render('ProyectoBundle:Default:vehiculos.html.twig',array('vehiculos'=>$vehiculos, 'pagina'=>1));
    }

    /**
     * @Route("/registro", name="registro")
     */
    public function registroAction()
    {
        return $this->render('ProyectoBundle:Default:registro.html.twig');
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        return $this->render('ProyectoBundle:Default:login.html.twig');
    }

    /**
     * @Route("/personal", name="personal")
     */
    public function personalAction()
    {
        return $this->render('ProyectoBundle:Default:personal.html.twig');
    }
}
