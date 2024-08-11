<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Simple Banking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="card text-center">
        <h1 class="card-title">Welcome to Simple Banking System</h1>
        <p class="card-text">Please choose an option to proceed:</p>
        <div class="d-grid gap-2">
            <a href="register.php" class="btn btn-primary btn-lg">Register</a>
            <a href="login.php" class="btn btn-secondary btn-lg">Login</a>
            <a href="admin.php" class="btn btn-info btn-lg">Admin Dashboard</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
