<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('home-page.html.twig');
    }

    #[Route('/home', name: 'logged')]
    public function home(): Response
    {
        if($this->get('security.token_storage')->getToken()->getUser() !== null){
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $role = $user->getRoles();$role=$role[0];
            if($role === 'ROLE_OR'){
                return $this->render('OR/home-page.html.twig');
            }else if($role === 'ROLE_BRONZE'){
                return $this->render('BRONZE/home-page.html.twig');
            }else if($role === 'ROLE_ARGENT'){
                return $this->render('ARGENT/home-page.html.twig');
            }
        }
    }
}
