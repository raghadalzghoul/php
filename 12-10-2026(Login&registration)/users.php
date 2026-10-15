
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

include "db.php";

$result = $conn->query("SELECT id, name, email FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Registered Users</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>

        <?php while ($user = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $user["id"]; ?></td>
                <td><?php echo htmlspecialchars($user["name"]); ?></td>
                <td><?php echo htmlspecialchars($user["email"]); ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
