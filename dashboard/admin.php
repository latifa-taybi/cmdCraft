<?php
require_once '../config/config.php';
include './header.php';
include '../classes/userClass.php';
include '../classes/productClass.php';

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

$users = new User($pdo);
$client = $users->countClient();

$product = new product($pdo);
$produit = $product->countProduct();


?>
            
            <div class="page-content">
            
                <div class="analytics">

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $client ?></h2>
                            <span class="las la-user-friends"></span>
                        </div>
                        <div class="card-progress">
                            <small>Clients</small>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo $produit ?></h2>
                            <span class="las la-cogs"></span>
                        </div>
                        <div class="card-progress">
                            <small>Produits</small>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-head">
                            <h2><?php echo '0'?></h2>
                            <span class="las la-shopping-cart"></span>
                        </div>
                        <div class="card-progress">
                            <small>Commandes</small>
                        </div>
                    </div>
                </div>

                <!-- Chart for Orders per Month -->
                <div class="statistics">
                    <div class="chart-container">
                        <h3>Monthly Orders</h3>
                        <!-- Here you can integrate a chart library like Chart.js or Google Charts -->
                        <canvas id="ordersChart"></canvas>
                    </div>
                </div>
            
            </div>
            
        </main>
        
    </div>

    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Example of a simple chart for monthly orders
        const ctx = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Orders per Month',
                    data: [100, 150, 200, 250, 300, 350],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>

