<?php

namespace App\Controller;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAlimentController extends AbstractController
{
    /**
     * Permet d'afficher l'administration des aliments
     * 
     * @Route("/admin/aliments", name="admin_aliments")
     * 
     * @param AlimentRepository $aliments
     * 
     * @return Response
     */
    public function alimentAdmin(AlimentRepository $aliments): Response
    {
        return $this->render('aliment/admin_aliment/adminAliment.html.twig', [
            'aliments' => $aliments->findAll(),
        ]);
    }

    /**
     * Permet de modifer un aliment
     * 
     * @Route("/admin/aliment/add", name="admin_aliment_add")
     * @Route("/admin/aliment/update/{id}", name="admin_aliment_update", methods="GET|POST")
     *
     * @return Response
     */
    public function updateAddAliment(Aliment $aliment= null, Request $request,EntityManagerInterface $manager): Response
    {
        if(!$aliment) {
            $aliment = new Aliment();
        }
        $form = $this->createForm(AlimentType::class,$aliment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $modif = $aliment->getId() !== null;
            $manager->persist($aliment);
            $manager->flush(); 

            $this->addFlash(
                "success",
                ($modif) ? "La modification a bien été effectuer" :
                "l'aliment a bien été ajouter"
            );

            return $this->redirectToRoute('admin_aliments');
        }
        return $this->render('aliment/admin_aliment/updateAddAliment.html.twig',[
            'form'           => $form->createView(), 
            'aliment'        => $aliment,
            'isModification' => $aliment->getId() !== null
        ]);
    }

    /**
     * Permet de supprimer un aliment
     * 
     * @Route("/delete/{id}", name="admin_aliment_delete", methods="delete")
     *
     * @return Response
     */
    public function delete(Aliment $aliment, Request $request,EntityManagerInterface $manager) : Response
    {
        if($this->isCsrfTokenValid("SUP". $aliment->getId(), $request->get('_token'))){

            $manager->remove($aliment);
            $manager->flush();

            $this->addFlash(
                "danger",
                "l'aliment a bien été supprimer"
            );

            return $this->redirectToRoute('admin_aliments');
        }


    }
}
