
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

    </tr>

    </thead>

    <tbody> 

    <?php 
        include('connect.php');
        if(isset($_GET['search']))
        {
            $filtervalues = $_GET['search'];
            $query = "SELECT * FROM students WHERE CONCAT(id,full_name,course,Student_address, age, phone) LIKE '%$filtervalues%' ";
            $query_run = mysqli_query($conn, $query);

            if(mysqli_num_rows($query_run) > 0)
            {
                foreach($query_run as $items)
                {
                    ?>
                    <tr>
                        <td><?= $items['id']; ?></td>
                        <td><?= $items['full_name']; ?></td>
                        <td><?= $items['course']; ?></td>
                        <td><?= $items['phone']; ?></td>
                        <td><?= $items['student_address']; ?></td>
                        <td><?= $items['age']; ?></td>
                        <td><a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;<a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                    </tr>
                    <?php
                }
            }
            else
            {
                ?>
                    <tr>
                        <td colspan="4">No Record Found</td>
                    </tr>
                <?php
            }
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