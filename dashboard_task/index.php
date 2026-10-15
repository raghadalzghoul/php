
<?php
session_start();
require "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Total users
$userCount = $conn->query(
    "SELECT COUNT(*) AS total FROM users"
)->fetch_assoc()["total"];

// Total products
$productCount = $conn->query(
    "SELECT COUNT(*) AS total FROM products"
)->fetch_assoc()["total"];

// Get all users
$users = $conn->query(
    "SELECT id, name, email FROM users"
);

// Get all products
$products = $conn->query(
    "SELECT * FROM products ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="dashboard">

    <h1>Admin Dashboard</h1>

    <nav>
        <a href="index.php">Dashboard</a>
        <a href="users.php">Users</a>
        <a href="products.php">Products</a>
        <a href="logout.php">Logout</a>
    </nav>

    <!-- Dashboard Statistics -->
    <div class="stats">

        <div class="stat-card">
            <h2>Total Users</h2>
            <h1><?php echo $userCount; ?></h1>
        </div>

        <div class="stat-card">
            <h2>Total Products</h2>
            <h1><?php echo $productCount; ?></h1>
        </div>

    </div>

    <!-- Users Table -->
    <h2>Users</h2>

    <a class="add-btn" href="user_form.php">
        Add User
    </a>

    <div class="table-wrapper">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>

            <?php while ($user = $users->fetch_assoc()): ?>
            <tr>
                <td><?php echo $user["id"]; ?></td>

                <td>
                    <?php echo htmlspecialchars($user["name"]); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($user["email"]); ?>
                </td>

                <td>
                    <a href="user_form.php?id=<?php echo $user["id"]; ?>">
                        Edit
                    </a>

                    <form method="POST"
                          action="user_delete.php"
                          style="display:inline;"
                          onsubmit="return confirm('Delete this user?');">

                        <input type="hidden"
                               name="id"
                               value="<?php echo $user["id"]; ?>">

                        <button type="submit" class="delete-btn">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <!-- Products Table -->
    <h2>Products</h2>

    <a class="add-btn" href="product_form.php">
        Add Product
    </a>

    <div class="table-wrapper">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Created Date</th>
                <th>Actions</th>
            </tr>

            <?php while ($product = $products->fetch_assoc()): ?>
            <tr>
                <td><?php echo $product["id"]; ?></td>

                <td>
                    <?php echo htmlspecialchars($product["name"]); ?>
                </td>

                <td>
                    <?php echo htmlspecialchars($product["description"]); ?>
                </td>

                <td>
                    <?php echo number_format($product["price"], 2); ?>
                </td>

                <td><?php echo $product["quantity"]; ?></td>

                <td>
                    <?php echo htmlspecialchars($product["created_at"]); ?>
                </td>

                <td>
                    <a href="product_form.php?id=<?php echo $product["id"]; ?>">
                        Edit
                    </a>

                    <form method="POST"
                          action="product_delete.php"
                          style="display:inline;"
                          onsubmit="return confirm('Delete this product?');">

                        <input type="hidden"
                               name="id"
                               value="<?php echo $product["id"]; ?>">

                        <button type="submit" class="delete-btn">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

</div>

</body>
</html>
