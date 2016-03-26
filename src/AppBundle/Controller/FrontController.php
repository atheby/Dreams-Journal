<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\RegisterType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class FrontController extends Controller {
    
    /**
     * @Route("/{page}", name="homepage", defaults={"page" = 1}, requirements={"page": "\d+"})
     */
    public function indexAction($page) {
        $dreams = $this->getDoctrine()->getRepository('AppBundle:Dream')->findAllLatest($page);
        return $this->render('index.html.twig', array('dreams' => $dreams, 'page' => $page));
    }
    
    public function showFactAction() {
        $em = $this->getDoctrine()->getManager();
        $fact = $em->getRepository('AppBundle:Fact')->getRandomFact();
        return $this->render('random_fact.html.twig', array('fact' => $fact));
    }
    
    public function showRightNavAction() {
        return $this->render('/secured/right_nav.html.twig');
    }
    
    /**
     * @Route("/login", name="user_login")
     */
    public function loginAction() {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login.html.twig', array('last_username' => $lastUsername, 'error' => $error,));
    }
    
    /**
     * @Route("/logout", name="user_logout")
     */
    public function logoutAction() {
    }
    
    /**
     * @Route("/register", name="user_register")
     */
    public function registerAction(Request $request) {
        $user = new User();
        
        $form = $this->createForm(new RegisterType(), $user, array('attr' => array('class' => 'form-horizontal', 'role' => 'form')));
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $password = $this->get('security.password_encoder')->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->render('registered.html.twig');
        }
        return $this->render('register.html.twig', array('form' => $form->createView(),));
    }
    
    /**
     * @Route("/secured/profile", name="user_profile")
     */
    public function profileAction() {
        return $this->render('wip.html.twig');
    }
}
