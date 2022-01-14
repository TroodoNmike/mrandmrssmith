<?php

namespace App\Controller;

use App\Entity\Calculator;
use App\Form\CalculatorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    const SESSION_RESULT_KEY = 'result';

    #[Route('/calculator', name: 'calculator')]
    public function index(Request $request): Response
    {
        $calculator = new Calculator();

        // Retrieve last result stored in session
        $calculator->setResult($request->getSession()->get(self::SESSION_RESULT_KEY, $calculator->getResult()));

        $form = $this->createForm(CalculatorType::class, $calculator);

        try {
            $form->handleRequest($request);
        } catch (\Throwable) {
            $form->get('entry')->addError(new FormError('Something went wrong'));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Calculator $calculator */
            $calculator = $form->getData();

            // save result in session for next use
            $request->getSession()->set(self::SESSION_RESULT_KEY, $calculator->getResult());
        }

        return $this->render('calculator/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reset', name: 'reset')]
    public function reset(Request $request): Response
    {
        $request->getSession()->set(self::SESSION_RESULT_KEY, 0);

        return $this->redirectToRoute('calculator');
    }
}
