<?php

namespace App\Controller;

use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminTypeController extends AbstractController
{
    /**
     * @Route("/admin/type", name="admin_type")
     */
    public function index(TypeRepository $types): Response
    {
        return $this->render('type/admin_type/adminType.html.twig', [
            'types' => $types->findAll(),
        ]);
    }

    /**
     * Permet de d'ajouter et de modifier un type
     *
     * @Route("/admin/type/add", name="admin_type_add")
     * @Route("/admin/type/update/{id}", name="admin_type_update", methods="POST|GET")
     * 
     * @param Type $type
     * @param EntityManagerInterface $manager
     * @param Request $request
     * 
     * @return Response
     */
    public function updateAddType(Type $type = null, EntityManagerInterface $manager, Request $request): Response
    {
        if(!$type) {
            $type = new Type();
        }
        $form = $this->createForm(TypeType::class,$type);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $modif = $type->getId() !== null;
            $manager->persist($type);
            $manager->flush();

            $this->addFlash(
               "success",
               ($modif) ?"Votre type à bien été modifier":
               "Le type a bien été ajouter"
            );

           return $this->redirectToRoute("admin_type");
        }

        return $this->render('type/admin_type/updateAddType.html.twig',[
            'form' => $form->createView(),
            'type' => $type,
            'isUpdate' => $type->getId() !== null 
        ]);
    }

    /**
     * Permet de supprimer un type
     * 
     * @Route("/delete/{id}", name="admin_type_delete", methods="SUP")
     *
     * @param Type $type
     * @param EntityManagerInterface $manager
     * @param Request $request
     * 
     * @return Response
     */
    public function delete(Type $type, Request $request,EntityManagerInterface $manager) : Response
    {
        if($this->isCsrfTokenValid("SUP". $type->getId(), $request->get('_token'))) {
            $manager->remove($type);
            $manager->flush();

            $this->addFlash(
                "success",
                "L'action à été réalisée "
            );

            return $this->redirectToRoute('admin_type');

        }
    }
}
