<?php

namespace Application\Service;

use DateTime;
use DateTimeZone;

class DateManager {

    private DbManager $dbManager;

    private array $months = [
        1 => 'Январь',
        2 => 'Февраль',
        3 => 'Март',
        4 => 'Апрель',
        5 => 'Май',
        6 => 'Июнь',
        7 => 'Июль',
        8 => 'Август',
        9 => 'Сентябрь',
        10 => 'Октябрь',
        11 => 'Ноябрь',
        12 => 'Декабрь',
    ];

    private array $week = [
        0 => 'Воскресенье',
        1 => 'Понедельник',
        2 => 'Вторник',
        3 => 'Среда',
        4 => 'Четверг',
        5 => 'Пятница',
        6 => 'Суббота',
    ];

    private int $numberWeek;
    private int $numberYear;


    public function __construct($week, $year, DbManager $dbManager)
    {
        $this->dbManager = $dbManager;
        $this->numberWeek = $week ?? (int)$this->getDateTime()->format('W');
        $this->numberYear = $year ?? (int)$this->getDateTime()->format('Y');
    }

    /**
     * @param string|\DateTime $date
     * @return DateTime
     */
    public function getDateTime($date = ''): DateTime
    {
        if (\is_string($date)) {
            $date = new \DateTime($date);
        }

        return $date->setTimezone(new DateTimeZone('Europe/Moscow'));
    }

    /**
     * @param string $number
     * @return string
     */
    public function getMonth(string $number): string
    {
        return $this->months[$number];
    }

    /**
     * @param string $number
     * @return string
     */
    public function getWeek(string $number): string
    {
        return $this->week[$number];
    }

    /**
     * @param int $year
     * @param int $week
     * @return array
     */
    public function getStartEndNumberWeek(int $year, int $week): array
    {
        $startDate = $this->getDateTime()->setTime(0, 0, 0)->setISODate($year, $week, 1);
        $endDate = $this->getDateTime()->setTime(23, 59, 59)->setISODate($year, $week, 7);

        return [
            'startWeek' => [
                'year' => $startDate->format('Y'),
                'month' => $startDate->format('m'),
                'day' => $startDate->format('j'),
                'full' => $startDate->format('Y-m-j H:i:s'),
            ],
            'endWeek' => [
                'year' => $endDate->format('Y'),
                'month' => $endDate->format('m'),
                'day' => $endDate->format('j'),
                'full' => $endDate->format('Y-m-j H:i:s'),
            ],
        ];
    }

    /**
     * @return int
     */
    public function getNumberWeek(): int
    {
        return $this->numberWeek;
    }

    /**
     * @return int
     */
    public function getNumberYear(): int
    {
        return $this->numberYear;
    }

    /**
     * @return string
     */
    public function getCurrentDate(): string
    {
        return $this->numberWeek.'-'.$this->numberYear;
    }

    /**
     * @return string
     */
    public function getPrevDate(): string
    {
        if($this->numberWeek === 1) {
            return $this->getDateTime('December 28th'.($this->numberYear - 1))->format('W').'-'.($this->numberYear - 1);
        }

        return ($this->numberWeek - 1).'-'.$this->numberYear;
    }

    /**
     * @return string
     */
    public function getNextDate(): string
    {
        if ($this->numberWeek === (int)$this->getDateTime('December 28th'.$this->numberYear)->format('W')) {
            return '1-'.($this->numberYear + 1);
        }

        return ($this->numberWeek + 1).'-'.$this->numberYear;
    }

    /**
     * @return string
     */
    public function getGap(): string
    {
        $startEndGap = $this->getStartEndNumberWeek($this->getNumberYear(), $this->getNumberWeek());

        if($startEndGap['startWeek']['month'] === $startEndGap['endWeek']['month']) {
            $result = $this->getMonth((int)$startEndGap['startWeek']['month']).' '.$startEndGap['startWeek']['day'].' - '.$startEndGap['endWeek']['day'].', '.$startEndGap['endWeek']['year'];
        } elseif ($startEndGap['startWeek']['year'] < $startEndGap['endWeek']['year']) {
            $result = $this->getMonth((int)$startEndGap['startWeek']['month']).' '.$startEndGap['startWeek']['day'].', '.$startEndGap['startWeek']['year'].' - '.$this->getMonth((int)$startEndGap['endWeek']['month']).' '.$startEndGap['endWeek']['day'].', '.$startEndGap['endWeek']['year'];
        } else {
            $result = $this->getMonth((int)$startEndGap['startWeek']['month']).' '.$startEndGap['startWeek']['day'].' - '.$this->getMonth((int)$startEndGap['endWeek']['month']).' '.$startEndGap['endWeek']['day'].', '.$startEndGap['endWeek']['year'];
        }

        return $result;
    }

    /**
     * @param int $week
     */
    public function setNumberWeek(int $week): void
    {
        $this->numberWeek = $week;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->numberYear = $year;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $week = $this->getStartEndNumberWeek($this->getNumberYear(), $this->getNumberWeek());

        return $this->dbManager->getFilterIntervalDateEvents($week['startWeek']['full'], $week['endWeek']['full']);
    }
}
