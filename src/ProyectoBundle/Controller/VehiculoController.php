<?php

namespace ProyectoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;
use ProyectoBundle\Entity\Vehiculo;
use ProyectoBundle\Form\VehiculoType;

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

    /**
     * @Route("/crearVehiculo", name="crear_vehiculo")
     */
    public function crearVehiculoAction(Request $request)
    {
        $vehiculo = new Vehiculo();

        $form = $this->createForm(VehiculoType::class, $vehiculo);
        //$form->add('save', SubmitType::class, array('label' => 'Crear cerveza'));

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
          // $form->getData() holds the submitted values
          // but, the original `$vehiculo` variable has also been updated
          $vehiculo = $form->getData();


          // ... perform some action, such as saving the task to the database
          // for example, if Task is a Doctrine entity, save it!
          $em = $this->getDoctrine()->getManager();
          $em->persist($vehiculo);
          $em->flush();
          $idVehiculo = $vehiculo->getId();

          return $this->redirectToRoute('vehiculo_id', array('entity' => $idVehiculo));
        }
        return $this->render('ProyectoBundle:Vehiculo:crearVehiculo.html.twig',array('form' => $form->createView()));
    }
}
