<?php

namespace Desarrolla2\PollBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Desarrolla2\PollBundle\Entity\Poll;
use Desarrolla2\PollBundle\Form\Type\PollType;

use DateTime;

class ManageController extends Controller {

	/**
	 * @Template()
	 * Show a list of all available polls.
	 */
	public function listAction()
	{
		$em = $this->getDoctrine()->getEntityManager();

		$polls = $em->getRepository('Desarrolla2PollBundle:Poll')
			->findAll();

		return array(
			'polls' => $polls
		);
	}

	/**
	 * @Template()
	 * Add a new Poll.
	 */
	public function addAction()
	{
		$em = $this->getDoctrine()->getEntityManager();

		$poll = new Poll();

        $form = $this->createForm(new PollType(), $poll);

        $request = $this->getRequest();
        if ($request->getMethod() === 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
            	$poll->setDate(new DateTime());

                $em->persist($poll);
                $em->flush();

                return $this->redirect($this->generateUrl('_poll_manage_options', array(
                    'id' => $poll->getID()
                )));
            }
        }

        return array(
            'form' => $form->createView()
        );
	}

	/**
	 * @Template()
	 * Edit a Poll with its options.
	 * @param $id Poll ID.
	 */
	public function editAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();

		$poll = $em->getRepository('Desarrolla2PollBundle:Poll')
			->find($id);

        $form = $this->createForm(new PollType(), $poll);

        $request = $this->getRequest();
        if ($request->getMethod() === 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em->persist($poll);
                $em->flush();

                return $this->redirect($this->generateUrl('_poll_manage_options', array(
                    'id' => $poll->getID()
                )));
            }
        }

        return array(
            'form' => $form->createView(),
            'poll' => $poll
        );
	}

	/**
	 * Remove a poll with its options.
	 * @param $id The ID of the poll.
	 */
	public function removeAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();

		$poll = $em->getRepository('Desarrolla2PollBundle:Poll')
			->find($id);

		$em->remove($poll);
		$em->flush();

		return $this->redirect($this->generateUrl('_poll_manage_list'));
	}

}
