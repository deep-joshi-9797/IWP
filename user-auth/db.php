<?php
$conn = new mysqli("localhost", "root", "", "iwp_users");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
