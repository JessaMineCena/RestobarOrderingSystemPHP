<html>

<?php

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

?>

<fieldset>	
<legend><h2>Enter Access Code</h2></legend>
<p><span class="error">* required field</span></p>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">  

	Username:
	<input type="text" name="username" value="<?php echo $username;?>">
	<span class="error">* <?php echo $usernameErr;?></span>
	<br><br>
	
	Password
	<input type="text" name="password" value="<?php echo $password;?>">
	<span class="error">* <?php echo $passwordErr;?></span>
	<br><br>
	<input type="submit" name="submit" value="Submit" onclick="msg()"/>
	
	</fieldset>  
</form>

<?php 


require 'connectionInclude.php';

if(isset($_POST['submit'])){
	$sql = "SELECT * FROM employee";
	$result = $conn->query($sql);
			
		if($result ->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
			
			//	echo $row['username']." - input: ".$
			
				if ( $row['username'] == $_POST['username'] && $row['accessCode'] == $_POST['password']) {
					echo "LOGIN!";
					break 2;
				}
			}
		}
}
	
	

$conn->close(); 
?>

</html>