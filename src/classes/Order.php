<?php
/**
 *
 * For info about orders
 *
 */

class Order
{
    private int $ticketId;
    private int $userId;
    private bool $isOrderedForThisUserStatus;
    private int $chosenPlace;

    /**
     * @param int $ticketId
     */
    public function setTicketId(int $ticketId): void
    {
        $this->ticketId = $ticketId;
    }

    /**
     * @return int
     */
    public function getTicketId(): int
    {
        return $this->ticketId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param bool $isOrderedForThisUserStatus
     */
    public function setIsOrderedForThisUserStatus(bool $isOrderedForThisUserStatus): void
    {
        $this->isOrderedForThisUserStatus = $isOrderedForThisUserStatus;
    }

    /**
     * @return bool
     */
    public function getIsOrderedForThisUserStatus(): bool
    {
        return $this->isOrderedForThisUserStatus;
    }

    /**
     * @param int $chosenPlace
     */
    public function setChosenPlace(int $chosenPlace): void
    {
        $this->chosenPlace = $chosenPlace;
    }

    /**
     * @return int
     */
    public function getChosenPlace(): int
    {
        return $this->chosenPlace;
    }

    public function __construct($ticketId, $userId, $isOrderedForThisUserStatus, $chosenPlace)
    {
        $this->setTicketId($ticketId);
        $this->setUserId($userId);
        $this->setIsOrderedForThisUserStatus($isOrderedForThisUserStatus);
        $this->setChosenPlace($chosenPlace);
    }
}