<html>

<?php 
session_start();
require 'addons.php';


if(!empty($_SESSION['employeeID']))
{
    //echo $_SESSION['employeeID'];
}
else
{
    echo "Session not set yet.";
}
?>
	
<body>

<?php require 'sideNav.php'; ?>
<div id="main">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>

<div id= "fh5co-menus" data-section = "menu">		
		<div class="container">
				<div class="row text-center fh5co-heading">
						<h1 class="heading to-animate">Me'nu</h1>
						<p class="sub-heading to-animate">Satisfying people's hunger for life's simple pleasures. <br> Good food. Good cheer. Good times. </p>
				</div>
		</div>
	<div class="container">
	<div class ="jumbotron jumbotron-fluid">
	<div class = "table-responsive">
	
<?php 


	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["tableselect"])) {
			//some code here for warning
		}
		else {
			$_SESSION['tableNo'] = $_POST['tableselect'];
			?>
			<script type="text/javascript">
				window.location = "listOfItems.php";
			</script>
			<?php
		}
	}
?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table class = "table table-borderless" align = "center">


<?php



require 'connectionInclude.php';
$dateToday = date("Y/m/d");

//echo "Connected successfully". "<br>";

$sql = "SELECT * FROM tableList";
$result = $conn->query($sql);

if($result->num_rows > 0) {
	//output data of each row
	while ($row = $result->fetch_assoc()) {
	
		$tableNo = $row['tableNo'];
		$sql1 = "SELECT `order`.tableNo, `order`.OrderDate, `order`.posted FROM `order`
				WHERE `order`.posted = 0 AND 
				`order`.tableNo = $tableNo";	
		$result2 = $conn->query($sql1);
		//echo "HELLOOOO";
		if($result2 ->num_rows > 0){
			while ($row2 = $result2->fetch_assoc()) {
				//echo "HELLOOOO!".$row2['tableNo'];
				if ($row['tableNo'] === $row2['tableNo'])
				{
					//echo "<p>";
					//echo "<td><center> <button type = 'Submit' class='btn btn-primary btn-lg'name= 'tableselect' value = '". $tableNo ."' disabled> Table ". $tableNo ." </button></center>";
					//echo "<center>". $row['tableDescription'] ."</td> </center>";
					//echo "<p></p>";
					$useTable = $row2['tableNo'];
				}
				
				if ($row2['tableNo'] != $tableNo)
				{
					echo $tableNo. " <> ". $row2['tableNo'];
				}
			}
		}
		
		if ($useTable != $tableNo) 
		{
			echo "<p>";
			echo "<td><center> <button type = 'Submit' class='btn btn-primary btn-lg'name= 'tableselect' value = '". $tableNo ."'> Table ". $tableNo ." </button></center>";
			echo "<center>". $row['tableDescription'] ."</td> </center>";
			echo "<p></p>";
		}
		
		echo "<tr></tr></p>";
	}
} else {
	echo "0 results";
}


echo "</table></form>";

$conn->close();
?>
</div>
</div>
</div>
<?php require 'addlast.php'; ?>

</body>
</html>