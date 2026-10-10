
<?php
$search = trim($_GET["q"] ?? "");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form action="search.php" method="get">
    <h2>Search</h2>

    <label for="q">Search keyword</label>
    <input type="text" id="q" name="q"
           value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>">

    <button type="submit">Search</button>

    <?php if ($search !== ""): ?>
        <p>
            Search result for:
            <strong><?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?></strong>
        </p>
    <?php endif; ?>

    <a href="index.php">Registration Form</a>
</form>

</body>
</html>
