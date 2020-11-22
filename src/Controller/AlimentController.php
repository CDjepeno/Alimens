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
            'aliments' =>$aliments->findAll(),
            'isCalory' => false,
            'isGlucide' => false
        ]);
    }

    /**
     * Permet de récupérer les aliments moins d'une certaine quantité calories
     *
     * @Route("/aliments/calorie/{calories}", name="alimentsParCalories")
     * 
     * @param AlimentRepository $aliments
     * @param int $calories
     * 
     * @return Response
     */
    public function AlimentPerCalory(AlimentRepository $aliments, $calories): Response 
    {
        return $this->render('aliment/aliments.html.twig',[
            'aliments' => $aliments->getAlimentPerProperty('calory','<',$calories),
            'isCalory' => true,
            'isGlucide' => false
        ]);
    }

    /**
     * Permet de récupérer les aliments moins d'une certaine quantité de glucides
     *
     * @Route("/aliments/glucide/{glucides}", name="alimentsParGlucides")
     * 
     * @param AlimentRepository $aliments
     * @param [type] $glucides
     * 
     * @return Response
     */
    public function AlimentPerGlucides(AlimentRepository $aliments, $glucides): Response
    {
        return $this->render('aliment/aliments.html.twig',[
            'aliments' => $aliments->getAlimentPerProperty('glucide','<',$glucides), 
            'isCalory' => false,
            'isGlucide' => true
        ]);
    }


}
