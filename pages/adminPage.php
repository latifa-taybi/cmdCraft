<?php
echo "admin";

require_once '../config/config.php';

session_start();
// session_unset();
// session_destroy();
if (!isset($_SESSION["user_email"])) {
    header("location:../index.php");
}

$email = $_SESSION["user_email"];
$db = new database();
$pdo = $db->getConn();
$sql = "SELECT * from users where email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => $email]);
$user = $stmt->fetch();

if (!$user || $user['role'] != 'admin') {
    header("location:../index.php");
}
