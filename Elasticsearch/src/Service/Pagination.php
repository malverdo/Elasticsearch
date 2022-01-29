<?php

namespace App\Service;

class Pagination
{
    /**
     * @var int
     */
    private $startNumber = 1;

    /**
     * @var int
     */
    private $middleNumber = 2;

    /**
     * @var int
     */
    private $endNumber = 3;

    /**
     * @var int
     */
    private $endTotalNumber;

    /**
     * @var int
     */
    private $startTotalNumber = 1;


    public function pagination(int $numberPage, int $endTotalNumber)
    {
        if ($numberPage == $endTotalNumber) {
            $this->setStartNumber($numberPage - 2);
            $this->setMiddleNumber($numberPage - 1);
            $this->setEndNumber($numberPage);
            $this->setEndTotalNumber($endTotalNumber);
        } else if ($numberPage > 1) {
            $this->setStartNumber($numberPage - 1);
            $this->setMiddleNumber($numberPage);
            $this->setEndNumber($numberPage + 1);
            $this->setEndTotalNumber($endTotalNumber);
        } else {
            $this->setStartNumber($numberPage);
            $this->setMiddleNumber($numberPage + 1);
            $this->setEndNumber($numberPage + 2);
            $this->setEndTotalNumber($endTotalNumber);
        }
    }


    /**
     * @return int
     */
    public function getStartNumber(): int
    {
        return $this->startNumber;
    }

    /**
     * @param int $startNumber
     */
    public function setStartNumber(int $startNumber): void
    {
        $this->startNumber = $startNumber;
    }

    /**
     * @return int
     */
    public function getMiddleNumber(): int
    {
        return $this->middleNumber;
    }

    /**
     * @param int $middleNumber
     */
    public function setMiddleNumber(int $middleNumber): void
    {
        $this->middleNumber = $middleNumber;
    }

    /**
     * @return int
     */
    public function getEndNumber(): int
    {
        return $this->endNumber;
    }

    /**
     * @param int $endNumber
     */
    public function setEndNumber(int $endNumber): void
    {
        $this->endNumber = $endNumber;
    }

    /**
     * @return int
     */
    public function getEndTotalNumber(): int
    {
        return $this->endTotalNumber;
    }

    /**
     * @param int $endTotalNumber
     */
    public function setEndTotalNumber(int $endTotalNumber): void
    {
        $this->endTotalNumber = $endTotalNumber;
    }

    /**
     * @return int
     */
    public function getStartTotalNumber(): int
    {
        return $this->startTotalNumber;
    }

    /**
     * @param int $startTotalNumber
     */
    public function setStartTotalNumber(int $startTotalNumber): void
    {
        $this->startTotalNumber = $startTotalNumber;
    }





}