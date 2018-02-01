<?php

namespace ClienteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use ClienteBundle\Form\UserBasicType;
use ClienteBundle\Entity\User;

class UsuarioController extends Controller
{
    /**
     * @Route("/usuarios/modificarUsuario/id={id}", name="modificar_usuario")
     */
    public function modificarUsuarioAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository(User::class)->find($id);

        if (!$usuario) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $form = $this->createForm(UserBasicType::class, $usuario);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
          // $form->getData() holds the submitted values
          // but, the original `$usuario` variable has also been updated
          $usuario = $form->getData();
          if($usuario->getRoles()=='ROLE_USER'){
            $usuario->setRoles(['ROLE_USER']);
          }else if($usuario->getRoles()=='ROLE_ADMIN'){
            $usuario->setRoles(['ROLE_ADMIN']);
          }

          // ... perform some action, such as saving the task to the database
          // for example, if Task is a Doctrine entity, save it!
          //var_dump($usuario->getRoles());
          $em = $this->getDoctrine()->getManager();
          $em->persist($usuario);
          $em->flush();

          return $this->redirectToRoute('personal', array('id' => $usuario->getId()));
        }
        return $this->render('ClienteBundle:Default:modificarUsuario.html.twig',array('form' => $form->createView(),'usuario' => $usuario));
    }

    /**
     * @Route("/usuarios/eliminarUsuario/id={id}", name="eliminar_usuario")
     */
    public function eliminarUsuarioAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository(User::class)->find($id);
        if (!$usuario) {
            throw $this->createNotFoundException(
                'Ningún vehiculo coincide con la id '.$id
            );
        }
        $em->remove($usuario);
        $em->flush();

        return $this->redirectToRoute('personal');
    }
}
