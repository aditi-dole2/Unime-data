<?php

// Define database connection variables
$host = "localhost";
$username = "root";
$password = "";
$dbname = "blood_donation_camp";

// Create database connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Get form data and sanitize inputs
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$bloodgroup = mysqli_real_escape_string($conn, $_POST['bloodgroup']);
$age = mysqli_real_escape_string($conn, $_POST['age']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);

// Insert data into database
$sql = "INSERT INTO donors (name, email, phone, bloodgroup, age, gender) VALUES ('$name', '$email', '$phone', '$bloodgroup', '$age', '$gender')";

if (mysqli_query($conn, $sql)) {
	echo "Registration successful";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);

?>
