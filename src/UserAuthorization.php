<?php
require_once 'classes/DataBaseConfig.php';
require_once 'classes/CRUD.php';

$dbh = new DataBaseConfig();
$query = new CRUD();
if ($_POST['login'] == '' || $_POST['password'] == '') {
    echo 'Вы не ввели все поля для авторизации!';
}
elseif (empty($query->checkingUserByLogin($_POST['login']))) {
    echo 'Пользователя с таким логином не существует!';
}
else {
    foreach ($query->getAllUsersByLogin($_POST['login'])->fetchAll(PDO::FETCH_ASSOC) as $tableRow) {
       if ($_POST['login'] == 'admin' && password_verify($_POST['password'], $tableRow['password_hash'])) {
           session_start();
           echo 'admin';
       }
       else {
           if (password_verify($_POST['password'], $tableRow['password_hash'])) {
               session_start();
               $_SESSION['id'] = $tableRow['id'];
               $_SESSION['password'] = $tableRow['password_hash'];
               $_SESSION['login'] = $_POST['login'];
               echo 'success';
           }
           else {
               echo 'Неверный пароль!';
           }
       }
    }
}


