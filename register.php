<?php
session_start();
include('connect.php');

?>
<!-- ... rest of the registration form HTML ... -->
<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>

    <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

    <link rel="stylesheet" href="../Login/css/view.css" >
</head>
<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert">
                    <?php 
                        if(isset($_SESSION['status'])){
                            echo("<h4>".$_SESSION['status']."</h4>");
                            unset($_SESSION['status']);
                        }
                    
                    ?>
                </div>
                <div class="card-shadow">
                    <div class="card-header">
                    <h2>Register</h2>
                    </div>
                    <div class="card-body">
                    <form method="post" action="verify.php">
                        <div class="form-group mb-3">
                            <label for="username">Username:</label>
                            <input type="text" name="username" required><br>
                        </div>
                        <div class="form-group mb-3">

                            <label for="email">Email:</label>
                            <input type="email" name="email" required><br>
                        </div>      
                        <div class="form-group mb-3">
                            <label for="password">Password:</label>
                            <input type="password" name="password" required><br>
                        </div>      
                            <div class="form-group">
                            <input type="submit" name="register_btn" class="btn btn-primary" value="Register">
                        </div>      
                    </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</body>
</html>
