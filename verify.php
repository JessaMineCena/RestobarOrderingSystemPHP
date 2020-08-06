<!-- WALA PA NAHUMAN -->
<?php

require 'connectionInclude.php';
$usernameErr = $passwordErr = "";
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["username"])) {
		$usernameErr = "User Name is required";
	} else { 
		$username = test_input($_POST["username"]); 
	}
  
	if (empty($_POST["password"])) {
		$passwordErr = "Password is required";
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





if(isset($_POST['submit'])){
	$sql = "SELECT * FROM employee";
	$result = $conn->query($sql);
			
		if($result ->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
			
			//	echo $row['username']." - input: ".$
			
				if ( $row['username'] == $_POST['username'] && $row['accessCode'] == $_POST['password']) {
					ECHO $row['username'];
					ECHO "<BR>-".$_POST['username'];
					?>
					
					<?php
					break 2;
				} else {
				?> 

				<?php
				}
			}
		}
}
	
	

$conn->close(); 

?>