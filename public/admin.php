<?php
require '../vendor/autoload.php';
session_start();

use App\Storage;
use App\Admin;

if (!isset($_SESSION['user']) || $_SESSION['user']['email'] != 'admin@example.com') {
    header('Location: login.php');
    exit;
}

$storage = new Storage('../storage/users.json');
$admin = new Admin('Admin', 'admin@example.com', '');

$customers = $admin->viewAllCustomers($storage);

if (isset($_POST['email'])) {
    $transactions = $admin->viewCustomerTransactions($storage, $_POST['email']);
} else {
    $transactions = [];
}

?>

<h2>Admin Dashboard</h2>
<h3>All Customers</h3>
<ul>
    <?php foreach ($customers as $customer): ?>
        <li><?php echo $customer['name']; ?> (<?php echo $customer['email']; ?>)</li>
    <?php endforeach; ?>
</ul>

<h3>View Transactions by Customer</h3>
<form method="POST">
    <input type="email" name="email" placeholder="Customer's Email" required>
    <button type="submit">View Transactions</button>
</form>

<?php if (!empty($transactions)): ?>
    <h3>Transactions</h3>
    <ul>
        <?php foreach ($transactions as $transaction): ?>
            <li><?php echo $transaction['type']; ?>: <?php echo $transaction['amount']; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<a href="logout.php">Logout</a>
