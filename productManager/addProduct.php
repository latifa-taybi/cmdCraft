<?php
require_once '../config/config.php';

if(isset($_POST['addProduct'])){
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice =$_POST['productPrice'];
    $productQuantity = $_POST['productQuantity'];
    $productImage = $_POST['productImage'];

    $db = new Database;
    $pdo= $db->getConn();

    $stmt= $pdo->prepare("INSERT INTO product(name, description, prix, quantite, image)VALUES(:name, :description, :prix, :quantite, :image)");
    $stmt->execute([
        ':name'=>$productName,
        ':description'=>$productDescription,
        ':prix'=>$productPrice,
        ':quantite'=>$productQuantity,
        ':image'=>$productImage
    ]);
    header('location:../dashboard/productList.php');
}
?>