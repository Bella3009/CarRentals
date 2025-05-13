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
    <title>Car Maintenance</title>
</head>
<body>

<?php
     require_once 'Menu.php';  
     require 'DbTrans.php';
     // Connect to the database
     $conn = connectToDB();

    $carId = $_GET['carId']; //get carId from the URL
    $image = $_GET['image']; //get image from the URL
    $make = $_GET['make']; //get make from the URL
    $model = $_GET['model']; //get model from the URL
?>
<div class="container">
    <div class="row">
        <!-- <div class="col"> -->
            <div class="card">
                <img src="<?php echo $image; ?>" class="card-img-top" alt="<?php echo "$make $model"; ?>">
                <div class="card-body">
                <h5 class="card-title"><?php echo "$make $model"; ?></h5>
<?php
   $result = getMaintRecords($conn, $carId);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $date = $row['Date'];
            $description = $row['Description'];
            $cost = $row['Cost'];
          
    ?>              
                    <p class="text-muted">--- Start of log --- </p>
                    <p class= "card-text" >Date Of Maintenance: <?php echo "$date"; ?></p>
                    <p class= "card-text" >Maintenance Log details: <?php echo "$description"; ?></p>           
                    <p class= "card-text" >Cost Incurred: &euro;<?php echo "$cost"; ?></p>
                    <p class="text-muted">--- End of log --- </p>
                    
                
    <?php
        }//while
        mysqli_free_result($result);
    } else {
        // Handle the error if the query fails
        echo "Error: " . mysqli_error($conn);
    }//if

    // Close the database connection
    mysqli_close($conn);
    ?>
            </div>
            <!-- </div> -->
        </div>
    </div>
</div>
    
</body>
</html>