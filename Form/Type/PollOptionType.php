<?php

namespace Desarrolla2\PollBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PollOptionType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
        $builder->add('title');
	}

	public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Desarrolla2\PollBundle\Entity\PollOption',
            'error_bubbling' => true
        );
    }

	public function getName()
	{
		return "polloption";
	}
}
