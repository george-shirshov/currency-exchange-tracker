<?php

namespace App\Repository;

use App\Entity\Currency;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Currency>
 *
 * @method Currency|null find($id, $lockMode = null, $lockVersion = null)
 * @method Currency|null findOneBy(array $criteria, array $orderBy = null)
 * @method Currency[]    findAll()
 * @method Currency[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CurrencyRepository extends ServiceEntityRepository
{
    private readonly EntityManagerInterface $manager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Currency::class);
        $this->manager = $this->getEntityManager();
    }

    /** @param Currency[] $currencies */
    public function updateOrCreateAll(array $currencies): void
    {
        foreach ($currencies as $currency) {
            $currentCurrency = $this->findOneBy(['numCode' => $currency->getNumCode()]);

            if (empty($currentCurrency)) {
                $this->create($currency);
            } else {
                $this->update($currentCurrency, $currency);
            }
        }
    }

    public function update(Currency $currentCurrency, Currency $newCurrency): void
    {
        $currentCurrency->setValue($newCurrency->getValue());
        $currentCurrency->setUnitRate($newCurrency->getUnitRate());

        $this->manager->flush();
    }

    public function create(Currency $currency): void
    {
        $this->manager->persist($currency);
        $this->manager->flush();
    }

    public function getByNumCode(string $numCode): Currency
    {
        return $this->findOneBy(['numCode' => $numCode]);
    }
}
