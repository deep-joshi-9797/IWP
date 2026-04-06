<?php
$file = "feedback.txt";

// Function to validate input
function validate($data) {
    return htmlspecialchars(trim($data));
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = validate($_POST["name"]);
    $email = validate($_POST["email"]);
    $feedback = validate($_POST["feedback"]);
    $rating = $_POST["rating"];

    // Validation
    if (empty($name) || empty($email) || empty($feedback) || empty($rating)) {
        $message = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format!";
    } else {
        // Format data
        $entry = "Name: $name | Email: $email | Rating: $rating | Feedback: $feedback\n";

        // Append to file
        file_put_contents($file, $entry, FILE_APPEND);

        $message = "Feedback submitted successfully!";
    }
}

// Read existing feedback
$allFeedback = file_exists($file) ? file($file) : [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback System</title>
    <style>
        body { font-family: Arial; margin: 40px; background: #33cddb;}
        form { width: 300px; margin-bottom: 30px; }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }
        .msg { color: red; }
        .success { color: green; }
        .box {
            border: 1px solid black;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h2>Online Feedback Form</h2>

<p class="<?php echo ($message == 'Feedback submitted successfully!') ? 'success' : 'msg'; ?>">
    <?php echo $message; ?>
</p>

<form method="POST">
    <input type="text" name="name" placeholder="Enter Name">
    <input type="email" name="email" placeholder="Enter Email">
    <textarea name="feedback" placeholder="Enter Feedback"></textarea>

    <select name="rating">
        <option value="">Select Rating</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>

    <button type="submit">Submit</button>
</form>

<h3>All Feedback</h3>

<?php
if (!empty($allFeedback)) {
    foreach ($allFeedback as $entry) {
        echo "<div class='box'>$entry</div>";
    }
} else {
    echo "No feedback yet.";
}
?>

</body>
</html>
