<?php
require_once 'classes/DataBaseConfig.php';
require_once 'classes/CRUD.php';

$dbh = new DataBaseConfig();
$query = new CRUD();
foreach ($query->getOrdersByTicketId($_POST['ticket_id'])->fetchAll() as $tableRow) {
    $output[] = array(
        'place' => $tableRow['place']
    );
}
echo json_encode($output);