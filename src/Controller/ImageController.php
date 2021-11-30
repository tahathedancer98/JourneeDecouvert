<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\JourneeDecouverte;
use App\Form\ImageJdFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ImageController extends AbstractController
{
    #[Route('/ajouter/images/{jd}', name: 'image.index')]
    public function index(JourneeDecouverte $jd, Request $request, EntityManagerInterface $manager): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageJdFormType::class, $image);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('name')->getData();

            if ($imageFile instanceof UploadedFile) {
                $originalFilename = $imageFile->getClientOriginalName();

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'), $originalFilename
                    );
                } catch (FileException $e) {
                    return $this->render('image/index.html.twig', [
                        'jd' => $jd,
                        'message' => $e
                    ]);
                }

                $image->setName($originalFilename);
                $image->setJd($jd);
                $manager->persist($image);
                $manager->flush();
            }

            return $this->redirectToRoute('jd.detail', [
                'id' => $jd->getId(),
            ]);
        }
        return $this->renderForm('image/index.html.twig', [
            'imageForm' => $form,
            'jd' => $jd,
            'message' => ''
        ]);
    }
}
