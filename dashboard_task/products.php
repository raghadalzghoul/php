
<?php
session_start();
require "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$products = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="dashboard">
    <h1>Product Management</h1>

    <nav>
        <a href="index.php">Dashboard</a>
        <a href="users.php">Users</a>
        <a href="products.php">Products</a>
        <a href="logout.php">Logout</a>
    </nav>

    <h2>All Products</h2>

    <a class="add-btn" href="product_form.php">Add Product</a>

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
            <td><?php echo htmlspecialchars($product["name"]); ?></td>
            <td><?php echo htmlspecialchars($product["description"]); ?></td>
            <td><?php echo number_format($product["price"], 2); ?></td>
            <td><?php echo $product["quantity"]; ?></td>
            <td><?php echo $product["created_at"]; ?></td>
            <td>
                <a href="product_form.php?id=<?php echo $product["id"]; ?>">
                    Edit
                </a>

                <form method="POST" action="product_delete.php"
                      style="display:inline;"
                      onsubmit="return confirm('Delete this product?');">

                    <input type="hidden" name="id"
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

</body>
</html>
