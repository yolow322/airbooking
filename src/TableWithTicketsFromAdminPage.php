<?php
/**
 *
 * Auxiliary script for deleting tickets on admin page which generate table with info about ticket
 *
 */
require_once 'classes/DataBaseConfig.php';
require_once 'classes/CRUD.php';

$dbh = new DataBaseConfig();
$query = new CRUD();
if (!empty($query->checkingExistingTickets())) {
    foreach ($query->getAllAvailableTickets()->fetchAll(PDO::FETCH_ASSOC) as $tableRow) {
        echo '<table border="1" class="table">
            <tr>
                <th>Откуда</th>
                <td>' . $tableRow['from_city'] . '</td>
            </tr>
            <tr>
                <th>Куда</th>
                <td>' . $tableRow['to_city'] . '</td>
            </tr>
            <tr>
                <th>Дата отправления</th>
                <td>' . $tableRow['departure_date'] . '</td>
            </tr>
            <tr>
                <th>Стоимость</th>
                <td>' . $tableRow['price'] . '</td>
            </tr>    
            <tr>
                <th>Время отправления</th>
                <td>' . $tableRow['departure_time'] . '</td>
            <tr>
                <th>Кол-во мест</th>
                <td>'.$tableRow['places'].'</td>
            </tr>  
            <tr>
                <th>Кол-во свободных мест</th>
                <td>' . $tableRow['free_places'] . '</td>
            </tr>  
            <tr>   
                <th>Удалить</th>
                <td>
                    <button class="delete-ticket" data-delete-id="' . $tableRow['id'] . '">&times;</button>
                </td>
            </tr>
         </table>';
    }
}
else {
    echo '<p style="text-align:center; font-size: 18px;">В данный момент нет рейсов!</p>';
}