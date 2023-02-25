<?php

namespace App\Controller;

use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    /**
     * @Route("/customer",name="customer_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $customer = $em->getRepository(Customer::class)->findAll();

        return $this->render('customer/index.html.twig', array(
            'customer' => $customer,
        ));
    }
}
