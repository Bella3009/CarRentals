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
    <!-- JustValidate Library -->
<script src="https://unpkg.com/just-validate@4.3.0/dist/just-validate.production.min.js"></script>
    <title>Car Rentals - Insert Car</title>
</head>
<body>
<div class="container-fluid">
    <?php 
        require_once 'Menu.php';    
        require 'DbTrans.php';
    ?>
    <h3>Insert a New Car</h3>
    <form id="addCarForm" method="POST" action="AddCar.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="make" class="form-label">Make</label>
            <input type="text" class="form-control" id="make" name="make" required>
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" class="form-control" id="model" name="model" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Year of Manufacture</label>
            <input type="number" class="form-control" id="year" name="year" required>
        </div>
        <div class="mb-3">
            <label for="licensePlate" class="form-label">License Plate</label>
            <input type="text" class="form-control" id="licensePlate" name="licensePlate" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status">
                <option value="">--Select a status--</option>
                <option value="available">Available</option>
                <option value="rented">Rented</option>
                <option value="in_service">In service</option>
                <option value="not available">Not available</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="carImage" class="form-label">Image</label>
            <input type="file" class="form-control" id="carImage" name="carImage">
        </div>
        <button type="submit" name="submitForm" class="btn btn-primary mb-2">Submit</button>
    </form>
    <?php
        if (isset($_POST["submitForm"])) {
            $make = $_POST['make'];
            $model = $_POST['model'];
            $year = $_POST['year'];
            $licensePlate = $_POST['licensePlate'];
            $status = $_POST['status'];
        
           //print_r($_FILES['carImage']);

            if (isset($_FILES['carImage'])) {
                $image = $_FILES['carImage']['name'];
                $target_dir = "images/";
                $target_file = $target_dir . basename($image);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                
                // Check if file is a valid image
                $validExtensions = array("jpg", "jpeg", "png");
                if (!in_array($imageFileType, $validExtensions)) {
                    echo "<div class='alert alert-danger'>Invalid image format. Only JPG, JPEG and PNG files are allowed.</div>";
                    return;
                }
                //echo $target_file;
                // Move the uploaded file to the target directory
                if (!move_uploaded_file($_FILES['carImage']['tmp_name'], $target_file)) {
                    echo "<div class='alert alert-danger'>Failed to upload the designated file.</div>";
                    return;
                } 
            }


            if (empty($make) || empty($model) || empty($year) || empty($licensePlate) || empty($status) || empty($image)) {
                echo "<div class ='alert alert-danger'>All fields are required</div>";
                return;
            }
           
            
            $conn = connectToDB();
            
           $result = insertCars($conn, $make, $model, $target_file, $year, $licensePlate, $status);
           $newCarId = mysqli_insert_id($conn);
           if ($result) {
               echo "<div class='alert alert-success'>Car with id '$newCarId' inserted successfully</div>";
            
            closeDB($conn);
        }
    }
 
    
?>
</div>
<!-- JustValidate Script -->
<script>
    const validator = new JustValidate('#addCarForm');

    validator
        .addField('#make', [
            {
                rule: 'required',
                errorMessage: 'Make is required'
            },
            {
                rule: 'minLength',
                value: 2,
                errorMessage: 'Make must be at least 2 characters'
            }
        ])
        .addField('#model', [
            {
                rule: 'required',
                errorMessage: 'Model is required'
            },
            {
                rule: 'minLength',
                value: 2,
                errorMessage: 'Model must be at least 2 characters'
            }
        ])
        .addField('#year', [
            {
                rule: 'required',
                errorMessage: 'Year is required'
            },
            {
                rule: 'number',
                errorMessage: 'Year must be a valid number'
            },
            
        ])
        .addField('#licensePlate', [
            {
                rule: 'required',
                errorMessage: 'License Plate is required',
            },
            {
                rule: 'minLength',
                value: 6,
                errorMessage: 'License Plate must be at least 6 characters'
            }
        ])
        .addField('#status', [
            {
                rule: 'required',
                errorMessage: 'Status is required'
            }
        ])
        .addField('#carImage', [
            {
                rule: 'required',
                errorMessage: 'Image is required'
            }
        ]);
        validator.onSuccess((event) => {
            event.target.submit();
    });

</script>
</body>
</html>