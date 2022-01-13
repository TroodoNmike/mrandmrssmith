<?php

namespace App\Controller;

use App\Entity\Calculator;
use App\Form\CalculatorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    #[Route('/calculator', name: 'calculator')]
    public function index(): Response
    {
        // creates a task object and initializes some data for this example
        $task = new Calculator();
        $task->setFirst(1);
        $task->setSecond(2);

        $form = $this->createForm(CalculatorType::class, $task);

        return $this->render('calculator/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
