<html>
  <?php require 'addons.php'; ?>

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
						<h2 class="heading to-animate">Ordered Dishes</h2>
					</div>
				</div>
		</div>

	<div class="container">
		<div class ="jumbotron jumbotron-fluid">
		<div class = "table-responsive">
			<center>
			<table class = "table table-borderless">
			
			<?php
			
			require 'connectionInclude.php';
			
			$orderNo = $_POST['orderSelect'];
			$dateToday = date("Y/m/d");
			$itemNo;
			$count = 0;
			$itemPrice;
			$grandTotal = 0;
			
			//echo $orderNo;
			$sql = "SELECT * FROM orderdetails WHERE orderID = $orderNo";
			$result = $conn->query($sql);
			
			$sqlTable = "SELECT tableNo FROM `order` WHERE orderNo = $orderNo AND OrderDate = '$dateToday'";
					$resultTable = $conn->query($sqlTable);
					if ($resultTable->num_rows>0)
					{
						while ($rowTable = $resultTable->fetch_assoc())
						{
							echo "<h2> Table No: Table ".$rowTable["tableNo"]."</h2>";
							break;
						}
					}
			
			echo "<th><h4 style='text-align:center'><b> Item Name </h4></th><th><h4 style='text-align:center'><b> Quantity </h4></th><th><h4 style='text-align:right'><b> Price </h4></th><th><h4 style='text-align:right'><b> Subtotal </h4></th>";
			echo "<tr></tr>";
				
			if ($result -> num_rows > 0)
			{
				while ($row = $result->fetch_assoc())
				{
					$itemNo = $row["itemNo"];
					
					$sqlItem = "SELECT * FROM items WHERE itemNo = $itemNo";
					$resultItem = $conn->query($sqlItem);
					
					if ($resultItem->num_rows>0)
					{
						while($rowItem = $resultItem->fetch_assoc())
						{
						
							echo "<td><center><p>".$rowItem["name"]."</p></td>";
							echo "<td><center><p>".$row["Qty"]."</p></td>";
							echo "<td><p style='text-align:right'>".number_format($rowItem["price"],2)."</p></td>";
							echo "<td><p style='text-align:right'>".number_format($rowItem["price"] * $row["Qty"],2)."</p></td>";
							echo "<tr></tr>";
							if ($count < 2) 
							{
								//ECHO $row["ProductName"];
								
								
							//	echo "<td><br> <img width = '300' height = '200' src='image/".$rowItem["itemNo"].".jpg' /><h3>".$rowItem["name"]."</h3><br>".$rowItem["description"]."<br>Php ".number_format($rowItem["price"],2);
							//	echo "<br>Qty.: ".$row["Qty"]." serving(s)</td>";
								$count = $count + 1;
								$itemPrice = $rowItem["price"];
							} else {
						//	echo "<tr></tr>";
						//	echo "<td><br> <img width = '300' height = '200' src='image/".$rowItem["itemNo"].".jpg' /><h3>".$rowItem["name"]."</h3><br>".$rowItem["description"]."<br>Php ".number_format($rowItem["price"],2);
						//	echo "<br>Qty.: ".$row["Qty"]." serving(s)</td>";
							$count = 1;
							$itemPrice = $rowItem["price"];
							}
						}
						//$count = 0;
					}
					
					
					
					$grandTotal = $grandTotal + ($itemPrice * $row["Qty"]);
					
				}
			}
			
			echo "<td colspan = '3'><p style='text-align:right'><b> Grand Total: </td> <td><p style='text-align:right'><b>".number_format($grandTotal,2)."</td>";
			
			$conn->close();
			?>
			
			</table>
			<button onclick="goBack()" class="btn btn-warning">Go Back</button>
		</div>
	</div>
	</div>
</div>
<?php require 'addlast.php'; ?>
<script>
function goBack() {
    window.history.back();
}
</script>

</body>
</html>