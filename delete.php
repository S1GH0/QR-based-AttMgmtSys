<?php 

include "connect.php"; 

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM `students` WHERE `id`='$id'";

     $result = $conn->query($sql);

     if ($result == TRUE) {
        header('Location: view.php?success=true');

        // echo "Record deleted successfully.";

    }else{

        echo "Error:" . $sql . "<br>" . $conn->error;

    }

} 

?>