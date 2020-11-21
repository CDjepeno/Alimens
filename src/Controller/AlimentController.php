<?php

namespace App\Controller;

use App\Repository\AlimentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlimentController extends AbstractController
{
    /**
     * Permet d'afficher la page d'accueuil
     * 
     * @Route("/", name="aliments")
     * 
     * @param AlimentRepository $aliments
     * 
     * @return Response
     */
    public function index(AlimentRepository $aliments): Response
    {
        return $this->render('aliment/aliments.html.twig', [
            'aliments' =>$aliments->findAll()
        ]);
    }

    /**
     * Permet de récupérer les aliments moins de 50 calories
     *
     * @Route("aliment/{calories}", name="alimentParCalorie")
     * 
     * @param AlimentRepository $aliments
     * 
     * @return Response
     */
    public function AlimentParCalories(AlimentRepository $aliments, $calories): Response 
    {
        $ali = $aliments->getAlimentMinCalorie($calories);

        // dd($ali);
        return $this->render('aliment/aliments.html.twig',[
            'aliments' => $aliments->getAlimentMinCalorie($calories)
        ]);
    }
}
