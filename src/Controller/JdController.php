<?php

namespace App\Controller;

use App\Entity\JourneeDecouverte;
use App\Form\JdFormType;
use App\Repository\JourneeDecouverteRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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
    public function add(Request $request, EntityManagerInterface $manager, UserRepository $userRepository): Response
    {
        //$jd->setOrganisateur($this->getUser());

        $form = $this->createForm(JdFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $jd = $form->getData();
            $jd->setOrganisateur($userRepository->find(3));
            $manager->persist($jd);
            $manager->flush();
            return $this->redirectToRoute('jd.index');
        }

        return $this->renderForm('jd/add.html.twig', [
            'form' => $form,
        ]);
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
    public function modify($id, Request $request, EntityManagerInterface $manager): Response
    {
        $jd = $this->jdRepository->find($id);

        $form = $this->createForm(JdFormType::class, $jd);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $jd = $form->getData();
            $manager->persist($jd);
            $manager->flush();
            return $this->redirectToRoute('jd.index');
        }

        return $this->renderForm('jd/modify.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/journees-decouverte/delete/{id}', name: 'jd.delete', methods: ['POST'])]
    public function delete(Request $request, JourneeDecouverte $jd, EntityManagerInterface $manager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jd->getId(), $request->request->get('_token'))) {
            $manager->remove($jd);
            $manager->flush();
        }
        return $this->redirectToRoute('jd.index');
    }

}
