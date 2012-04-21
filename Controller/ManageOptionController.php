<?php

namespace Desarrolla2\PollBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doctrine\ORM\NoResultException;

use Desarrolla2\PollBundle\Entity\PollOption;
use Desarrolla2\PollBundle\Form\Type\PollOptionType;

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
		$em = $this->getDoctrine()->getEntityManager();

		$poll = $em->getRepository('Desarrolla2PollBundle:Poll')
			->find($id);

		$option = new PollOption();
		$option->setPoll($poll);

        $form = $this->createForm(new PollOptionType(), $option);

        $request = $this->getRequest();
        if ($request->getMethod() === 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em->persist($option);
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
	 * @Template()
	 * Edit a PollOption with its options.
	 * @param $id Option ID.
	 */
	public function editAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();

		$option = $em->getRepository('Desarrolla2PollBundle:PollOption')
			->find($id);

        $form = $this->createForm(new PollOptionType(), $option);

        $request = $this->getRequest();
        if ($request->getMethod() === 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em->persist($option);
                $em->flush();

                return $this->redirect($this->generateUrl('_poll_manage_options', array(
                    'id' => $option->getPoll()->getID()
                )));
            }
        }

        return array(
            'form' => $form->createView(),
            'option' => $option
        );
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
