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
     * @Route("/vehiculos", name="vehiculos")
     */
    public function vehiculosAction()
    {
        $repository = $this->getDoctrine()->getRepository(Vehiculo::class);
        $vehiculos = $repository->findAll();
        return $this->render('ProyectoBundle:Default:vehiculos.html.twig',array('vehiculos'=>$vehiculos));
    }

    /**
     * @Route("/vehiculo/id={id}", name="vehiculo_id", requirements={"id": "\d+"})
     */
    public function vehiculoAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Vehiculo::class);
        $vehiculo = $repository->find($id);
        return $this->render('ProyectoBundle:Default:vehiculo.html.twig',array('vehiculo'=>$vehiculo));
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
