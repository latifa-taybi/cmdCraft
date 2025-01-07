<?php
session_start();

require_once '../config/config.php'; 

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $db = new database();
    $pdo = $db->getConn();

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        if ($user['role'] == 'admin') {
            header("Location: ../dashboard/admin.php");
        } else {
            header("Location: ../glowing/index.php");
        }
    } else {
        header("Location: ../index.php?msg=1");
    }
}
?>