<?php

namespace Desarrolla2\PollBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
	 * Add a new poll with new options.
	 */
	public function addAction()
	{
		// TODO: implement addAction
	}

	/**
	 * Edit a poll with its options.
	 * @param $id The ID of the poll.
	 */
	public function editAction($id)
	{
		// TODO: implement editAction
	}

	/**
	 * Remove a poll with its options.
	 * @param $id The ID of the poll.
	 */
	public function removeAction($id)
	{
		$em = $this->getDoctrine()->getRepository();

		$poll = $em->getRepository('Desarrolla2PollBundle:Poll')
			->find($id);

		$em->remove($poll);
		$em->flush();

		return $this->redirect($this->generateUrl('_poll_manage_list'));
	}

}
