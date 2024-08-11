<?php
require '../vendor/autoload.php';
session_start();

use App\Storage;

// Display success message
$success_message = '';
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $storage = new Storage('../storage/users.json');
    $users = $storage->read();
    
    foreach ($users as $user) {
        if ($user['email'] == $_POST['email'] && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user'] = $user;
            header('Location: dashboard.php');
            exit;
        }
    }
    $error_message = "Invalid login credentials";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Login</h2>
    
    <!-- Success Message -->
    <?php if ($success_message): ?>
        <div class="alert alert-success text-center">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>
    
    <!-- Error Message -->
    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger text-center">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" class="mt-4">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
