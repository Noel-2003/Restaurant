<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
            'customers' => $customer,
        ));
    }
    /**
     * @Route("/customer/new", name="customer_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CustomerRepository $customerRepository): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customerRepository->add($customer, true);

            return $this->redirectToRoute('customer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('customer/new.html.twig', [
            'customers' => $customer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/customer/{id}", name="customer_show", methods={"GET"})
     */
    public function show(Customer $customer): Response
    {
        return $this->render('customer/show.html.twig', [
            'customers' => $customer,
        ]);
    }

    /**
     * @Route("/customer/{id}/edit", name="customer_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Customer $customer, CustomerRepository $customerRepository): Response
    {
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customerRepository->add($customer, true);

            return $this->redirectToRoute('customer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('customer/edit.html.twig', [
            'customers' => $customer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/customer/cus{id}", name="customer_delete", methods={"POST"})
     */
    public function delete(Request $request, Customer $customer, CustomerRepository $customerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $customer->getId(), $request->request->get('_token'))) {
            $customerRepository->remove($customer, true);
        }

        return $this->redirectToRoute('customer_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
   * Deletes a customer entity.
   *
   * @Route("/customer/{id}", methods={"DELETE"},name="customer_delete")
   */
  public function deleteAction(Request $request, Customer $customer)
  {
    $form = $this->createDeleteForm($customer);
    $form->handleRequest($customer);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->remove($customer);
      $em->flush();
    }

    return $this->redirectToRoute('customer_index'); // load lai du lieu de updated nhung kh thong bao
  }
  // tao 1 cai form nhu co Tra :c
  /**
   * Creates a form to delete a customer entity.
   *
   * @param Part $customer The customer entity
   *
   * @return Form The form
   */
  /**
   * Deletes a part entity.
   *
   * @Route("/customer/delete/{id}", methods={"DELETE"},name="customer_delete")
   */
  private function createDeleteForm(Customer $customer): Form
  {
    return $this->createFormBuilder()
      ->setAction($this->generateUrl('customer_delete', array('id' => $customer->getId())))
      ->setMethod('DELETE')
      ->getForm()
      ;
  }
}
