
<html lang="en" >
<head>
	<title>QR Code Generator</title>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css'>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel='stylesheet' href='../Login/css/qrgeneration.css'>
</head>
<body>
	<?php include "connect.php"; 
	
	session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
	<div class="container py-3">

		<div class="row">
			<div class="col-md-12"> 

				<div class="row justify-content-center">
					<div class="col-md-6">
						<!-- form user info -->
						<div class="card card-outline-secondary">
							<div class="card-header">
								<h3 class="mb-0">User Information</h3>
							</div>
							<?php
							$id = "";
							$full_name = "";
							$course = "";
							$phone = "";
							$address = "";
							$age = "";


							if (isset($_POST["btnsubmit"])) {
									$id = $_POST["id"];
									$full_name = $_POST["full_name"];
									$course = $_POST["course"];
									$phone = $_POST["phone"];
									$address = $_POST["student_address"];
									$age = $_POST["age"];

									/*echo "<pre>";
                                    var_dump($_POST);
                                    echo "</pre>";*/
									
									
							}
							
							
							?>
							<div class="card-body">
								<form autocomplete="off" class="form" role="form" action="qrgeneration.php" method="post">
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label">Id</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" value="<?php echo $id;?>" name="id">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label">Full Name</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" value="<?php echo $full_name;?>" name="full_name">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label">Course</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" value="<?php echo $course;?>" name="course">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label">Phone Number</label>
										<div class="col-lg-9">
											<input class="form-control" type="number" value="<?php echo $phone;?>" name="phone">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label">Address</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" value="<?php echo $address;?>" name="student_address">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label">Age</label>
										<div class="col-lg-9">
											<input class="form-control" type="number" value="<?php echo $age;?>" name="age">
										</div>
									</div>

									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label"></label>
										<div class="col-lg-4">
											<input class="btn btn-primary" type="submit" name="btnsubmit" value="Generate QR Code">
										</div>
									
										
									</div>
								</form>
								<?php
 									include "phpqrcode/qrlib.php";
 									$PNG_TEMP_DIR = 'temp/';
 									if (!file_exists($PNG_TEMP_DIR))
									    mkdir($PNG_TEMP_DIR);

									$filename = $PNG_TEMP_DIR . 'test.png';

									


									if (isset($_POST["btnsubmit"])) {

									$codeString = $_POST["id"] . "_";
									$codeString .= $_POST["full_name"] . "\n";

									$filename = $PNG_TEMP_DIR . 'test' . md5($codeString) . '.png';

									QRcode::png($codeString, $filename);

									echo '<img src="' . $PNG_TEMP_DIR . basename($filename) . '" /><hr/>';
							
										
								

							
								//Read the QR code image as binary data
								//$qrCodeImage = file_get_contents($filename);

								// Encode the binary data as base64 (optional)
								//$qrCodeImageBase64 = base64_encode($qrCodeImage);
								
								$sql = "INSERT INTO students (id, full_name, course, phone, student_address, age, qrcode) VALUES (?, ?, ?, ?, ?, ?, ?)";

								// Prepare the statement
								$stmt = $conn->prepare($sql);

								if (!$stmt) {
								    die("Error in preparing statement: " . $conn->error);
								}

								// Bind the data to the statement
								$stmt->bind_param("sssssis", $id, $full_name, $course, $phone, $address, $age, $filename);

								// Execute the statement
								if ($stmt->execute()) {
    								// echo "Data inserted into the database successfully.";
								} else {
    								echo "Error: " . $stmt->error;
								}
							
								// Close the statement and database connection
								$stmt->close();
							}

 
								?>
								<script>
									function goBack() {
    									window.location.href = "final.php";
									}
								</script>
								<button onclick="goBack()">Go To Dashboard</button>
							</div>
						</div><!-- /form user info -->
					</div>
				</div>

			</div><!--/col-->
		</div><!--/row-->

	</div><!--/container-->

</body>
</html>