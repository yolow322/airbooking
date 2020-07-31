<?php
/**
 *
 * Used to for showing orders in cart page
 *
 */
require_once 'classes/DataBaseConfig.php';
require_once 'classes/CRUD.php';

$dbh = new DataBaseConfig();
$query = new CRUD();
session_start();
if (empty($query->getAllOrdersInCart($_SESSION['id'])->fetchColumn())) {
    echo '<p class="paragraph-from-cart">Добавьте билеты в корзину и возвращейтесть обратно, чтобы забронировать их!</p>';
}
else {
    foreach ($query->getAllOrdersInCart($_SESSION['id'])->fetchAll(PDO::FETCH_ASSOC) as $tableRow) {
        echo '<div class="ticket-form" data-order-id="' . $tableRow['id'] . '" data-person-id="' . $_SESSION['id'] . '" data-ticket-id="' . $tableRow['ticket_id'] . '" data-place="' . $tableRow['place'] . '">
                <p class="cart-inp">Имя: <input readonly type="text" id="name" value="'.$tableRow['name'].'"></p>
                <p class="cart-inp">Фамилия: <input readonly type="text" id="surname" value="'.$tableRow['surname'].'"></p>
                <p class="cart-inp">Отчество: <input readonly type="text" id="last-name" value="'.$tableRow['last_name'].'"></p>
                <p class="cart-inp">Рейс: <input readonly type="text" id="route" value="'.$tableRow['fromcity'].' - '.$tableRow['tocity'].'"></p>
                <select class="places-list" data-ticket-id="'.$tableRow['ticket_id'].'">
                    <option class="place-item" hidden>Выбрать место</option>';
        for ($placesCount = 1; $placesCount < $tableRow['places'] + 1; $placesCount++) {
            echo '<option class="place-item" value="'.$placesCount.'">'.$placesCount.'</option>';
        }
        echo '</select>
              </div>';
    }
}