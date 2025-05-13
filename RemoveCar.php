<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="Menu.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Car Rentals - Remove Car</title>
</head>
<body>
    <?php
         require_once 'Menu.php';    
         require 'DbTrans.php';
          
        $conn = connectToDB();
        $result = getAllCars($conn);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $carId = $row["CarID"];
                $image = $row["Image"];
                $licensePlate = $row["LicensePlate"];
                $cars[] = array(
                    'carId' => $carId,
                    'image' => $image,
                    'licensePlate' => $licensePlate
                );
                
            }
        
        closeDB($conn);
       // print_r($cars);
    }

    ?>
    <div class="container">
        <h3>Remove Car --- Select Car Below -- </h3>
        <form action="removeCar.php" method="POST" onsubmit="return confirm('Are you sure?')">
            <div class="mb-3">
                <label for="carName" class="form-label">Car Name</label>
                <select class="form-select" id="carSelected" name="carSelected">
                    <?php
                        foreach ($cars as $car) {
                            echo "<option value='$car[carId]'>$car[licensePlate]</option>";
                        }
                    ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Remove Car</button>
        </form>
    </div>
</body>
</html>
<?php
    if (isset($_POST['submit'])) {
        $carId = $_POST['carSelected'];
        $conn = connectToDB();
        $result = removeCar($conn, $carId);

        if ($result) {
            echo "<div class='alert alert-success'>Car with id $carId removed successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Error removing car</div>";
        }
        closeDB($conn);
    }