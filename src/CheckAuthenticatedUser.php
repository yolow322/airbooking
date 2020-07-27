<?php
require_once 'classes/DataBaseConfig.php';
require_once 'classes/CRUD.php';

$dbh = new DataBaseConfig();
$query = new CRUD();
session_start();
if ($_SESSION['id'] == '') {
    echo "<script>alert('Необходимо авторизироваться, чтобы пользоваться сайтом!'); location.href = 'starting.html'</script>";
}
else {
    session_start();
    foreach ($query->getUserById($_SESSION['id']) as $tableRow) {
        echo '<div class="login-name" data-person-id="' . $_SESSION['id'] . '">' . 'Доброго времени суток,' . ' ' . $tableRow['name'] . ' ' . $tableRow['surname'].'</div>';
    }
}

