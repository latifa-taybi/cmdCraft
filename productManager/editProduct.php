<?php
require_once '../config/config.php';
require_once '../classes/productClass.php';

$db = new Database();
$pdo = $db->getConn();
$product = new product($pdo);



if ($product->editProduct($id, $name, $description, $prix, $quantite, $image)) {
    header("Location: ../productManager/products.php?success=Product updated successfully");
} else {
    header("Location: ../productManager/products.php?error=Failed to update product");
}
