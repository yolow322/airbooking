<?php
/**
 *
 * Used to for adding new ticket on admin page
 *
 */
require_once 'classes/DataBaseConfig.php';
require_once 'classes/Ticket.php';
require_once 'classes/CRUD.php';

$dbh = new DataBaseConfig();
$query = new CRUD();
if ($_POST['from_city'] != '' && $_POST['to_city'] != '' && $_POST['departure_date'] != '' && $_POST['departure_time'] != '' && $_POST['places'] != '' && $_POST['price'] != '') {
    if (is_numeric(strtotime($_POST['departure_date'])) && intval($_POST['places']) > 0 && intval($_POST['price']) > 0)  {
        $ticket = new Ticket($_POST['from_city'], $_POST['to_city'], date('Y-m-d', strtotime($_POST['departure_date'])), $_POST['departure_time'], $_POST['places'], $_POST['places'], $_POST['price']);
        $query->createNewTicket($ticket->getFromCity(), $ticket->getToCity(), $ticket->getDepartureDate(), $ticket->getDepartureTime(), $ticket->getTicketPlaces(), $ticket->getTicketFreePlaces(), $ticket->getTicketPrice());
        echo '<script type="text/javascript">alert("Новый рейс добавлен!")</script>';
    }
    else {
        echo '<script type="text/javascript">alert("Введите все данные в правильном формате!")</script>';
    }
}
else {
    echo '<script type="text/javascript">alert("Необходимо заполнить все поля!")</script>';
}