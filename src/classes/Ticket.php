<?php
/**
 *
 * For info about tickets
 *
 */

class Ticket
{
    private string $fromCity;
    private string $toCity;
    private string $departureDate;
    private string $departureTime;
    private int $ticketPlaces;
    private int $ticketFreePlaces;
    private int $ticketPrice;

    /**
     * @param string $fromCity
     */
    public function setFromCity(string $fromCity): void
    {
        $this->fromCity = $fromCity;
    }

    /**
     * @return string
     */
    public function getFromCity(): string
    {
        return $this->fromCity;
    }

    /**
     * @param string $toCity
     */
    public function setToCity(string $toCity): void
    {
        $this->toCity = $toCity;
    }

    /**
     * @return string
     */
    public function getToCity(): string
    {
        return $this->toCity;
    }

    /**
     * @param string $departureDate
     */
    public function setDepartureDate(string $departureDate): void
    {
        $this->departureDate = $departureDate;
    }

    /**
     * @return string
     */
    public function getDepartureDate(): string
    {
        return $this->departureDate;
    }

    /**
     * @param string $departureTime
     */
    public function setDepartureTime(string $departureTime): void
    {
        $this->departureTime = $departureTime;
    }

    /**
     * @return string
     */
    public function getDepartureTime(): string
    {
        return $this->departureTime;
    }

    /**
     * @param int $ticketPrice
     */
    public function setTicketPrice(int $ticketPrice): void
    {
        $this->ticketPrice = $ticketPrice;
    }

    /**
     * @return int
     */
    public function getTicketPrice(): int
    {
        return $this->ticketPrice;
    }

    /**
     * @param int $ticketPlaces
     */
    public function setTicketPlaces(int $ticketPlaces): void
    {
        $this->ticketPlaces = $ticketPlaces;
    }

    /**
     * @return int
     */
    public function getTicketPlaces(): int
    {
        return $this->ticketPlaces;
    }

    /**
     * @param int $ticketFreePlaces
     */
    public function setTicketFreePlaces(int $ticketFreePlaces): void
    {
        $this->ticketFreePlaces = $ticketFreePlaces;
    }

    /**
     * @return int
     */
    public function getTicketFreePlaces(): int
    {
        return $this->ticketFreePlaces;
    }

    public function __construct($fromCity, $toCity, $departureDate, $departureTime, $ticketPlaces, $ticketFreePlaces, $ticketPrice)
    {
        $this->setFromCity($fromCity);
        $this->setToCity($toCity);
        $this->setDepartureDate($departureDate);
        $this->setDepartureTime($departureTime);
        $this->setTicketPlaces($ticketPlaces);
        $this->setTicketFreePlaces($ticketFreePlaces);
        $this->setTicketPrice($ticketPrice);
    }
}