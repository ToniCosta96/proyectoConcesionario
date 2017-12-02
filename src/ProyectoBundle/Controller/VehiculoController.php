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
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
          // $form->getData() holds the submitted values
          // but, the original `$vehiculo` variable has also been updated
          $vehiculo = $form->getData();
          // Guardar vehiculo
          $em = $this->getDoctrine()->getManager();
          $em->persist($vehiculo);
          $em->flush();

          return $this->redirectToRoute('vehiculo_id', array('id' => $vehiculo->getId()));
        }
        return $this->render('ProyectoBundle:Vehiculo:crearVehiculo.html.twig',array('form' => $form->createView()));
    }

    /**
     * @Route("/modificarVehiculo/id={id}", name="modificar_vehiculo")
     */
    public function modificarVehiculoAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $vehiculo = $em->getRepository(Vehiculo::class)->find($id);

        if (!$vehiculo) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $form = $this->createForm(VehiculoType::class, $vehiculo);

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

          return $this->redirectToRoute('vehiculo_id', array('id' => $vehiculo->getId()));
        }
        return $this->render('ProyectoBundle:Vehiculo:modificarVehiculo.html.twig',array('form' => $form->createView(),'vehiculo' => $vehiculo));
    }

    /**
     * @Route("/eliminarVehiculo/id={id}", name="eliminar_vehiculo")
     */
    public function eliminarVehiculoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $vehiculo = $em->getRepository(Vehiculo::class)->find($id);
        if (!$vehiculo) {
            throw $this->createNotFoundException(
                'Ningún vehiculo coincide con la id '.$id
            );
        }
        $em->remove($vehiculo);
        $em->flush();

        return $this->redirectToRoute('personal');
    }
}
