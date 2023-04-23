<?php
session_start();

//SIGNUP CREDENTIALS PUSH


$host = 'localhost';
$username = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$dbname = 'user_registration';
$conn = mysqli_connect($host, "root", "", $dbname);

// Check for errors
if (mysqli_connect_error()) {
  die('Failed to connect to database: ' . mysqli_connect_error());
}


$email = mysqli_real_escape_string($conn, $_POST['email']);
// checks if the email is already registered
$sql = "SELECT * FROM registration WHERE email='$email'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
  echo "<script>alert('This email address is already registered.')</script>";
  echo "<meta http-equiv='refresh' content='0;url=http://localhost/user_registration/index.html'>";
  echo "<script>setTimeout(function(){alert.close();}, 3000);</script>";
  exit();

}
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Create connection
$conn = new mysqli("localhost", "root", "", "user_registration");

//take email for the session
$_SESSION['email'] = $email;
$_SESSION['name'] = $name;

// inserts the values of signup page to the table 
$sql = "INSERT INTO registration (name, email, password) VALUES ('$name', '$email', '$password')";
if (mysqli_query($conn, $sql)) {
  // Registration successful, so redirect to the user panel
  header("location: userhome.php");
  exit();
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>