<?php
// Student Data (Array)
$students = [
    ["name" => "Rahul", "marks" => 85, "dob" => "2003-05-12"],
    ["name" => "Anita", "marks" => 72, "dob" => "2002-11-20"],
    ["name" => "Vikram", "marks" => 90, "dob" => "2003-02-15"],
    ["name" => "Sneha", "marks" => 65, "dob" => "2001-08-30"],
    ["name" => "Arjun", "marks" => 78, "dob" => "2002-06-10"]
];

// Function to calculate average marks
function calculateAverage($students) {
    $total = 0;
    foreach ($students as $student) {
        $total += $student["marks"];
    }
    return $total / count($students);
}

// Function to determine grade
function getGrade($marks) {
    if ($marks >= 85) return "A";
    elseif ($marks >= 70) return "B";
    elseif ($marks >= 50) return "C";
    else return "F";
}

// Function to calculate age from DOB
function calculateAge($dob) {
    $birthDate = new DateTime($dob);
    $today = new DateTime();
    return $today->diff($birthDate)->y;
}

// Calculate average
$average = calculateAverage($students);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Data Management</title>
    <style>
        body {
            font-family: Arial;
            background: #f2ff3f;
            display: flex;
            flex-direction:column;
            height: 100vh;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: auto;
            background: #e44646;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Student Data Management System</h1>

<table>
    <tr>
        <th>Name</th>
        <th>Marks</th>
        <th>Grade</th>
        <th>DOB</th>
        <th>Age</th>
    </tr>

    <?php foreach ($students as $student) { ?>
    <tr>
        <td><?php echo $student["name"]; ?></td>
        <td><?php echo $student["marks"]; ?></td>
        <td><?php echo getGrade($student["marks"]); ?></td>
        <td><?php echo $student["dob"]; ?></td>
        <td><?php echo calculateAge($student["dob"]); ?></td>
    </tr>
    <?php } ?>
</table>

<h3 style="text-align:center;">
    Average Marks: <?php echo number_format($average, 2); ?>
</h3>

</body>
</html>