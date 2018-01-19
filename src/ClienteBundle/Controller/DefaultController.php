<?php

namespace ClienteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use ClienteBundle\Form\ClienteType;
use ClienteBundle\Entity\User;

class DefaultController extends Controller
{
  /**
   * @Route("/registro", name="registro")
   */
  public function registroAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
  {
      // 1) build the form
      $user = new User();
      $form = $this->createForm(UserType::class, $user);

      // 2) handle the submit (will only happen on POST)
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {

          // 3) Encode the password (you could also do this via Doctrine listener)
          $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
          $user->setPassword($password);

          // 4) save the User!
          $em = $this->getDoctrine()->getManager();
          $em->persist($user);
          $em->flush();

          // ... do any other work - like sending them an email, etc
          // maybe set a "flash" success message for the user

          return $this->redirectToRoute('replace_with_some_route');
      }

      return $this->render(
          'registration/register.html.twig',
          array('form' => $form->createView())
      );
  }

  /**
   * @Route("/login", name="login")
   */
  public function loginAction()
  {
      return $this->render('ProyectoBundle:Default:login.html.twig');
  }
}
