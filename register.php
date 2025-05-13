<?php
  
  require_once('dbfunc.php');
  session_start();
?>
<!DOCTYPE html>
<html> 
    <head> 
        <title>SHOW Vehicles</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <style>
             th{ 
                color: red;      
            }  
        </style>
    </head>
    
    <body>
  <div class="d-flex align-items-center vh-100"> <!-- vertical centering-->
    <div class="container">
      <form name='register' method="post" class="text-center" >   <!--horizontal centering-->      
        <div>
          <label class="form-label">User Name: <label>
          <input type="text" class="form-control" name="userName" required>       
        </div>
        <div>
        <label class="form-label">Password: <label>
          <input type="password" class="form-control" name="password" required>       
        </div>
        <div>  
          <input type="submit"  name="submit"  value="Login" class="btn btn-primary" > 
        </div>
      </form> 
    </div>
  </div>

  <?php
 
  
  //$_SESSION['userName'] = $_GET["userName"];
     if (isset($_POST['submit'])) {
        //echo $_SERVER['REQUEST_METHOD'];
        $conn = connectToDB();
        //escape fields - demonstrate
        $username = trim(mysqli_real_escape_string($conn, $_POST['userName']));
        $password = trim(mysqli_real_escape_string($conn, $_POST['password']));

        $result = insertUser($conn, $username, $password);

        if ($result) 
        {
            $_SESSION['userName'] = $_POST['userName'];
            header("Location: http://localhost/student/index.php");
        }
     }
     

    ?>
    
    </body>
     
    
</html>