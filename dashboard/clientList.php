<?php
include './header.php';
require_once '../config/config.php';
include '../classes/userClass.php';

session_start();


$db = new Database();
$pdo = $db->getConn();

$user = new User($pdo);

if (!isset($_SESSION["user_email"])) {
    header("location:../index.php");
}

$email = $_SESSION["user_email"];

$sql = "SELECT * from users where email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => $email]);
$users = $stmt->fetch();

if (!$users || $users['role'] != 'admin') {
    header("location:../index.php");
}

?>

<style>
    .toggle-btn {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .toggle-btn:hover {
        background-color: #0056b3;
    }
</style>
<div class="records table-responsive">

    <div class="record-header">
        <div class="add">
            <span>Clients</span>
        </div>

        <div class="browse">
            <input type="search" placeholder="Search" class="record-search">
            <select name="" id="">
                <option value="">Status</option>
                <option value="">Acivé</option>
                <option value="">Desactivé</option>
            </select>
        </div>
    </div>

    <div>
        <table width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th><span class="las la-sort"></span> CLIENT</th>
                    <th><span class="las la-sort"></span> EMAIL</th>
                    <th><span class="las la-sort"></span> ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $user->displayUsers();
                ?>
            </tbody>
        </table>
    </div>
</div>