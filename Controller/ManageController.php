<?php

namespace Desarrolla2\PollBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ManageController extends Controller {

	/**
	 * Show a list of all available polls.
	 */
	public function listAction()
	{
		// TODO: implement listAction
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

		return $this->redirect($this->generateUrl('_poll_manage_list'));s
	}

}
