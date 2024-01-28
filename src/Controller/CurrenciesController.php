<?php

namespace App\Controller;

use App\Service\CurrencyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrenciesController extends AbstractController
{
    public function __construct(
        private readonly CurrencyService $service,
    ) {
    }

    #[Route('/currencies', name: 'currencies')]
    public function index(): Response
    {
        $currencies = $this->service->getAll();

        return $this->render('currencies/index.html.twig', [
            'currencies' => $currencies,
        ]);
    }
}
