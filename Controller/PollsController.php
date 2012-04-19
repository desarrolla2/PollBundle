<?php

namespace Desarrolla2\PollBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Desarrolla2\PollBundle\Form\PollType;
use Desarrolla2\PollBundle\Entity\PollOptionHit;

class PollsController extends Controller {

    /**
     * @Template()
     * @return array
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $polls = $em->getRepository('PollBundle:Poll')->findActives();
        
        return array(
            'polls' => $polls,
        );
    }

    /**
     * @Template()
     * @param $id ID of the poll.
     * @param $slug 
     * @return array
     */
    public function showAction($id, $slug = '') {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();

        $poll = $em->getRepository('PollBundle:Poll')->find($id);
        if (!$poll) {
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
     * @Template()
     * @param $id ID of the poll.
     * @return array
     */
    public function reportAction($id) {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();

        $poll = $em->getRepository('PollBundle:Poll')->find($id);
        if (!$poll) {
            throw new NotFoundHttpException();
        }

        return array(
            'poll' => $poll,
            'poll_options' => $em->getRepository('PollBundle:Poll')->getResult($poll),
        );
    }

}