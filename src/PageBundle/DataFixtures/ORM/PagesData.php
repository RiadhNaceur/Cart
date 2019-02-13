<?php
namespace PageBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PageBundle\Entity\Pages;

class PagesData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $page1 = new Pages();
        $page1->setTitre('CGV');
        $page1->setContenu('<h1>CGV</h1><section> Lorem Lipsum Lorem Lipsum Lorem Lipsum <br />
        Lorem Lipsum Lorem Lipsum Lorem Lipsum Lorem Lipsum Lorem Lipsum Lorem Lipsum <br /><hr>
        </section>
        <section>Lorem Lipsum Lorem Lipsum Lorem Lipsum <br />
        Lorem Lipsum Lorem Lipsum Lorem Lipsum Lorem Lipsum Lorem Lipsum Lorem Lipsum <br /></section>');
        $manager->persist($page1);

        $page2 = new Pages();
        $page2->setTitre('Mentions Légales');
        $page2->setContenu('<h1>ML</h1><section> Lorem Lipsum Lorem Lipsum Lorem Lipsum <br />
        Lorem Lipsum Lorem Lipsum Lorem Lipsum Lorem Lipsum Lorem Lipsum Lorem Lipsum <br /><hr>
        </section>
        <section>Lorem Lipsum Lorem Lipsum Lorem Lipsum <br />
        Lorem Lipsum Lorem Lipsum Lorem Lipsum Lorem Lipsum Lorem Lipsum Lorem Lipsum <br /></section>');
        $manager->persist($page2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 8;
    }
}