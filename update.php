<?php 

include "connect.php";

    if (isset($_POST['update'])) {

        $id = $_POST['id'];

        $full_name = $_POST['full_name'];

        $course = $_POST['course'];

        $phone = $_POST["phone"];
									
        $address = $_POST["student_address"];

        $age = $_POST['age']; 

        $sql = "UPDATE `students` SET `full_name`='$full_name',`course`='$course',`phone`='$phone',`student_address`='$address',`age`='$age' WHERE `id`='$id'"; 

        $result = $conn->query($sql); 

        if ($result == TRUE) {

            echo "Record updated successfully.";
            


        }else{

            echo "Error:" . $sql . "<br>" . $conn->error;

        }

    } 
    

if (isset($_GET['id'])) {

    $id = $_GET['id']; 

    $sql = "SELECT * FROM `students` WHERE `id`='$id'";

    $result = $conn->query($sql); 

    if ($result->num_rows > 0) {        

        while ($row = $result->fetch_assoc()) {

            $full_name = $row['full_name'];

            $course = $row['course'];

            $phone = $row["phone"];
									
            $address = $row["student_address"];

            $age = $row['age'];

            $id = $row['id'];

            // $qrcode = $row['qrcode'];

        } 

    ?>
								<script>
									function goBack() {
    									window.location.href = "final.php";
									}
								</script>
								<button onclick="goBack()">Go to list of student</button>
        <h2>User Update Form</h2>

        <form action="" method="post">

          <fieldset>

            <legend>Personal information:</legend>

            Full Name:<br>

            <input type="text" name="full_name" value="<?php echo $full_name; ?>">

            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <br>

            Course<br>

            <input type="text" name="course" value="<?php echo $course; ?>">

            <br>

            Phone:<br>

            <input type="number" name="phone" value="<?php echo $phone; ?>">

            <br>

            age:<br>

            <input type="number" name="age" value="<?php echo $age; ?>">

            <br>
            
            Address<br>

            <input type="text" name="student_address" value="<?php echo $address; ?>">

            <br><br>

            <input type="submit" value="Update" name="update">

          </fieldset>

        </form> 

        </body>

        </html> 

    <?php

    } else{ 

        header('Location: view.php');

    } 

}

?> 