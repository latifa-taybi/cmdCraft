<?php
require_once '../config/config.php';

if(isset($_POST['registre'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $db = new Database();
    $pdo = $db->getConn();

    $password_hashe = password_hash($password , PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users(name, email, mot_de_passe) VALUES(:name, :email, :mot_de_passe)");
    if($stmt->execute([
        ':name'=>$name,
        ':email'=>$email,
        ':mot_de_passe'=>$password_hashe
    ])){
        header('location:../index.php');
    }else{
        header('location:../index.php');
    }
}
?>

