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
    $recipientEmail = $_POST['recipient_email'];
    $amount = $_POST['amount'];

    if (is_numeric($amount) && $amount > 0 && $amount <= $user['balance']) {
        $storage = new Storage('../storage/users.json');
        $users = $storage->read();
        $recipientFound = false;

        foreach ($users as &$storedUser) {
            if ($storedUser['email'] == $recipientEmail) {
                $storedUser['balance'] += $amount;
                $recipientFound = true;
                break;
            }
        }

        if ($recipientFound) {
            $user['balance'] -= $amount;
            $storage->write($users);
            $_SESSION['user'] = $user;
            $_SESSION['success_message'] = "Transfer successful!";
            header('Location: dashboard.php');
            exit;
        } else {
            $error_message = "Recipient not found";
        }
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
    <title>Transfer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Transfer Money</h2>
    
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
            <label for="recipient_email" class="form-label">Recipient Email</label>
            <input type="email" class="form-control" name="recipient_email" id="recipient_email" required>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" name="amount" id="amount" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Transfer</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
