<?php 

include "connect.php";

$sql = "SELECT * FROM students";

$result = $conn->query($sql);

?>

<!DOCTYPE html>

<html>

<head>

    <title>View Page</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" href="../Login/css/view.css">

</head>

<body>

    <div class="container">

        <h2>Students</h2>
        <form action="search.php" method="GET">
        <div class="input-group mb-3">
            <input type="text" name="search" value="<?php if(isset($_GET['search'])) {echo($_GET['search']);} ?>" class="form-control" placeholder="Search">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
        </form>


        <script>
									function goBack() {
    									window.location.href = "final.php";
									}
								</script>
								<button onclick="goBack()">Go To Dashboard</button>
<table class="table">

    <thead>

        <tr>

        <th>ID</th>

        <th>Name</th>

        <th>Course</th>

        <th>Contact</th>

        <th>address</th>

        <th>age</th>

        <th>Action</th>

        <!-- <th></th> -->

    </tr>

    </thead>

    <tbody> 

        <?php

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

        ?>

                    <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><?php echo $row['full_name']; ?></td>

                    <td><?php echo $row['course']; ?></td>

                    <td><?php echo $row['phone']; ?></td>

                    <td><?php echo $row['student_address']; ?></td>

                    <td><?php echo $row['age']; ?></td>

                    <td><a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;<a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                    
                    <!-- <td><a class="btn btn-info" href="imageview.php?id=<?php echo $row['id']; ?>"> View</td> -->
                    </tr>                       

        <?php       }

            }

        ?>  

        
        
        

    </tbody>

</table>
<?php
if (isset($_GET['success']))
						 {
        					echo '<p style="color: red;">Invalid username or password</p>';
   						 }

                         ?>
    </div> 

</body>

</html>