<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
     <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Car Rentals - Remove Car</title>
    <style>
       /* Style for images in the selected item display */
       .select2-container--default .select2-selection--single {
        height: 50px; /* Adjust this value based on the size of your image */
    }
       .select2-container .select2-selection--single .select2-selection__rendered {
        height: 50px; /* Adjust this value based on the size of your image */
        line-height: 50px; /* This should generally be the same as the height for vertical centering */
        overflow: hidden; /* Prevents the image from overflowing */
    }

        .select2-container--default .select2-selection--single .select2-selection__rendered img {
        max-width:75px;  
        max-height: 50px; 
        margin-top: -5px; 
        
        
    }
    /* Style for images in the dropdown */
    .img-thumbnail {
        width:18rem;
       }
   
    </style>
</head>
<body>
    <?php
        include 'dbTrans.php';
          
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
                            echo "<option value='$car[carId]' data-img-src='$car[image]'> $car[licensePlate]</option>";
                        }
                    ?>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Remove Car</button>
        </form>
    </div>
</body>
<script>
     $(document).ready(function() {
    $('#carSelected').select2({
      templateResult: formatState,
      templateSelection: formatState
    });

    function formatState (state) {
      if (!state.id) {
        return state.text;
      }
      //var baseUrl = "path_to_images_folder";
      var $state = $(
        '<span><img src="' +  state.element.getAttribute('data-img-src') + '" class="img-thumbnail" /> ' + state.text + '</span>'
      );
      console.log($state);
      return $state;
    };
  });
</script>
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
    ?>