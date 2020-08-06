<html>
<?php require 'addons.php';?>
<body style="background-image:url('images/wood_1.png'); background-size:cover;background-repeat:no-repeat;">

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

	<div id="fh5co-featured" data-section="features">

	<div class="container">
		<div class ="jumbotron jumbotron-fluid">
		<div class = "table-responsive">
			<center>

<form method="POST" action="addOrdertoDB.php">
<?php
	
	session_start();
	require 'connectionInclude.php';
	$grandTotal;
	$itemPrice;
	$count = 0;
	$sessionID = $_POST['sessionID'];
	
	/*NOTES
		to identify quantity of each product selected,
		the name of the input type of the quantity the the Product No.
		
		discount is set to 0 sa query.
		
		to check in the database the added order details, use query builder.
		(dili makita man gud sa kadaghan :3)
	*/
	
	//echo "<h2>Session ID:".$_POST['sessionID']."</h2>";
	echo "<h2> Table No: Table ".$_SESSION['tableNo']."</h2>";
	//echo "<h2> Crew No: ".$_SESSION['employeeID']."</h2>";
	
	foreach($_POST['itemNo'] as $selected) {
		
		//echo "<br>".$selected; for debugging purpose
		
		echo "<input type ='hidden' name='itemNo[]' value='".$selected."'/>";
		echo "<input type ='hidden' name='qty[]' value='".$_POST[$selected]."'/>";
		
		$sql1 = "SELECT * FROM items WHERE itemNo = $selected";
		$result2 = $conn->query($sql1);
		
		
		if ($result2 ->num_rows >0)
		{
						echo "<center>";
			echo "<div class='row'>";
			while ($row2 = $result2->fetch_assoc()) {
				echo "<div class='col-xs-12 col-md-6'><img style='border-radius:15px; margin-top:20px;' width = '300' height= '200' class='image-responsive' src='image/".$row2["itemNo"].".jpg' /> <h3>".$row2["name"]."</h3>".$row2["description"]."<br> <b>Php ".number_format($row2["price"] * $_POST[$selected],2)."</b>";
				echo "<br>Qty: ".$_POST[$selected]." serving(s) <input type= 'hidden' name='price[]' value='".$row2["price"]."'/>";
				echo "</div>";
				$itemPrice = $row2["price"];
			}
			echo "</div>";
		}
		
		//grand Total
		$grandTotal = $grandTotal + ($itemPrice * $_POST[$selected]);
		
		
	}
	
	echo "<input type = 'hidden' name = 'sessionID' value = '".$_POST['sessionID']."'></input>";
	echo "<h2> Grand Total: Php ".number_format($grandTotal,2)."</h2>";
		
?>
</table>
<center>
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Place Order</button>
<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">PLACE ORDER</h4>
		  </div>
		  <div class="modal-body">
			<p>Do you want to place your order?</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<input type='Submit' class='btn btn-outline-success' value='PlaceOrder'>
		  </div>
		</div>

	  </div>
	</div>
</form>
<button onclick="javascript:history.go(-1)" class="btn btn-warning">Go Back</button>


</div>
</div>	
</div>

<?php require 'addlast.php'; ?>
</body>
</html>