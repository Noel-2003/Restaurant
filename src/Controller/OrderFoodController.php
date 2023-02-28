<?php

namespace App\Controller;

use App\Entity\OrderFood;
use App\Form\OrderFoodType;
use App\Repository\OrderFoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/order/food")
 */
class OrderFoodController extends AbstractController
{
    /**
     * @Route("/", name="app_order_food_index", methods={"GET"})
     */
    public function index(OrderFoodRepository $orderFoodRepository): Response
    {
        return $this->render('order_food/index.html.twig', [
            'order_foods' => $orderFoodRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_order_food_new", methods={"GET", "POST"})
     */
    public function new(Request $request, OrderFoodRepository $orderFoodRepository): Response
    {
        $orderFood = new OrderFood();
        $form = $this->createForm(OrderFoodType::class, $orderFood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $orderFoodRepository->add($orderFood, true);

            return $this->redirectToRoute('app_order_food_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('order_food/new.html.twig', [
            'order_food' => $orderFood,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_order_food_show", methods={"GET"})
     */
    public function show(OrderFood $orderFood): Response
    {
        return $this->render('order_food/show.html.twig', [
            'order_food' => $orderFood,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_order_food_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, OrderFood $orderFood, OrderFoodRepository $orderFoodRepository): Response
    {
        $form = $this->createForm(OrderFoodType::class, $orderFood);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $orderFoodRepository->add($orderFood, true);

            return $this->redirectToRoute('app_order_food_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('order_food/edit.html.twig', [
            'order_food' => $orderFood,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_order_food_delete", methods={"POST"})
     */
    public function delete(Request $request, OrderFood $orderFood, OrderFoodRepository $orderFoodRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$orderFood->getId(), $request->request->get('_token'))) {
            $orderFoodRepository->remove($orderFood, true);
        }

        return $this->redirectToRoute('app_order_food_index', [], Response::HTTP_SEE_OTHER);
    }
}
