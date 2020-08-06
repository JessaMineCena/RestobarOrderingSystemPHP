<html>
<?php include 'accessDesign.php';?>
<!-- #include file = accessDesign.asp -->
</head>
<?php include 'addons.php';?>
<!--#include file=addons.asp-->

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


<div id="fh5co-contact" data-section="AbouttheCreator">
			<div class="container">
				<div class="row text-center fh5co-heading row-padded">
					<div class="col-md-8 col-md-offset-2">
						<h2 class="heading to-animate">About the Creator</h2>
						<p class="sub-heading to-animate">Restaurant E-Menu: Ordering System</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 to-animate-2">
						<h3>Info</h3>
						<ul class="fh5co-contact-info">
						<li class="fh5co-contact-address ">
								<i class="icon-home"></i>
								Jessamine Joy S. Cena <br>
								Ruel C. Wenceslao II <br>
								Arriane May A. de los Santos <br>
							</li>
							<li class="fh5co-contact-address ">
								<i class="icon-home"></i>
								Bachelor of Science in Information Technology Student - 4th Year
							</li>
							<li class="fh5co-contact-address ">
								<i class="icon-home"></i>
								Central Mindanao University
							</li>
							
						</ul>
				</div>
			</div>
		</div>

		
	</div>
	

<?php require 'addlast.php';?>
</html>