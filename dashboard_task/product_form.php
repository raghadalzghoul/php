
<?php
session_start();
require "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$editing = false;
$error = "";

$name = "";
$description = "";
$price = "";
$quantity = "";

if ($id) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $product = $stmt->get_result()->fetch_assoc();

    if (!$product) {
        header("Location: products.php");
        exit;
    }

    $name = $product["name"];
    $description = $product["description"];
    $price = $product["price"];
    $quantity = $product["quantity"];
    $editing = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $price = trim($_POST["price"] ?? "");
    $quantity = trim($_POST["quantity"] ?? "");

    if ($name == "" || $description == "" || $price === "" || $quantity === "") {
        $error = "All fields are required.";
    } elseif (!is_numeric($price) || $price < 0) {
        $error = "Enter a valid price.";
    } elseif (filter_var($quantity, FILTER_VALIDATE_INT) === false || $quantity < 0) {
        $error = "Enter a valid quantity.";
    } else {
        $price = (float) $price;
        $quantity = (int) $quantity;

        if ($editing) {
            $stmt = $conn->prepare(
                "UPDATE products
                 SET name=?, description=?, price=?, quantity=?
                 WHERE id=?"
            );

            $stmt->bind_param(
                "ssdii",
                $name,
                $description,
                $price,
                $quantity,
                $id
            );
        } else {
            $stmt = $conn->prepare(
                "INSERT INTO products (name, description, price, quantity)
                 VALUES (?, ?, ?, ?)"
            );

            $stmt->bind_param(
                "ssdi",
                $name,
                $description,
                $price,
                $quantity
            );
        }

        $stmt->execute();

        header("Location: products.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $editing ? "Edit Product" : "Add Product"; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2><?php echo $editing ? "Edit Product" : "Add Product"; ?></h2>

    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>

    <form method="POST">

        <input type="text" name="name"
               placeholder="Product Name"
               value="<?php echo htmlspecialchars($name); ?>" required>

        <textarea name="description"
                  placeholder="Description"
                  required><?php echo htmlspecialchars($description); ?></textarea>

        <input type="number" name="price" step="0.01" min="0"
               placeholder="Price"
               value="<?php echo htmlspecialchars((string)$price); ?>" required>

        <input type="number" name="quantity" min="0"
               placeholder="Quantity"
               value="<?php echo htmlspecialchars((string)$quantity); ?>" required>

        <button type="submit">Save Product</button>

    </form>

    <p><a href="products.php">Back to Products</a></p>
</div>

</body>
</html>
