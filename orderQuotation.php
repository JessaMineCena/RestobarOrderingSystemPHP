<html>
  <?php require 'addons.php';?>

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
						<h1 class="heading to-animate">Order Quotations</h1>
				</div>
		</div>
	
	<form method="post" action="orderDetails.php">
	<div class="container">
		<div class ="jumbotron jumbotron-fluid">
		<div class = "table-responsive">
			<center>
			<table class = "table table-borderless">
			
			<?php
				require 'connectionInclude.php';
				$grandTotal = 0;
				$orderID  = 0;
				
				$sql = "SELECT * FROM `order` WHERE posted = 0";
				$result = $conn->query($sql);
				
				echo "<th><h4 style='text-align:left'><b> Table No. </h4></th><th><h4 style='text-align:right'><b>  Grand Total </h4></th> <th><h4 style='text-align:center'><b> Details </h4></th>";
				echo "<tr></tr>";
				
				if ($result->num_rows > 0)
				{
					while ($row = $result->fetch_assoc())
					{	
						echo "<td><p style='text-align:left'> Table ".$row["tableNo"]." </p></td>";
						$orderID =  $row["orderNo"];
						$sqlOrDe = "SELECT * FROM `orderdetails` WHERE orderID = $orderID";
						$resultOrDe = $conn->query($sqlOrDe);
						
						if ($resultOrDe -> num_rows > 0){
							while ($rowOrDe = $resultOrDe -> fetch_assoc()) {
								$grandTotal = $grandTotal + ($rowOrDe["Qty"] * $rowOrDe["Price"]);
							}
						}
						
						echo "<td><p style='text-align:right'> ".number_format($grandTotal,2)."</p></td>";
						$grandTotal = 0;
						echo "<td><center><button type = 'submit' class='btn btn-primary btn-lg' name ='orderSelect' value='".$row["orderNo"]."'> view details </button></center></td>";
						echo "<tr></tr>";
					}
				} else 
				{
					echo "<center><h2>Oops! No order unposted! </h2> </center>";
				}
				
				$conn->close();
			?>
			</table>
		</div>
	</div>
</div>
</form>
<?php require 'addlast.php' ?>