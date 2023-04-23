<?php

session_start();
// Create connection
$conn = new mysqli("localhost", "root", "", "user_registration");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $email = $_POST["email"];
  $password = $_POST["password"];
 
  
  // Verify login credentials
  $sql = $conn->prepare("SELECT * FROM registration WHERE email = ?");
  $sql->bind_param("s", $email);
  $sql->execute();
  $result = $sql->get_result();
  
if($result->num_rows>0)
{
  $row = $result->fetch_assoc();
  $hashed_password = $row['password'];

  if (password_verify($password,$hashed_password)){
  $_SESSION['email'] = $row['email'];
  $_SESSION['name'] = $row['name'];
    header("location: userhome.php");
    exit();
  } else {
    echo '<script> alert (" incorrect password "); setTimeout(function() {alert.close();}, 300);</script>';
    echo "<meta http-equiv='refresh' content='0;url=http://localhost/qwallet/userside/index.html'>";
  }

}else{
  echo "<script>alert('Incorrect email & Password')setTimeout(function() {alert.close();}, 300);</script>";
  echo "<meta http-equiv='refresh' content='0;url=http://localhost/qwallet/userside/index.html'>";
  exit();
}
}
