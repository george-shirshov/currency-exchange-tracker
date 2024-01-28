<?php

namespace App\Controller;

use App\Service\CurrencyService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrencyController extends AbstractController
{
    public function __construct(
        private readonly CurrencyService $service,
    ) {
    }

    #[Route('/currencies/{numCode}', name: 'currency', requirements: ['numCode' => '^[0-9]{3}$'])]
    public function index(string $numCode): Response
    {
        $currency = $this->service->getByNumCode($numCode);

        return $this->render('currency/index.html.twig', [
            'currency' => $currency,
        ]);
    }
}
