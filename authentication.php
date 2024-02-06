<?php 
    session_start();

    if(isset($_SESSION['authenticated']))
    {
        $_SESSION['status'] = "Please login to Access student portal.";
        header('location: student.php');
        exit(0);
    }



?>