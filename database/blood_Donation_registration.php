<?php
// connect to the database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "blood_donation_camp";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// retrieve the form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$bloodgroup = $_POST['bloodgroup'];
$age = $_POST['age'];
$gender = $_POST['gender'];

// insert the data into the database
$sql = "INSERT INTO donors (name, email, phone, bloodgroup, age, gender) VALUES ('$name', '$email', '$phone', '$bloodgroup', '$age', '$gender')";
if (mysqli_query($conn, $sql)) {
	echo "Registration successful!";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close the database connection
mysqli_close($conn);
?>
