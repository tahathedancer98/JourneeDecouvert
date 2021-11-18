<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentaireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 3; $i++) {
            $commentaire[$i] = new Commentaire();
            $commentaire[$i]->setContent('gkjehkgj zehg zgl ihrzghler gakjgaj jkz');
            $commentaire[$i]->setUser($this->getReference(UserFixtures::USER_BRONZE));
            //$commentaire[$i]->
            $manager->persist($commentaire[$i]);
        }

        for ($i = 3; $i < 6; $i++) {
            $commentaire[$i] = new Commentaire();
            $commentaire[$i]->setContent('lfkabhfjkabgjk bajbg jkabgj bjkbgaj bgjabgj abgjkbabg');
            $commentaire[$i]->setUser($this->getReference(UserFixtures::USER_ARGENT));
            //JD
            $manager->persist($commentaire[$i]);
        }

        for ($i = 6; $i < 9; $i++) {
            $commentaire[$i] = new Commentaire();
            $commentaire[$i]->setContent('gkjehkgj zehg zgl ihrzghler gakjgaj jkz');
            $commentaire[$i]->setUser($this->getReference(UserFixtures::USER_OR));
            //JD
            $manager->persist($commentaire[$i]);
        }
        $manager->flush();
    }
}