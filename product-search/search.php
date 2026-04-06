<?php
include "db.php";

$q = $_GET["q"];

$sql = "SELECT * FROM products WHERE name LIKE '%$q%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Name</th><th>Category</th><th>Price</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['category']}</td>
                <td>{$row['price']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No results found";
}
?>
