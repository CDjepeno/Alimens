<?php

namespace App\Controller;

use App\Repository\AlimentRepository;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeController extends AbstractController
{
    /**
     * Permet d'afficher la liste des types
     * @Route("/types", name="types")
     */
    public function type(TypeRepository $types): Response
    {
        return $this->render('type/type.html.twig', [
            'types' => $types->findAll(),
        ]);
    }


}
