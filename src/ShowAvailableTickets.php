<?php
require_once 'classes/DataBaseConfig.php';
require_once 'classes/CRUD.php';

$dbh = new DataBaseConfig();
$query = new CRUD();
if (!empty($query->checkingExistingTickets())) {
    foreach ($query->getAllAvailableTickets()->fetchAll(PDO::FETCH_ASSOC) as $tableRow) {
        echo '<div class="cart">
                 <p class="ticket-id">' . 'Рейс №: ' . $tableRow['id'] . '</p>
                 <p class="from-to">' . $tableRow['from_city'] . ' - ' . $tableRow['to_city'] . '</p>
                 <p class="dataOfDeparture">' . 'Дата отправления: ' . $tableRow['departure_date'] . '</p>
                 <p class="timeOfDeparture">' . 'Время отправления: ' .$tableRow['departure_time']. '</p>
                 <p class="places">' . 'Кол-во свободных мест: ' . $tableRow['free_places'] . ' из ' . $tableRow['places'] . '</p>
                 <p class="price">' . 'Стоимость: ' . $tableRow['price'] . '</p>
                 <button class="add-to-cart" data-ticket-id = ' . $tableRow['id']. '>Добавить в корзину</button>
              </div>';
    }
}
else {
    echo '<div class="tickets-out">
              <p css="text-align: center; font-size: 18px;">В данный момент нет рейсов!</p>
          </div>';
}
