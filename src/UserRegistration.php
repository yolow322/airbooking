<?php
require_once 'classes/DataBaseConfig.php';
require_once 'classes/User.php';
require_once 'classes/CRUD.php';

$dbh = new DataBaseConfig();
$query = new CRUD();
if (!empty($query->checkingUserByLogin($_POST['login']))) {
    echo 'Аккаунт с таким логином уже существует!';
}
else {
    if ($_POST['name'] != '' && $_POST['surname'] != '' && $_POST['last_name'] != '' && $_POST['login'] != '' && $_POST['password'] != '') {
        $user = new User($_POST['name'], $_POST['surname'], $_POST['last_name'], $_POST['login'], password_hash($_POST['password'], PASSWORD_DEFAULT), 'guest');
        $query->createNewUser($user->getUserName(), $user->getUserSurname(), $user->getUserLastName(), $user->getUserLogin(), $user->getUserPasswordHash(), $user->getUserRole());
        echo 'Регистрация прошла успешно!';
    }
    else {
        echo 'Вы не заполнили все поля для регистрации!';
    }
}




