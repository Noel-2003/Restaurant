<?php

namespace App\Controller;

use App\Entity\Chef;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChefController extends AbstractController
{
    /**
     * @Route("/chef", name="chef_index")
     */
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $chef = $em->getRepository(Chef::class)->findAll();

        return $this->render('customer/index.html.twig', array(
            'chef' => $chef,
        ));
    }
}
