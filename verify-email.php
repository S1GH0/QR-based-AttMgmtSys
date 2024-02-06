<?php 
    session_start();
    include('connect.php');
    if(isset($_GET['token']))
    {
        $token = $_GET['token'];
        $verify_query = "SELECT verification_code,verify_status FROM users WHERE verification_code='$token' LIMIT 1";
        $verify_query_run = mysqli_query($conn, $verify_query);

        if(mysqli_num_rows($verify_query_run) > 0)
        {
            $row = mysqli_fetch_array($verify_query_run);
            // echo $row['verification_code'];

            if($row["verify_status"] == "0"){
                $clicked_token = $row["verification_code"];
                $update_query = "UPDATE users SET verify_status = '1' WHERE verification_code='$clicked_token' LIMIT 1";
                $update_query_run = mysqli_query($conn, $update_query);

                if($update_query_run)
                {
                    $_SESSION['status'] = "Your Account has been verified Successfully!";
                    header("location: login.php?success=true");
                    exit(0);
                }
                else
                {
                    $_SESSION['status'] = "Verification Failed.!";
                    header("location: login.php");
                    exit(0);
                }
            }   
            else
            {
                $_SESSION['status'] = "Email already verified. Please Login";
                header("location: login.php?register=true");
                exit(0);
            }
        }
        else{
            $_SESSION['status'] = "This token doesnot exist";
            header("location: register.php");
        }
    }
    else
    {
        $_SESSION['status'] = "Not Allowed";
        header("location: login.php");
    }


?>