<?php
require '../vendor/autoload.php';
session_start();

use App\Storage;

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    if (is_numeric($amount) && $amount > 0 && $amount <= $user['balance']) {
        $user['balance'] -= $amount;
        $storage = new Storage('../storage/users.json');
        $users = $storage->read();

        foreach ($users as &$storedUser) {
            if ($storedUser['email'] == $user['email']) {
                $storedUser['balance'] = $user['balance'];
                break;
            }
        }

        $storage->write($users);
        $_SESSION['user'] = $user;
        $_SESSION['success_message'] = "Withdrawal successful!";
        header('Location: dashboard.php');
        exit;
    } else {
        $error_message = "Invalid or insufficient amount";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Withdraw</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Withdraw Money</h2>
    
    <!-- Error Message -->
    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger text-center">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>
    
    <!-- Success Message -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success text-center">
            <?php echo $_SESSION['success_message']; ?>
            <?php unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" class="mt-4">
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" name="amount" id="amount" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Withdraw</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
