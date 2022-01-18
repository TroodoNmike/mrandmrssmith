<?php

namespace App\Controller;

use App\Form\CalculatorType;
use App\Service\Calculator;
use App\Service\StorageInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    #[Route('/calculator', name: 'calculator')]
    public function index(Request $request, StorageInterface $storage, Calculator $calculate): Response
    {
        $form = $this->createForm(CalculatorType::class);
        $form->handleRequest($request);

        $result = $storage->get();

        if ($form->isSubmitted() && $form->isValid()) {
            $entry = $form->get('entry');
            $calculationType = $form->get('calculationType')->getData();

            try {
                $result = $calculate->calculate($result, $entry->getData(), $calculationType);
                $storage->save($result);
            } catch (\Exception $e) {
                $entry->addError(new FormError($e->getMessage()));
            }
        }

        return $this->render('calculator/index.html.twig', [
            'form' => $form->createView(),
            'result' => $result
        ]);
    }

    #[Route('/reset', name: 'reset')]
    public function reset(StorageInterface $storage): Response
    {
        $storage->reset();

        return $this->redirectToRoute('calculator');
    }
}
