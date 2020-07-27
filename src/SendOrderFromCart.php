<?php
require_once 'classes/DataBaseConfig.php';
require_once 'classes/CRUD.php';

$dbh = new DataBaseConfig();
$query = new CRUD();
$query->sendOrderFromCart($_POST['place'], $_POST['order_id']);
$query->decrementFreePlacesAfterSendingOrder($_POST['ticket_id']);