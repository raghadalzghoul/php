
<?php
session_start();

// Default values
$name = "";
$email = "";
$mobile = "";
$governorate = "";
$track = "";
$skills = [];
$message = "";

$errors = [];
$success = false;
$registration = null;

// Get saved name from cookie
if (isset($_COOKIE["saved_name"])) {
    $name = $_COOKIE["saved_name"];
}

// Registration class
class Registration {
    public $name;
    public $email;
    public $mobile;
    public $governorate;
    public $track;
    public $skills;
    public $message;

    public function __construct($data) {
        $this->name = $data["name"];
        $this->email = $data["email"];
        $this->mobile = $data["mobile"];
        $this->governorate = $data["governorate"];
        $this->track = $data["track"];
        $this->skills = $data["skills"];
        $this->message = $data["message"];
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect and clean data
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $mobile = trim($_POST["mobile"] ?? "");
    $governorate = trim($_POST["governorate"] ?? "");
    $track = trim($_POST["track"] ?? "");
    $skills = $_POST["skills"] ?? [];
    $message = trim($_POST["message"] ?? "");

    // Validate name
    if ($name === "") {
        $errors["name"] = "Full name is required.";
    }

    // Validate email
    if ($email === "") {
        $errors["email"] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Enter a valid email address.";
    }

    // Validate Jordanian mobile number
    if ($mobile === "") {
        $errors["mobile"] = "Mobile number is required.";
    } elseif (!preg_match("/^(07[789]\d{7}|\+9627[789]\d{7})$/", $mobile)) {
        $errors["mobile"] = "Enter a valid Jordanian mobile number.";
    }

    // Validate governorate
    $validGovernorates = ["Amman", "Irbid", "Aqaba", "Zarqa"];

    if (!in_array($governorate, $validGovernorates, true)) {
        $errors["governorate"] = "Please select a governorate.";
    }

    // Validate track
    $validTracks = ["Full Stack", "Frontend", "Backend"];

    if (!in_array($track, $validTracks, true)) {
        $errors["track"] = "Please select a track.";
    }

    // Validate skills
    $validSkills = ["HTML", "CSS", "JavaScript"];

    if (!is_array($skills)) {
        $skills = [];
    }

    $skills = array_values(array_intersect($skills, $validSkills));

    if (count($skills) === 0) {
        $errors["skills"] = "Select at least one skill.";
    }

    // Validate terms
    if (!isset($_POST["agree"])) {
        $errors["agree"] = "You must accept the terms.";
    }

    // If there are no errors
    if (empty($errors)) {

        // Create an object
        $registration = new Registration([
            "name" => $name,
            "email" => $email,
            "mobile" => $mobile,
            "governorate" => $governorate,
            "track" => $track,
            "skills" => $skills,
            "message" => $message
        ]);

        // Save registration in session
        $_SESSION["registration"] = [
            "name" => $registration->name,
            "email" => $registration->email,
            "mobile" => $registration->mobile,
            "governorate" => $registration->governorate,
            "track" => $registration->track,
            "skills" => $registration->skills,
            "message" => $registration->message
        ];

        // Save name in a cookie for 30 days
        setcookie("saved_name", $name, time() + (30 * 24 * 60 * 60), "/");

        $success = true;
    }
}

// Helper to safely display values
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php if ($success): ?>

    <div class="result">
        <h2>Registration Successful!</h2>

        <p><strong>Name:</strong> <?= e($registration->name) ?></p>
        <p><strong>Email:</strong> <?= e($registration->email) ?></p>
        <p><strong>Mobile:</strong> <?= e($registration->mobile) ?></p>
        <p><strong>Governorate:</strong> <?= e($registration->governorate) ?></p>
        <p><strong>Track:</strong> <?= e($registration->track) ?></p>
        <p><strong>Skills:</strong> <?= e(implode(", ", $registration->skills)) ?></p>
        <p><strong>Message:</strong> <?= e($registration->message) ?></p>

        <p>Your information has been saved in the session.</p>

        <a href="profile.php">View Session Profile</a>
        |
        <a href="search.php">Go to Search</a>
    </div>

<?php else: ?>

    <form action="" method="post">
        <h2>Registration Form</h2>

        <label for="name">Full Name</label>
        <input type="text" id="name" name="name"
               value="<?= e($name) ?>">
        <span class="error"><?= e($errors["name"] ?? "") ?></span>

        <label for="email">Email</label>
        <input type="email" id="email" name="email"
               value="<?= e($email) ?>">
        <span class="error"><?= e($errors["email"] ?? "") ?></span>

        <label for="mobile">Mobile</label>
        <input type="tel" id="mobile" name="mobile"
               placeholder="0791234567" value="<?= e($mobile) ?>">
        <span class="error"><?= e($errors["mobile"] ?? "") ?></span>

        <label for="governorate">Governorate</label>
        <select id="governorate" name="governorate">
            <option value="">Choose a governorate</option>

            <?php foreach (["Amman", "Irbid", "Aqaba", "Zarqa"] as $city): ?>
                <option value="<?= e($city) ?>"
                    <?= $governorate === $city ? "selected" : "" ?>>
                    <?= e($city) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <span class="error"><?= e($errors["governorate"] ?? "") ?></span>

        <label>Track</label>

        <?php foreach (["Full Stack", "Frontend", "Backend"] as $option): ?>
            <label class="inline">
                <input type="radio" name="track"
                       value="<?= e($option) ?>"
                       <?= $track === $option ? "checked" : "" ?>>
                <?= e($option) ?>
            </label>
        <?php endforeach; ?>

        <span class="error"><?= e($errors["track"] ?? "") ?></span>

        <label>Skills you already have</label>

        <?php foreach (["HTML", "CSS", "JavaScript"] as $skill): ?>
            <label class="inline">
                <input type="checkbox" name="skills[]"
                       value="<?= e($skill) ?>"
                       <?= in_array($skill, $skills, true) ? "checked" : "" ?>>
                <?= e($skill) ?>
            </label>
        <?php endforeach; ?>

        <span class="error"><?= e($errors["skills"] ?? "") ?></span>

        <label for="message">Why do you want to join? (optional)</label>
        <textarea id="message" name="message" rows="4"><?= e($message) ?></textarea>

        <label class="inline terms">
            <input type="checkbox" name="agree"
                   <?= isset($_POST["agree"]) ? "checked" : "" ?>>
            I agree to the academy terms
        </label>
        <span class="error"><?= e($errors["agree"] ?? "") ?></span>

        <button type="submit">Register</button>

        <p><a href="search.php">Go to Search Page</a></p>
    </form>

<?php endif; ?>

</body>
</html>
