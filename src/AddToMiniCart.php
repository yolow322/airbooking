<?php
/**
 *
 * Used to adding orders to mini cart
 *
 */
require_once 'classes/DataBaseConfig.php';
require_once 'classes/Order.php';
require_once 'classes/CRUD.php';

$dbh = new DataBaseConfig();
$query = new CRUD();
session_start();
if (!empty($query->checkingOrderedTicketsForUser(intval($_POST['ticket_id']), intval($_SESSION['id'])))) {
    foreach ($query->getOrdersInMiniCart(intval($_POST['ticket_id']), intval($_SESSION['id']))->fetchAll(PDO::FETCH_ASSOC) as $tableRow) {
        if ($tableRow['is_ordered_for_this_user'] == '1' || $tableRow['free_places'] == '0') {
            echo 'Вы больше не можете добавить в корзину билет рейса ' . $tableRow['from_city'] . '-' . $tableRow['to_city'] . '!';
        }
    }
}
else {
    $order = new Order(intval($_POST['ticket_id']), intval($_SESSION['id']), boolval($_POST['is_ordered_for_this_user']), 0);
    $query->addOrderToCart($order->getTicketId(), $order->getUserId(), $order->getIsOrderedForThisUserStatus(), $order->getChosenPlace());
}
