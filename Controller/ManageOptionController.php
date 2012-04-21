<?php

namespace Desarrolla2\PollBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doctrine\ORM\NoResultException;

class ManageOptionController extends Controller {

	/**
	 * @Template()
	 * Show the list of options for a Poll
	 * @param $id Poll ID.
	 */
	public function listAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();

		try {
			$poll = $em->getRepository('Desarrolla2PollBundle:Poll')
				->find($id);
		} catch (NoResultException $ex) {
			throw $this->createNotFoundException('Poll was not found.');
		}

		return array(
			'poll' => $poll
		);
	}

	/**
	 * @Template()
	 * Add a new option.
	 * @param $id Poll ID
	 */
	public function addAction($id)
	{
		// TODO: implement addAction
	}

	/**
	 * @Template()
	 * Edit a PollOption with its options.
	 * @param $id Option ID.
	 */
	public function editAction($id)
	{
		// TODO: implement editAction
	}

	/**
	 * Remove a poll with its options.
	 * @param $id Option ID
	 */
	public function removeAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();

		$option = $em->getRepository('Desarrolla2PollBundle:PollOption')
			->find($id);

		$pollID = $option->getPoll()->getID();

		$em->remove($option);
		$em->flush();

		return $this->redirect($this->generateUrl('_poll_manage_options', array(
			'id' => $pollID
		)));
	}

}
