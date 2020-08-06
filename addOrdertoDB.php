<html>
<body  style="background-image:url('images/wood_1.png'); background-size:cover;background-repeat:no-repeat;">

<?php 
//FOR NAVIGATION BAR
require 'sideNav.php'; ?>
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
<?php

	include 'addons.php';
	require 'navigation_bar.php';
	session_start();
	require 'connectionInclude.php';
	
	$timeOrder = date("H:i:s");
	$dateOrder = date("Y/m/d");
	$tableNo = $_SESSION['tableNo'];
	$crewNo = $_SESSION['employeeID'];
	$sessionID = $_POST['sessionID'];
	$orderID="";
	$itemnoArray= array();
	$quantityArray = array();
	$priceArray = array();
	
	foreach($_POST['itemNo'] as $itemNo) {
		$itemnoArray[] = $itemNo;
	}
	
	foreach($_POST['qty'] as $quantity) {
		$quantityArray[] = $quantity;
	}
	
	foreach($_POST['price'] as $price) {
		$priceArray[] = $price;
	}
	
	
	//INSERT INTO ORDER
	$sqlOrder = "SELECT * FROM `order` WHERE sessionID = '$sessionID'";
	$resultOrder = $conn->query($sqlOrder);
	if($resultOrder -> num_rows > 0) { //if session no is available already in the order table
		while ($rowOrder = $resultOrder->fetch_assoc()) {
			$orderID = $rowOrder["orderNo"]; //get the order id
			
			//INSERT INTO ORDER DETAILS
			
			//echo ($tableNo . " " . $crewNo . " " . $sessionID . " ");
			
			for($i=0; $i < count($itemnoArray); $i++){
				
				$sqlOrDeRead = "SELECT * FROM `orderdetails` WHERE orderID = $orderID AND itemNo = $itemnoArray[$i]";
				$resultOrDeRead = $conn->query($sqlOrDeRead);
				if($resultOrDeRead -> num_rows > 0) { 
			//	echo "RESULT!";	
					while ($rowOrDeRead = $resultOrDeRead->fetch_assoc()) {
			//		echo "WHILE!";
						$sumQty = $rowOrDeRead["Qty"] + $quantityArray[$i];
						$itemNo = $itemnoArray[$i];
						$orderDetailsID = $rowOrDeRead["orderDetailsID"];
						ECHO $sumQty. " - ".$itemNo." = ".$orderID;
						
						$sqlUpdate = "UPDATE `orderdetails` SET Qty = $sumQty WHERE itemNo = $itemNo";
						if ($conn->query($sqlUpdate) == TRUE) {	
							//do nothing
						}
						else {
							echo "<br>ERROR IN UPDATING QTY ON ORDER DETAILS TABLE";
						} 
					}
				} else {
					$sqlOrde = "INSERT INTO `orderdetails`(orderID, itemNo, Qty, Price,cancelled) VALUES ($orderID, $itemnoArray[$i], $quantityArray[$i], $priceArray[$i], 0)";
					if ($conn->query($sqlOrde) == TRUE)
					{
						//do nothing
					} else {
					echo "ERROR IN INSERTING DATA TO ORDER DETAILS TABLE";
					} 
				}
			} 
		}
	} else {
		
		$sql = "INSERT INTO `order`(tableNo, OrderDate, OrderTime, crewID,posted,sessionID) VALUES ($tableNo,'$dateOrder','$timeOrder',$crewNo,0, '$sessionID')";
		if ($conn->query($sql) === TRUE) 
		{
			//echo "<br>SUCCESSFULLY ADDED TO ORDER TABLE";
			$orderID= $conn->insert_id;
			
			for($i=0; $i < count($itemnoArray); $i++){
			//	echo "<br>".$itemnoArray[$i]." - ".$priceArray[$i]." - ".$quantityArray[$i];
			$sqlOrde = "INSERT INTO `orderdetails`(orderID, itemNo, Qty, Price,cancelled) VALUES ($orderID, $itemnoArray[$i], $quantityArray[$i], $priceArray[$i], 0)";
			if ($conn->query($sqlOrde) === TRUE)
			{
				//do nothing
				
			} else {
				echo "ERROR IN INSERTING DATA TO ORDER DETAILS TABLE";
			} 
			}
			
		} else {
			echo "<br>ERROR IN INSERTING DATA TO ORDER TABLE";
			
			echo count($itemnoArray);
			echo "TIME: ".$timeOrder."<br>DATE: ".$dateOrder;
			echo "table no: ".$tableNo;
			echo "<br>crew no.: ".$crewNo;
			echo "<br>time order: ".$timeOrder;
			echo "<br> date order: ".$dateOrder;
			echo "<br> session id: ".$sessionID;
		}
		
		
	} 
	
	
	//echo "<br>order id: ".$orderID;

	//session_destroy();

	$conn->close();

?>

<div class="container">
				<div class="row text-center fh5co-heading">
						<h1 class="heading to-animate" style="color:white">Order is Placed!</h1>
						<p class="sub-heading to-animate">Satisfying people's hunger for life's simple pleasures. <br> Good food. Good cheer. Good times. </p>
				
				<div id ="button">
					<p class = "sub-heading to-animate" ><a href="index.php"> Back to Home </a> </p>
					<p class = "sub-heading to-animate" ><a href="orderQuotation.php"> Go to Placed Orders </a> </p>
					<?php session_destroy(); ?>
				</div>
				</div>
		</div>

<?php require 'addlast.php'?>
</body>
</html>