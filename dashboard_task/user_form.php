
<?php
session_start();
require "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$name = "";
$email = "";
$error = "";
$editing = false;

if ($id) {
    $stmt = $conn->prepare(
        "SELECT name, email FROM users WHERE id = ?"
    );
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if (!$user) {
        header("Location: users.php");
        exit;
    }

    $name = $user["name"];
    $email = $user["email"];
    $editing = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($name == "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Enter a valid name and email.";
    } elseif (!$editing && $password == "") {
        $error = "Password is required.";
    } else {
        $check = $conn->prepare(
            "SELECT id FROM users WHERE email = ? AND id != ?"
        );
        $excludeId = $editing ? $id : 0;
        $check->bind_param("si", $email, $excludeId);
        $check->execute();

        if ($check->get_result()->num_rows > 0) {
            $error = "Email already exists.";
        } else {
            if ($editing) {
                if ($password != "") {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare(
                        "UPDATE users SET name=?, email=?, password=? WHERE id=?"
                    );
                    $stmt->bind_param("sssi", $name, $email, $hash, $id);
                } else {
                    $stmt = $conn->prepare(
                        "UPDATE users SET name=?, email=? WHERE id=?"
                    );
                    $stmt->bind_param("ssi", $name, $email, $id);
                }
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare(
                    "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
                );
                $stmt->bind_param("sss", $name, $email, $hash);
            }

            $stmt->execute();
            header("Location: users.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $editing ? "Edit User" : "Add User"; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2><?php echo $editing ? "Edit User" : "Add User"; ?></h2>

    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name"
               value="<?php echo htmlspecialchars($name); ?>" required>

        <input type="email" name="email" placeholder="Email"
               value="<?php echo htmlspecialchars($email); ?>" required>

        <input type="password" name="password"
               placeholder="<?php echo $editing ? 'New Password (optional)' : 'Password'; ?>"
               <?php echo $editing ? '' : 'required'; ?>>

        <button type="submit">Save User</button>
    </form>

    <p><a href="users.php">Back to Users</a></p>
</div>

</body>
</html>
