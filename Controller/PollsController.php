<?php

namespace Desarrolla2\PollBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PollsController extends Controller {

    /**
     * @Template()
     * @return array
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $polls = $em->getRepository('Desarrolla2PollBundle:Poll')
            ->findActives();
        
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

        $poll = $em->getRepository('Desarrolla2PollBundle:Poll')
            ->find($id);
        if (!$poll) {
            throw new NotFoundHttpException();
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

                $poll_option = $em->getRepository('Desarrolla2PollBundle:PollOption')
                    ->findOneById($form_request['options']);
                if (!$poll_option) {
                    throw new NotFoundHttpException();
                }

                $em->getRepository('Desarrolla2PollBundle:Poll')->setHit($poll, $poll_option);
                $this->getRequest()->getSession()->setFlash('notice', 'Thanks for voting!');

                return $this->redirect($this->generateUrl('_poll_report', array(
                    'id' => $poll->getId()
                )));
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
        $em = $this->getDoctrine()->getEntityManager();

        $poll = $em->getRepository('Desarrolla2PollBundle:Poll')
            ->find($id);
        if (!$poll) {
            throw new NotFoundHttpException();
        }

        $pollOptions = $em->getRepository('Desarrolla2PollBundle:Poll')
            ->getResult($poll);

        $number = 0;
        foreach ($pollOptions as $option) {
            $number += $option['hits'];
        }

        $pollInfo = array(
            'poll' => $poll,
            'poll_options' => $pollOptions,
            'number' => $number
        );

        if ($this->getRequest()->isXmlHttpRequest()) {
            return new Response(json_encode($pollInfo), 200);
        } else {
            return $pollInfo;
        }
    }

}