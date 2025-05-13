<!-- filepath: /Users/krisdomancich/Documents/Mcast 2nd semester 2024-2025/ServerSideScripting/exercises/car_rentals_db/login.php -->
<?php
session_start();
require "DbTrans.php";
//connect to the car_rentals_db database
$conn = connectToDB();
//check if the form is submitted
if (isset($_POST['submit'])) {
  
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);

  $result = getEmployeeId($conn, $email);

  if ($result) {
    $empId = $result['EmployeeID'];
    $hashedPassword = $result['Password'];
    $name = $result['Name'];
    
    // Verify the password
    if (password_verify($password, $hashedPassword)) {
      $_SESSION['email'] = $email;
      $_SESSION['empId'] = $empId;
      $_SESSION['name'] = $name;
      header("Location: ShowCars.php");
      exit();
    } else {
      echo "Invalid email or password.";
    }
  } else {
    echo "Invalid email or password.";
  }

}
?>
