
<?php
session_start();
require "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$users = $conn->query("SELECT id, name, email FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="dashboard">
    <h1>User Management</h1>

    <nav>
        <a href="index.php">Dashboard</a>
        <a href="users.php">Users</a>
        <a href="products.php">Products</a>
        <a href="logout.php">Logout</a>
    </nav>

    <h2>All Users</h2>

    <a class="add-btn" href="user_form.php">Add User</a>

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
            <td><?php echo htmlspecialchars($user["name"]); ?></td>
            <td><?php echo htmlspecialchars($user["email"]); ?></td>
            <td>
                <a href="user_form.php?id=<?php echo $user["id"]; ?>">Edit</a>

                <form method="POST" action="user_delete.php"
                      style="display:inline;"
                      onsubmit="return confirm('Delete this user?');">
                    <input type="hidden" name="id"
                           value="<?php echo $user["id"]; ?>">
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
