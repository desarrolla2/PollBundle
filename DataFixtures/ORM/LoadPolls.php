<?php

namespace Desarrolla2\PollBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use \Desarrolla2\PollBundle\Entity\Poll;
use \Desarrolla2\PollBundle\Entity\PollOption;

class LoadPools extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $p = new Poll();
        $p->setTitle('Que quieres ver en nuestra próxima reunión');
        $p->setBody('Descripción de la encuenta si fuera necesario.');
        $p->setIsActive(1);        
        $manager->persist($p);
        
        $o = new PollOption();
        $o->setPoll($p);
        $o->setTitle('Un curso de cocina tradicional con Moi ');
        $manager->persist($o);;
        
        $o = new PollOption();
        $o->setPoll($p);
        $o->setTitle('Una presentación de danza del vientre con Oskar');
        $manager->persist($o);
        
        $o = new PollOption();
        $o->setPoll($p);
        $o->setTitle('Mejor por una vez algo de symfony no? ');
        $manager->persist($o);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}