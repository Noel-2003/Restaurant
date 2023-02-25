<?php

namespace App\Controller;

use App\Entity\Food;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends AbstractController
{
    /**
     * @Route("/food", name="food_index")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $data = $em->getRepository(Food::class)->findAll();

        return $this->render('food/index.html.twig', [
            'food' => $data,
        ]);
    }
}
