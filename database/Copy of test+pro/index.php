<!DOCTYPE html>
<html lang="en">
<head>
	<title>Blood Donation Camp</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		

		body {
			font-family: Arial, sans-serif;
			background-color: #f5f5f5;
			color: #333;
			padding: 20px;
			background-image: url('blood.jpeg');
            background-repeat: no-repeat;
            background-size: cover;
		}

		h1 {
			font-size: 120px;
            margin-top: 0;
            padding: 30px;
            text-align: center;
			color: red;
		}
		

		form {
			background-color: #fff;
			padding: 20px;
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0,0,0,0.2);
			max-width: 600px;
			margin: 0 auto;
		}

		label {
			display: block;
			margin-bottom: 10px;
			font-size: 18px;
		}

		input[type="text"],
		input[type="email"],
		input[type="tel"],
		input[type="number"],
		select {
			width: 100%;
			padding: 10px;
			margin-bottom: 20px;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			background-color: #f5f5f5;
			color: #333;
			box-sizing: border-box;
		}

		input[type="radio"] {
			margin-right: 10px;
			margin-bottom: 20px;
		}

		input[type="submit"] {
			background-color: #e74c3c;
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			font-size: 18px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #c0392b;
		}
	</style>
</head>
<body background ="blood.jpeg" >
	
	<img src="logo.png" alt="Blood Donation Camp Logo" height="100" width="100">
	<center>
		<h1>Blood Donation Camp</h1>
		<h2>Login To proceed </h2>
		
		<form action="insert.php" method="post">

<p>
<label for="name">Name:</label>
		<input type="text" name="name" required minlength="2" maxlength="30"><br><br>
		
		<label for="email">Email:</label>
		<input type="email" name="email" required><br><br>
		<p>		
		<label for="phone">Phone:</label>
		<input type="tel" name="phone" required pattern="[0-9]{10}"><br><br>
		<p>
		<label for="bloodgroup">Blood Group:</label>
		<select name="bloodgroup" required>
			<option value="">Select Blood Group</option>
			<option value="A+">A+</option>
			<option value="A-">A-</option>
			<option value="B+">B+</option>
			<option value="B-">B-</option>
			<option value="O+">O+</option>
			<option value="O-">O-</option>
			<option value="AB+">AB+</option>
			<option value="AB-">AB-</option>
		</select><br><br>
		<p>
		<label for="age">Age:</label>
		<input type="number" name="age" required min="18" max="60"><br><br>
		<p>
		<label for="gender">Gender:</label>
		<input type="radio" name="gender" value="Male" required>Male
		<input type="radio" name="gender" value="Female" required>Female
		<input type="radio" name="gender" value="Other" required>Other<br><br>
		
		<input type="submit" name="submit" value="Submit">
		</form>
	</center>
</body>
</html>
