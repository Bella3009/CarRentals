<?php
    function connectToDB() {
        $myConn = mysqli_connect('localhost', 'root','sss','car_rentals_db');
        if (!$myConn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $myConn;
    }

    function getEmployeeId($conn, $email) {
       
        $sql = "SELECT EmployeeID, Name, password FROM Employees WHERE Email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $empId, $name, $password);
            if (mysqli_stmt_fetch($stmt)) {
                // Return results as an associative array
            $result = [
                'EmployeeID' => $empId,
                'Name' => $name,
                'Password' => $password
            ]; 
            }
            else {
                $result = false;
            }

            mysqli_stmt_close($stmt);
            return $result;
        } else {
            return false;
        }
    }

    
    function getAllCars($conn) {
        $query = "SELECT * FROM Cars";
        $result = mysqli_query($conn, $query);
        
        return $result;
    }

    function getMaintRecords($conn, $carId) {
        $sql = "SELECT `Date`,`Description`,`Cost` FROM CarMaintenance A INNER JOIN Cars B ON A.CarID_FK = B.CarID AND B.CarID = $carId;";
        $result = mysqli_query($conn, $sql);

        return $result;
    }

    function insertCars($conn, $make, $model, $image, $year, $licensePlate, $status) {
        $sql = "INSERT INTO Cars (Make, Model, Image, Year, LicensePlate, Status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssiss", $make, $model, $image, $year, $licensePlate, $status);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            return false;
        }
    }
    function insertLog($conn, $carId, $date, $description, $cost) {
        $sql = "INSERT INTO CarMaintenance (CarID_FK, Date, Description, Cost) VALUES ($carId, '$date', '$description', $cost)";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    function removeCar($conn, $carId) {
        $sql = "DELETE FROM Cars WHERE CarID = $carId";
        $result = mysqli_query($conn, $sql);
        return $result;
    }
    function freeResult($result) {
        mysqli_free_result($result);
    }
    function closeDB($conn) {
        mysqli_close($conn);
    }
?>