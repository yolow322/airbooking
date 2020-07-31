<?php
/**
 *
 * Delete chosen ticket from admin page
 *
 */
require_once 'classes/DataBaseConfig.php';
require_once 'classes/CRUD.php';

$dbh = new DataBaseConfig();
$query = new CRUD();
$query->deleteTicketById($_POST['id']);
