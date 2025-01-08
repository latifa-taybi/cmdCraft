<?php
include '../classes/userClass.php';
require_once '../config/config.php';

if(isset($_GET['id'])){
    $db = new database;
    $pdo=$db->getConn();

    $user = new User($pdo);
    $userId = $user->getUserId($_GET['id']);
    $toggleAcc = $user->accountManager($_GET['id']);
    header('location: ./clientList.php');
}
?>