<?php
require_once 'classes/DataBaseConfig.php';
require_once 'classes/CRUD.php';

$dbh = new DataBaseConfig();
$query = new CRUD();
$query->deleteOrderById($_POST['id']);