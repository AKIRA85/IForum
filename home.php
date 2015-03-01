<?php
{	
	$host ="localhost";
	$user="root";
	$pass="";
	$db="IDEAS";
	$con=mysqli_connect('localhost','root','','IDEAS');
	$x=mysqli_select_db($con,$db);
	if($con)
		echo "SUCCESS.";
	else
		echo "FAILURE.";
}
{	session_start();
	if(isset($_SESSION['username']))
	{
		$allow=true;
		$user = $_SESSION['username'];
		echo "Logged in.";
	}
	else
	{
		echo "Not logged in.";
		exit;
	}
	$menu="menu.php";
	if(isset($_GET["content"]))
		$content=$_GET["content"];
	else
		$content="display.php";
}
?>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/layout.css" type="text/css" />
	
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<ul class="nav navbar-nav navbar-right" >
			<li><a href="home.php">Home</a></li>         
         <li><a href="home.php?content=postNews.php">Post Idea</a></li>
         <li><a href="index.php?status=logout">Logout</a></li>
      </ul>
	</nav>
		<div id="outerWrapper" >
			
    		<div id="innerWrapper">
    		
      		<div id="menuColumn">		
      		<?php	
      			if(file_exists($menu)) {		
      				include_once($menu); 
      			}else {
      				echo $menu.' File not found';
      				
      			}
      		?>
		      </div><!-- end menuColumn -->

      		<div id="contentColumn">
      			<?php 			
      			if(file_exists($content)) {		
      				include_once($content); 
      			}else {
      				echo $content.'File not found';
      			}
      			?>
      		</div><!-- end contentColumn -->
      		
    		</div><!-- end innerWrapper -->
    
  </div><!-- end outerWrapper -->
  <script src="bootstrap/js/bootstrap.js"></script>
  <script src="jquery.min.js"></script>
</body>
</html>