<?php
/**
 *
 * for CRUD operations
 *
 */

class CRUD extends DataBaseConfig
{
    public function getAllUsersByLogin($userLogin): PDOStatement
    {
        $stm = $this->getDb()->prepare("SELECT * FROM USERS WHERE LOGIN = ?");
        $stm->execute(array($userLogin));
        return $stm;
    }

    public function createNewUser($userName, $userSurname, $userLastName, $userLogin, $userPasswordHash, $userRole): PDOStatement
    {
        $stm = $this->getDb()->prepare("INSERT INTO USERS (NAME, SURNAME, LAST_NAME, LOGIN, PASSWORD_HASH, ROLE) VALUES (?, ?, ?, ?, ?, ?)");
        $stm->execute(array($userName, $userSurname, $userLastName, $userLogin, $userPasswordHash, $userRole));
        return $stm;
    }

    public function checkingUserByLogin($userLogin): int
    {
        $stm = $this->getDb()->prepare("SELECT COUNT(*) FROM USERS WHERE LOGIN = ?");
        $stm->execute(array($userLogin));
        return $stm->fetchColumn();
    }

    public function getAllAvailableTickets(): PDOStatement
    {
        return $this->getDb()->query("SELECT * FROM TICKETS");
    }

    public function checkingExistingTickets(): int
    {
        $stm = $this->getDb()->query("SELECT COUNT(*) FROM TICKETS");
        return $stm->fetchColumn();
    }

    public function checkingUserPassword($userPassword): int
    {
        $stm = $this->getDb()->prepare("SELECT COUNT(*) FROM USERS WHERE PASSWORD_HASH = ?");
        $stm->execute(array($userPassword));
        return $stm->fetchColumn();
    }

    public function createNewTicket($fromCity, $toCity, $departureDate, $departureTime, $ticketPlaces, $ticketFreePlaces, $ticketPrice): PDOStatement
    {
        $stm = $this->getDb()->prepare("INSERT INTO TICKETS (FROM_CITY, TO_CITY, DEPARTURE_DATE, DEPARTURE_TIME, PLACES, FREE_PLACES, PRICE) VALUES (?, ?, TO_DATE(?, 'YYYY/MM/DD'), ?, ?, ?, ?)");
        $stm->execute(array($fromCity, $toCity, $departureDate, $departureTime, $ticketPlaces, $ticketFreePlaces, $ticketPrice));
        return $stm;
    }

    public function deleteTicketById($ticketId): PDOStatement
    {
        $stm = $this->getDb()->prepare("DELETE FROM TICKETS WHERE ID = ?");
        $stm->execute(array($ticketId));
        return $stm;
    }

    public function getAllOrdersById($userId): PDOStatement
    {
        $stm = $this->getDb()->prepare("SELECT * FROM ORDERS WHERE USER_ID = ? AND PLACE = 0");
        $stm->execute(array($userId));
        return $stm;
    }

    public function getOrdersInMiniCart($ticketId, $userId): PDOStatement
    {
        $stm = $this->getDb()->prepare("SELECT ORDERS.*, TICKETS.FROM_CITY, TICKETS.TO_CITY, TICKETS.FREE_PLACES FROM ORDERS INNER JOIN TICKETS ON TICKETS.ID = ORDERS.TICKET_ID WHERE ORDERS.TICKET_ID = ? AND ORDERS.USER_ID = ?");
        $stm->execute(array($ticketId, $userId));
        return $stm;
    }

    public function checkingOrderedTicketsForUser($ticketId, $userId): int
    {
        $stm = $this->getDb()->prepare("SELECT COUNT(*) FROM ORDERS, TICKETS WHERE ORDERS.TICKET_ID = ? AND ORDERS.USER_ID = ? AND TICKETS.ID = ORDERS.TICKET_ID");
        $stm->execute(array($ticketId, $userId));
        return $stm->fetchColumn();
    }

    public function addOrderToCart($ticketId, $userId, $orderStatus, $chosenPlace): PDOStatement
    {
        $stm = $this->getDb()->prepare("INSERT INTO ORDERS (TICKET_ID, USER_ID, IS_ORDERED_FOR_THIS_USER, PLACE) VALUES (?, ?, ?, ?)");
        $stm->execute(array($ticketId, $userId, $orderStatus, $chosenPlace));
        return $stm;
    }

    public function getUserById($userId): PDOStatement
    {
        $stm = $this->getDb()->prepare("SELECT * FROM USERS WHERE ID = ?");
        $stm->execute(array($userId));
        return $stm;
    }

    public function deleteOrderById($orderId): PDOStatement
    {
        $stm = $this->getDb()->prepare("DELETE FROM ORDERS WHERE ID = ?");
        $stm->execute(array($orderId));
        return $stm;
    }

    public function getAllOrdersInCart($userId): PDOStatement
    {
        $stm = $this->getDb()->prepare("SELECT USERS.NAME, USERS.SURNAME, USERS.LAST_NAME, ORDERS.*, TICKETS.FROM_CITY AS fromCity, TICKETS.TO_CITY AS toCity, TICKETS.PLACES AS places FROM ORDERS INNER JOIN TICKETS ON TICKETS.ID = ORDERS.TICKET_ID INNER JOIN USERS ON USERS.ID = ORDERS.USER_ID WHERE USER_ID = ? AND PLACE = 0");
        $stm->execute(array($userId));
        return $stm;
    }

    public function sendOrderFromCart($chosenPlace, $orderId): PDOStatement
    {
        $stm = $this->getDb()->prepare("UPDATE ORDERS SET PLACE = ? WHERE ID = ?");
        $stm->execute(array($chosenPlace, $orderId));
        return $stm;
    }

    public function decrementFreePlacesAfterSendingOrder($ticketId): PDOStatement
    {
        $stm = $this->getDb()->prepare("UPDATE TICKETS SET FREE_PLACES = FREE_PLACES - 1 WHERE ID = ?");
        $stm->execute(array($ticketId));
        return $stm;
    }

    public function getOrdersByTicketId($ticketId): PDOStatement
    {
        $stm = $this->getDb()->prepare("SELECT * FROM ORDERS WHERE ORDERS.TICKET_ID = ?");
        $stm->execute(array($ticketId));
        return $stm;
    }

    public function getAllUserOrders($userId): PDOStatement
    {
        $stm = $this->getDb()->prepare("SELECT TICKETS.ID AS TICKET_ID, ORDERS.ID AS ORDER_ID, ORDERS.PLACE AS PLACE, TICKETS.FROM_CITY AS fromCity, TICKETS.TO_CITY AS toCity, TICKETS.DEPARTURE_DATE AS tickDate, TICKETS.DEPARTURE_TIME AS tickTime, TICKETS.PRICE AS PRICE FROM ORDERS INNER JOIN TICKETS ON TICKETS.ID = ORDERS.TICKET_ID WHERE ORDERS.USER_ID = ? AND ORDERS.PLACE <> 0");
        $stm->execute(array($userId));
        return $stm;
    }

    public function deleteUserOrder($ticketId): PDOStatement
    {
        $stm = $this->getDb()->prepare("UPDATE TICKETS SET FREE_PLACES = FREE_PLACES + 1 WHERE ID = ?");
        $stm->execute(array($ticketId));
        return $stm;
    }
}
