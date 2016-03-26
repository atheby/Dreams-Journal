<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Dream;
use AppBundle\Entity\Comment;
use AppBundle\Form\DreamType;

class DreamController extends Controller {
    
    /**
     * @Route("/show", name="dream_show")
     */
    public function ShowDreamAction(Request $request) {
        $dream = $this->getDoctrine()->getRepository('AppBundle:Dream')->find($request->get('dream'));
        return $this->render('dream_show.html.twig', array('dream' => $dream));
    }
    
    /**
     * @Route("/secured/comment", name="comment_add")
     */
    public function AddCommentAction(Request $request) {
        $comment = new Comment();
        $comment->setUser($this->get('security.token_storage')->getToken()->getUser());
        $comment->setDream($this->getDoctrine()->getRepository('AppBundle:Dream')->find($request->get('dream')));
        $comment->setText($request->get('text'));
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();
    
        return $this->forward('AppBundle:Dream:ShowDream', array('request' => $request));
    }
    
    /**
     * @Route("/secured/add", name="dream_add")
     */
    public function AddDreamAction(Request $request) {
        $dream = new Dream();
        $dream->setUser($this->get('security.token_storage')->getToken()->getUser());
        
        $form = $this->createForm(new DreamType(), $dream, array('attr' => array('class' => 'form-horizontal', 'role' => 'form')));
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dream);
            $em->flush();
            return $this->render('secured/dream_added.html.twig');
        }
        return $this->render('/secured/dream_add.html.twig', array('form' => $form->createView(), 'dream' => $dream));
    }
    
    /**
     * @Route("/secured/list", name="dream_list")
     */
    public function ListDreamsAction() {
        return $this->render('wip.html.twig');
    }
}