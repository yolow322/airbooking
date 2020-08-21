<?php
/**
 *
 * Showing user orders in modal window on home page
 *
 */
require_once 'classes/DataBaseConfig.php';
require_once 'classes/CRUD.php';

$dbh = new DataBaseConfig();
$query = new CRUD();
session_start();
if (!empty($query->getAllUserOrders($_SESSION['id'])->fetchColumn())) {
    foreach ($query->getAllUserOrders($_SESSION['id'])->fetchAll(PDO::FETCH_ASSOC) as $tableRow) {
        echo '<div class="my-orders">
                  <p>' . $tableRow['from_city'] . ' - ' . $tableRow['to_city'] . '</p>
                  <p>Дата отправления: ' . $tableRow['ticket_date'] . '</p>
                  <p>Время отправления: ' . $tableRow['ticket_time'] . '</p>
                  <p>Стоимость: ' . $tableRow['price'] . '</p>
                  <p>Место: ' . $tableRow['place'] . '</p>
                  <button class="delete-user-ordered-ticket" data-ticket-id="' . $tableRow['ticket_id'] . '" data-order-id="' . $tableRow['order_id'] . '">Удалить</button>
              </div>';
    }
}
else {
    echo '<p class="paragraph-from-orders">Вы ещё не заказывали билеты!</p>';
}