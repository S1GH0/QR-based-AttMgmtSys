<?php


include('connect.php');
session_start();

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $text = $_POST['text'];

        list($id, $sname) = explode('_', $text);

        // Check if the student with the given ID exists
        $checkSql = "SELECT * FROM students WHERE id = '$id'";
        $result = $conn->query($checkSql);


        if ($result->num_rows > 0) {
            // Student exists, proceed to insert into attendance table
            $check2 = "SELECT id FROM attendance WHERE DATE(time_in )=CURDATE() AND id = $id";
            $result2 = $conn->query($check2);

            if($result2-> num_rows == 0)
            {
                $sql = "INSERT INTO attendance (id, Sname, present_status) VALUES ('$id', '$sname' , '1')";
                // $update_query = "INSERT INTO attendance set present_status = '1'";
                // $update_query_run = mysqli_query($conn, $update_query);

                if ($conn->query($sql) === TRUE) {
                    // $_SESSION['success'] = 'Attendance recorded successfully';
                    header('location:qr.php?success=true');
                    exit(0);
                } else {
                    // $_SESSION['error'] = $conn->error;
                    header('location:qr.php?er=true');
                    exit(0);
                }
            }
            else{
                header('location:qr.php?error=true');
                exit(0);
            }

           
        } else {
            // Student does not exist, handle accordingly
            // $_SESSION['error'] = 'Student with ID ' . $id . ' not found';
            header('location: qr.php?na=true');
            exit(0);
        }
    } else {
        http_response_code(405); // Method Not Allowed
        echo 'Invalid request method';
    }

    header("location: qr.php");
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) {
        header("location: qr.php?error1=true");
        exit(0);
    } else {
        // Handle other database-related exceptions
        echo "Database error: " . $e->getMessage();
    }
} finally {
    $conn->close();
}





// include("connect.php");
// session_start();
//     try{

  
//      if(isset($_POST['text'])){
//         $text = $_POST['text'];

        
       
//     //current date have not beed inserted, insert it as usual

//         $sql = "INSERT INTO     attendance(id_Sname,time_in) VALUES( '$text', NOW())";

//         if($conn-> query($sql) === TRUE){
       

            
//             $_SESSION['success'] = 'Attendance recorded successfully';

//         } 
//         else{
//             $_SESSION['error'] = $conn->error;
//         }
//         header("location: qr.php");
//     }
// }
//      catch(mysqli_sql_exception $e){
//         if($e->getCode() == 1062){
//             header("location: qr.php?error=true");
//         }
//         else {
//             // Handle other database-related exceptions
//             echo "Database error: " . $e->getMessage();
//         }
//      }
//      finally{
//         $conn->close();
//      }
    

?>


