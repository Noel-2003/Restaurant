<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/customer/c/r/u/d")
 */
class CustomerCRUDController extends AbstractController
{
    /**
     * @Route("/", name="app_customer_c_r_u_d_index", methods={"GET"})
     */
    public function index(CustomerRepository $customerRepository): Response
    {
        return $this->render('customer_crud/index.html.twig', [
            'customers' => $customerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_customer_c_r_u_d_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CustomerRepository $customerRepository): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customerRepository->add($customer, true);

            return $this->redirectToRoute('app_customer_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('customer_crud/new.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_customer_c_r_u_d_show", methods={"GET"})
     */
    public function show(Customer $customer): Response
    {
        return $this->render('customer_crud/show.html.twig', [
            'customer' => $customer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_customer_c_r_u_d_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Customer $customer, CustomerRepository $customerRepository): Response
    {
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customerRepository->add($customer, true);

            return $this->redirectToRoute('app_customer_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('customer_crud/edit.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_customer_c_r_u_d_delete", methods={"POST"})
     */
    public function delete(Request $request, Customer $customer, CustomerRepository $customerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$customer->getId(), $request->request->get('_token'))) {
            $customerRepository->remove($customer, true);
        }

        return $this->redirectToRoute('app_customer_c_r_u_d_index', [], Response::HTTP_SEE_OTHER);
    }
}
