<?php

namespace Desarrolla2\PollBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PollType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
        $builder->add('title');
        $builder->add('body');
        $builder->add('is_active', 'choice', array(
        	'choices' => array(
        		1 => 'Yes',
        		0 => 'No'
        	)
        ));
	}

	public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Desarrolla2\PollBundle\Entity\Poll',
            'error_bubbling' => true
        );
    }

	public function getName()
	{
		return "poll";
	}
}
