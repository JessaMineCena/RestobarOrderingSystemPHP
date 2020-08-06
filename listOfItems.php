<html>

<?php require 'addons.php'; ?>
<body>

<?php 
//FOR THE NAVIGATION BAR
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

<!-- HEADING AND DESIGN -->
<div id= "fh5co-menus" data-section = "menu">		
		<div class="container">
				<div class="row text-center fh5co-heading">
						<h1 class="heading to-animate">Me'nu</h1>
						<p class="sub-heading to-animate">Satisfying people's hunger for life's simple pleasures. <br> Good food. Good cheer. Good times. </p>
				</div>
		</div>
</div>


	<div class="container">
		<div class ="jumbotron jumbotron-fluid">
			<div class="table-responsive">
			<form method="post" action="previewQuotation.php">
				<center>
					<?php
						session_start();
						
						require 'connectionInclude.php'; //database connection

							//for session id (multiple user)
							$tableNo = $_SESSION['tableNo'];
							$sqlTable = "SELECT * FROM tablelist WHERE tableNo = $tableNo";
							$resultTable = $conn->query($sqlTable);

							//echo "Employee ID: ".$_SESSION['employeeID'] ;

							if($resultTable -> num_rows > 0) {
								
								while ($rowTable = $resultTable->fetch_assoc()) {
								
									if ($rowTable["sessionID"] === '' || $rowTable["sessionID"] === null) { //if table has no currrent session id stored
										
										session_regenerate_id();
										$sessionID = session_id();
										//echo $sessionID;
										echo "<input type = 'hidden' name = 'sessionID' value = '".$sessionID."'></input>";
										
										$sqlInsertTable = "UPDATE tablelist SET sessionID = '$sessionID' WHERE tableNo = $tableNo";
										if ($conn->query($sqlInsertTable) == TRUE) {	
											//do nothing
										}
										else {
											echo "<br>ERROR IN UPDATING SESSION ID TO TABLELIST TABLE";
										}
									}
									else { //if table has a current session id stored
										
										$sessionID = $rowTable["sessionID"];
										echo "<input type = 'hidden' name = 'sessionID' value = '".$sessionID."'></input>";
									}
									
									
								}
								
							}
							
							$sql = "SELECT * FROM Category"; //sql to group by category
							$result = $conn->query($sql);
							$count = 0;
							if($result->num_rows > 0) {
								//output data of each row
								while ($row = $result->fetch_assoc()) {
									$cat = $row["catID"];
									echo "<div class='col-xs-12 col-md-12'><h2>".$row["catName"]."</h2></div>";
									$sql1 = "SELECT * FROM items WHERE catID = $cat"; //sql for items
									$result2 = $conn->query($sql1);
									echo "<div class='row'>";
									if($result2 ->num_rows > 0){
										while ($row2 = $result2->fetch_assoc()) {

												echo "<div class='col-xs-12 col-md-6'><img style='border-radius:15px; margin-top:20px;' width = '300' height= '200' class='image-responsive' src='image/".$row2["itemNo"].".jpg' /><h3>".$row2["name"]."<h5><br>".$row2["description"].". <h4><b><br>Php ".number_format($row2["price"],2)."</b></h4>";
												echo "Qty.: <input style='width:48px;' type='Number' name='".$row2["itemNo"]."' min='1' placeholder ='1' value = '1'> Select:  <input type='checkbox' width='48' height='48' name='itemNo[]' value='".$row2["itemNo"]."'>";
												echo "</div>";
												
										}
									echo "</div>";
									}
									
								}
							} else {
								echo "0 results";
							}


//submit button
							

							$conn->close();
							?>
				</center>
				
				<?php
				echo "<br><center><button type='Submit' class='btn btn-info btn-lg' name='btnSubmit'>Add to Cart</button></center>";
				?>
			</form>
		</div>
		</div>
	</div>


<?php require 'addlast.php';?>
</body>
</html>