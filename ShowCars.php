<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="Menu.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Car Rentals - Cars view</title>
</head>
<body>
<?php
    
?>
<div class="container-fluid">
    <div class="row">
    <?php
        require_once 'Menu.php';    
        require_once 'Dbtrans.php';
        // Connect to the database
        $conn = connectToDB();
        // Get all the cars from the database
        $result = getAllCars($conn);
    
        // Check if the query was successful
        if ($result) {
            // Loop through the result set and display the data
            while ($row = mysqli_fetch_assoc($result)) {
                // Access the data using column names
                $carId = $row['CarID'];
                $make = $row['Make'];
                $model = $row['Model'];
                $image= $row['Image'];
                $year = $row['Year'];
                $licensePlate = $row['LicensePlate'];
                $status  = $row['Status'];    
            ?>
        

    <div class="col-lg-4 col-md-6">
        <div class="card h-100">
            <img src="<?php echo $image; ?>" class="card-img-top" alt="<?php echo "$make $model"; ?>">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?php echo "$make $model"; ?></h5>
                <p class="card-ext">Current Car Status: <?php echo $status; ?></p>
                <p class="card-text">License plate: <?php echo $licensePlate; ?></p>
            </div>
            <div card="footer"> 
                <div class="d-flex justify-content-center mb-2">
                    <a href="MaintRecords.php?carId=<?php echo $carId?>&image=<?php echo $image?>&make=<?php echo $make?>&model=<?php echo $model?>" 
                        class="btn btn-primary">Maintenance records</a>
                </div>
            </div>
        </div>
    </div>
        


<?php
         }//while

        // Free the result set
        mysqli_free_result($result);
    } else {
        // Handle the error if the query fails
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    
?>
</div>
</div>
</body>
</html>