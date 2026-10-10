
<?php
session_start();

$registration = $_SESSION["registration"] ?? null;

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="result">
    <h2>Registered Information</h2>

    <?php if ($registration !== null): ?>

        <p><strong>Name:</strong> <?= e($registration["name"]) ?></p>
        <p><strong>Email:</strong> <?= e($registration["email"]) ?></p>
        <p><strong>Mobile:</strong> <?= e($registration["mobile"]) ?></p>
        <p><strong>Governorate:</strong> <?= e($registration["governorate"]) ?></p>
        <p><strong>Track:</strong> <?= e($registration["track"]) ?></p>
        <p><strong>Skills:</strong> <?= e(implode(", ", $registration["skills"])) ?></p>
        <p><strong>Message:</strong> <?= e($registration["message"]) ?></p>

    <?php else: ?>

        <p>No registration data found. Please register first.</p>

    <?php endif; ?>

    <a href="index.php">Back to Registration</a>
</div>

</body>
</html>
