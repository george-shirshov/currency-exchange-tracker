<?php

namespace App\Command;

use App\Repository\CurrencyRepository;
use App\Service\DownloadCurrenciesService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

#[AsCommand(
    name: 'download:quotes',
    description: 'Получение значений валют',
)]
class DownloadQuotesCommand extends Command
{
    public function __construct(
        private readonly DownloadCurrenciesService $downloadQuotesService,
        private readonly CurrencyRepository $currencyRepository,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $currencies = $this->downloadQuotesService->fetch();

            $this->currencyRepository->updateOrCreateAll($currencies);

            return Command::SUCCESS;
        } catch (TransportExceptionInterface|ServerExceptionInterface|RedirectionExceptionInterface|ClientExceptionInterface $e) {
            $io->error($e->getMessage());
            return Command::FAILURE;
        }
    }
}
