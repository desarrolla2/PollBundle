<?php

namespace Desarrolla2\PollBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Desarrolla2\PollBundle\Form\PollType;
use Desarrolla2\PollBundle\Entity\PollOptionHit;

class PollsController extends Controller {

    /**
     * @Route("/polls", name="_poll_index")
     * @Template()
     * @return array
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        $polls = $em->getRepository('PollBundle:Poll')->findActives();
        
        return array(
            'polls' => $polls,
        );
    }

    /**
     * @Route("/poll/{id}/{slug}", name="_poll_show", requirements={"id" = "[\d]+"}, defaults={ "id" = "1", "slug"= "" })
     * @Template()
     * @return array
     */
    public function showAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        if (!$poll = $em->getRepository('PollBundle:Poll')->findOneById($request->get('id'))) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }

        $options = array();
        foreach ($poll->getOptions() as $option) {
            $options[$option->getId()] = $option->getTitle();
        }

        $form = $this->createFormBuilder()
                ->add('options', 'choice', array(
                    'choices' => $options,
                    'multiple' => false,
                    'expanded' => true,
                ))
                ->getForm();

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $form_request = $request->get('form');
                if (!$poll_option = $em->getRepository('PollBundle:PollOption')->findOneById($form_request['options'])) {
                    throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
                }
                $em->getRepository('PollBundle:Poll')->setHit($poll, $poll_option);
                $this->getRequest()->getSession()->setFlash('notice', 'Muchas gracias hemos recibido su voto.');
                return $this->redirect($this->generateUrl('_poll_report', array('id' => $poll->getId())));
            }
        }

        return array(
            'poll' => $poll,
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/poll/report/{id}", name="_poll_report", requirements={"id" = "[\d]+"}, defaults={ "id" = "1" })
     * @Template()
     * @return array
     */
    public function reportAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        if (!$poll = $em->getRepository('PollBundle:Poll')->findOneById($request->get('id'))) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
        return array(
            'poll' => $poll,
            'poll_options' => $em->getRepository('PollBundle:Poll')->getResult($poll),
        );
    }

}