<?php
/**
 *
 * Showing pre-ordered tickets in mini cart
 *
 */
require_once 'classes/DataBaseConfig.php';
require_once 'classes/CRUD.php';

$dbh = new DataBaseConfig();
$query = new CRUD();
session_start();
if (!empty($query->getAllOrdersById($_SESSION['id'])->fetchColumn())) {
    foreach ($query->getAllOrdersById($_SESSION['id'])->fetchAll(PDO::FETCH_ASSOC) as $tableRow) {
        echo '<div class="mini-cart-obj">
                  <p class="ticket-name">' . 'Рейс №:' . $tableRow['ticket_id'] . ' <button class="delete-from-mini-cart" data-order-id="' . $tableRow['id'] . '">&times;</button></p>
              </div>';
    }
}
else {
    echo '<p class="paragraph-from-mini-cart">Корзина пуста!</p>';
}