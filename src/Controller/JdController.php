<?php

namespace App\Controller;

use App\Entity\JourneeDecouverte;
use App\Form\JdType;
use App\Repository\JourneeDecouverteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JdController extends AbstractController
{

    protected $jdRepository;

    public function __construct(JourneeDecouverteRepository $journeeDecouverteRepository)
    {
        $this->jdRepository = $journeeDecouverteRepository;
    }

    #[Route('/journees-decouverte', name: 'jd.index')]
    public function index(): Response
    {
        //Condition si User co on ajoute un bouton pour créer une JD
        $jdAll = $this->jdRepository->findAllOrderByDate();

        return $this->render('jd/index.html.twig', [
            'jdAll' => $jdAll,
        ]);
    }

    #[Route('/journees-decouverte/ajouter', name: 'jd.add')]
    public function add(): Response
    {
        $jd = new JourneeDecouverte();
        //$jd->setOrganisateur(this->getUser()');
        $form = $this->createForm(JdType::class, $jd);
        return $this->renderForm('jd/add.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/journees-decouverte/store', name: 'jd.store', methods: 'post')]
    public function store(Request $request): Response
    {
        dd(json_decode($request->getContent()));
        dd($request->request->get('title'));

    }

    #[Route('/journees-decouverte/details/{id}', name: 'jd.detail')]
    public function detail($id): Response
    {
        $jd = $this->jdRepository->find($id);
        return $this->render('jd/details.html.twig', [
            'jd' => $jd,
        ]);
    }

    #[Route('/journees-decouverte/modifier/{id}', name: 'jd.modifiy')]
    public function modify($id): Response
    {
        dd($id);
    }

    #[Route('/journees-decouverte/update/{id}', name: 'jd.update', methods: 'put')]
    public function update($id): Response
    {
        dd($id);
    }

    #[Route('/journees-decouverte/delete', name: 'jd.delete', methods: 'delete')]
    public function delete(Request $request): Response
    {
        dd();

    }

}
