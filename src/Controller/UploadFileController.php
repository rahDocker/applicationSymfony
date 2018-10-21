<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\UploadFile;
use App\Form\UploadType;
use App\Service\FileUploader;

class UploadFileController extends AbstractController
{
    /**
     * @Route("/choix", name="choix")
     */
    public function uploadAction(Request $request)
    {
        $upload = new UploadFile();
        $form = $this->createForm(UploadType::class, $upload);
        $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $upload->getName();
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('uploads_directory'),
                    $fileName
                );
            } catch (FileException $e) {}
            $upload->setName($fileName);
            $upload->setIduser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($upload);
            $em->flush();
            return $this->redirectToRoute('choix');
        }
            $files=  $this->affichageFilesAction();
            return $this->render('EspacePersonnel/choix.html.twig', array(
                'form' => $form->createView(),
                'list' => $files,
            ));
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    /**
     * @Route("/show", name="show")
     */
    function affichageFilesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $formFile = $this->createForm(UploadType::class);
        $listMesFiles = $em->getRepository(UploadFile::class)->affichageUploadByUser($user);
        return $listMesFiles;
    }

}