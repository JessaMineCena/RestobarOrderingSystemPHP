<style>
hr.style2 {
	border-top: 3px double #8c8b8b;
}

.topnav {
  overflow: hidden;
  background-color:rgba(0,0,0,0);
  margin-left:42%;
}

.topnav a {
  float:left;
  margin-top:20px;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: orange;
  color: white;
  text-decoration:none;
  border-radius:20px;
}

.active {
  background-color: orange;
  color: black;
  border-radius:20px;
}

.topnav .icon {
  display: none;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
}

img
{
	border-radius:15px;
}
</style>
<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>