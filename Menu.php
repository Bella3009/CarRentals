<?php
session_start();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="ShowCars.php"><img src="logos/logo.png"/>Car Rentals</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="AddCar.php">Add Car</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="RemoveCar.php">Remove Car</a>
                </li>
            </ul>
        </div>
        <?php
        if (!isset($_SESSION['email'])) {
            ?>
     
        <form class="row g-3 align-items-center" action="login.php" method="POST">
            <div class="col-auto">
                <label for="email" class="visually-hidden">Username</label>
                <input type="email" class="form-control" id="username" name="email" placeholder="Email" required>
            </div>
            <div class="col-auto">
                <label for="password" class="visually-hidden">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="col-auto">
                <button type="submit" name="submit" class="btn btn-outline-success">Login</button>
            </div>
        </form>
        <?php
        } else {
            ?>
            <span class="navbar-text">
                Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!
            </span>
            <a href="logout.php" class="btn btn-outline-danger ms-3">Logout</a>
            <?php
        }
        ?> 
        
    </div>
</nav>
