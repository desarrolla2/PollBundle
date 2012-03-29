<?php

namespace Desarrolla2\PollBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use \Desarrolla2\PollBundle\Entity\Poll;
use \Desarrolla2\PollBundle\Entity\PollOption;

class LoadPools extends AbstractFixture implements OrderedFixtureInterface {

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager) {

        for ($i = 1; $i <= 10; $i++) {

            $p = new Poll();
            $p->setTitle('Lorem Ipsum is simply dummy text of the printing and typesetting industry.');
            $p->setBody('Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.');
            $p->setIsActive(round(rand(0,1)));
            $manager->persist($p);

            $o = new PollOption();
            $o->setPoll($p);
            $o->setTitle('Contrary to popular belief.');
            $manager->persist($o);
            ;

            $o = new PollOption();
            $o->setPoll($p);
            $o->setTitle('Lorem Ipsum is not simply random text.');
            $manager->persist($o);

            $o = new PollOption();
            $o->setPoll($p);
            $o->setTitle('It has roots in a piece of classical ');
            $manager->persist($o);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 100;
    }

}