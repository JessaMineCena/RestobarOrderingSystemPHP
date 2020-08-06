<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle">
</a>


<?php include 'accessDesign.php';?>
<!-- #include file = accessDesign.asp -->
</head>
<?php include 'addons.php';?>
<!--#include file=addons.asp-->

<?php

$usernameErr = $passwordErr = "";
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["username"])) {
		$usernameErr = "User Name is required";
		$username = "";
	} else { 
		$username = test_input($_POST["username"]); 
	}
  
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
						<p class="sub-heading to-animate">To view placed orders, please let the crew input the access code. Thank you!
						<br><button type="button" class="button" data-toggle="modal" data-target="#myModal" color = #FFA500 >Input <?php $password = ""; $username = ""; ?> </button>
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
			<label for="uname"><b>Username</b></label>
			  <input type="text" placeholder="Enter Username" name="username" value="<?php echo $username;?>" required>
			  <span class="error"> <?php echo $usernameErr;?></span>
			  <label for="psw"><b>Password</b></label>
			  <input type="password" placeholder="Enter Password" name="password" value="<?php echo $password;?>" required>
			  <span class="error"> <?php echo $passwordErr;?></span>
			  <button type="submit" action>Submit </button>
			</div>
		  </div>
		</div>

	  </div>
	</div>
	
<?php 

session_start();
require 'connectionInclude.php';

function alert(){
	?>
	<script type = "text/javascript">
	alert('Error in logging in!');
	</script>
	<?php
}

if($usernameErr == null && $passwordlErr == null){
	$sql = "SELECT * FROM employee";
	$result = $conn->query($sql);
			
		if($result ->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
			
			//	echo $row['username']." - input: ".$
			
				if ( $row['username'] == $_POST['username'] && $row['accessCode'] == $_POST['password']) {
					$_SESSION['employeeID'] = $row['empID'];
					?>
					
					<script type="text/javascript">
						window.location = "orderQuotation.php";
					</script>
					<?php
					break 2;
				} 
				
				
			}
		}
		
		$username = "";
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


</form>
</body>
</html>
