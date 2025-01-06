<?php
require_once '../config/config.php';
if($_GET['id']){
    require_once '../classes/productClass.php';
    $db = new Database();
    $pdo = $db->getConn();
    $product = new product($pdo);
    $product->delete($_GET['id']);
    header('Location: ../dashboard/productList.php');
}