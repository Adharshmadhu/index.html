<?php
$servername = "localhost";
$username="root";
$password="12345678";
$dbname="register";
$conn=new mysqli( $servername,$username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name     = $_POST ['username'];
$email    = $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

// Check password match
if ($password !== $cpassword) {
    die("Passwords do not match.");
}

// Hash password
//$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO register (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hashedPassword);

// Execute
if ($stmt->execute()) {
    echo "New record inserted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>