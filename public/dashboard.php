<?php
require '../vendor/autoload.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Welcome, <?php echo $user['name']; ?></h2>
    <p class="text-center">Your Balance: $<?php echo $user['balance']; ?></p>
    <div class="d-flex justify-content-center">
        <a href="deposit.php" class="btn btn-success m-2">Deposit</a>
        <a href="withdraw.php" class="btn btn-warning m-2">Withdraw</a>
        <a href="transfer.php" class="btn btn-info m-2">Transfer</a>
        <a href="logout.php" class="btn btn-danger m-2">Logout</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
