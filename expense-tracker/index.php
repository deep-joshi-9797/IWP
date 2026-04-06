<?php
$file = "expenses.txt";

// Function to sanitize input
function validate($data) {
    return htmlspecialchars(trim($data));
}

// Function to calculate total for a given date
function getTotalByDate($expenses, $date) {
    $total = 0;
    foreach ($expenses as $expense) {
        $parts = explode("|", $expense);
        if (trim($parts[0]) == $date) {
            $total += (float)$parts[2];
        }
    }
    return $total;
}

// Read all expenses
$expenses = file_exists($file) ? file($file) : [];

// Handle form submission
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = validate($_POST["date"]);
    $category = validate($_POST["category"]);
    $amount = validate($_POST["amount"]);

    if (empty($date) || empty($category) || empty($amount)) {
        $message = "All fields are required!";
    } else {
        $entry = "$date | $category | $amount\n";
        file_put_contents($file, $entry, FILE_APPEND);
        $message = "Expense added successfully!";
        $expenses[] = $entry; // update array instantly
    }
}

// Get today's date
$today = date("Y-m-d");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker</title>
    <style>
        body { font-family: Arial; margin: 40px; background: #f07fe7;}
        form { width: 300px; margin-bottom: 20px; }
        input, button {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }
        .box {
            border: 1px solid black;
            padding: 10px;
            margin-bottom: 10px;
        }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>

<h2>Daily Expense Tracker</h2>

<p class="<?php echo ($message == 'Expense added successfully!') ? 'success' : 'error'; ?>">
    <?php echo $message; ?>
</p>

<form method="POST">
    <input type="date" name="date">
    <input type="text" name="category" placeholder="Category (Food, Travel...)">
    <input type="number" name="amount" placeholder="Amount">
    <button type="submit">Add Expense</button>
</form>

<h3>Today's Expenses (<?php echo $today; ?>)</h3>

<?php
$todayTotal = 0;

foreach ($expenses as $expense) {
    $parts = explode("|", $expense);
    if (trim($parts[0]) == $today) {
        echo "<div class='box'>$expense</div>";
        $todayTotal += (float)$parts[2];
    }
}

echo "<strong>Total Today: $todayTotal</strong>";
?>

</body>
</html>
