<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Application\Entity\Event;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class DbManager
 * @package Application\Service
 */
class DbManager
{
    private EntityManager $entityManager;

    /**
     * DbManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param int $event_id
     * @return Event|null
     */
    public function getEvent(int $event_id): ?Event
    {
        return $this->entityManager->getRepository(Event::class)->find($event_id);
    }

    /**
     * @param string $start
     * @param string $end
     * @return array
     */
    public function getFilterIntervalDateEvents(string $start, string $end): array
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('e')
            ->from(Event::class,'e')
            ->add('where', $qb->expr()->between(
                'e.date',
                ':from',
                ':to'
            ))
            ->orderBy('e.date', 'ASC')
            ->setParameters([
                'from' => $start,
                'to' => $end
            ]);

        return $qb->getQuery()->getResult();
    }

    /**
     * @param ArrayCollection $data
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveData(ArrayCollection $data): void
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
}