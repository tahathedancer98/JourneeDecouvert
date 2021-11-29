<?php

namespace App\Controller;

use App\Entity\JourneeDecouverte;
use App\Entity\Participation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParticipationController extends AbstractController
{
    #[Route('/nouvelle-participation/{jd}', name: 'participation.add')]
    public function add(JourneeDecouverte $jd, EntityManagerInterface $manager): Response
    {
        if($this->getUser() && $jd) {
            $participation = new Participation();
            $participation->setUser($this->getUser());
            $participation->setJd($jd);
            $participation->setPresent(false);

            $manager->persist($participation);
            $manager->flush();

            return $this->redirectToRoute('jd.index');
        }
        else {
            return $this->redirectToRoute('app_register');
        }
    }
}
