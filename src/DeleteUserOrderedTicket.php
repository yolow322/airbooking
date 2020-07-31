<?php
/**
 *
 * Used to for deleting user order from modal window on home page
 *
 */
require_once 'classes/DataBaseConfig.php';
require_once 'classes/CRUD.php';

$dbh = new DataBaseConfig();
$query = new CRUD();
$query->deleteOrderById($_POST['order_id']);
$query->deleteUserOrder($_POST['ticket_id']);