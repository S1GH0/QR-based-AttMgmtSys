<?php
require_once 'connect.php';
require_once 'phpqrcode/qrlib.php';
$path = 'images/';
$qrcode = $path.time().".png";
$qrimage = time().".png";

if(isset($_REQUEST['sbt-btn']))
{
$qrtext = $_REQUEST[$codeString];

//make sql query for existing record
// $today=date("Y-m-d");
// $sql="SELECT * FROM attendance WHERE qrtext=$qrtext and time_in=$today"

//try to find the data with existing record
//if not found then 
$query = mysqli_query($connection,"insert into qrcode set qrtext='$qrtext', qrimage='$qrimage'");
	if($query)
	{
		?>
		<script>
			alert("Data save successfully");
		</script>
		<?php
	}
}

QRcode :: png($qrtext, $qrcode, 'H', 4, 4);
echo "<img src='".$qrcode."'>";
?>