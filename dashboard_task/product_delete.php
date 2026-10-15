
<?php
session_start();
require "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

    if ($id) {
        $stmt = $conn->prepare(
            "DELETE FROM products WHERE id = ?"
        );

        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

header("Location: products.php");
exit;
?>
