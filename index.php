<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php 
session_start();
include 'accessDesign.php';?>
<!-- #include file = accessDesign.asp -->
</head>
<?php include 'addons.php';?>
<!--#include file=addons.asp-->

<?php

$_SESSION['employeeID'] =  1;
//echo $_SESSION['employeeID'];

$passwordErr = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["password"])) {
		$passwordErr = "Password is required";
		$password = "";
	} else { 
		$password = test_input($_POST["password"]); 
	} 
}  

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>

<body  style="background-image:url('images/wood_1.png'); background-size:cover;background-repeat:no-repeat;"> 

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


	<div id="fh5co-featured" data-section="features">
		<div class="container">
				<div class="row text-center fh5co-heading row-padded">
					<div class="col-md-8 col-md-offset-2">
						<h2 class="heading to-animate">Please Input Access Code</h2>
						<p class="sub-heading to-animate">To start choosing orders, please let the crew input the access code. Thank you!
						<br><button type="button" class="button" data-toggle="modal" data-target="#myModal" color = #FFA500 >Input <?php $password = ""; ?> </button>
						</p>
					</div>
				</div>
		</div>

	
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		<!-- Modal content-->
		
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			<h4 class="modal-title">Input Access Code</h4>
		  </div>
		  <div class="modal-body">
			  <input type="password" placeholder="Enter Password" name="password" value="<?php echo $password;?>" required>
			  <span class="error"> <?php echo $passwordErr;?></span>
			  <button type="submit" action>Submit </button>
			</div>
		  </div>
		</div>

	  </div>
	</div>
	</form>
<?php 


require 'connectionInclude.php';

function alert(){
	?>
	<script type = "text/javascript">
	alert('Error in logging in!');
	</script>
	<?php
}

if($passwordlErr == null){
	$sql = "SELECT * FROM employee";
	$result = $conn->query($sql);
			
		if($result ->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
			//ECHO "NIABOT DIRI FIRST!";
			
			//	echo $row['username']." - input: ".$
			
				if ($row['accessCode'] == $_POST['password']) {
					//echo "NIABOT DIRI SECOND";
					$_SESSION['employeeID'] = $row['empID']; 
					if(!empty($_SESSION['employeeID']))
					{
						echo "Employee ID". $_SESSION['employeeID'];
						$_SESSION['employeeID'] = $row['empID']; 
						$_SESSION['table'] = $row['empID'];
						?>
					
						<script type="text/javascript">
							window.location = "selectTable.php";
						</script>
						<?php
					}
					else
					{
						echo "Session not set yet.";
					}
					
					break 2;
				} 
				
				
			}
		}
		
		$password = "";
}
	
	

$conn->close(); 
?>

<?php require 'addlast.php';?>
<!--#include file=addlast.asp-->
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>



</body>
</html>
