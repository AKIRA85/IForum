<?php
	$SQLselect = "SELECT  ";
	$SQLselect .= "ID, value ";	
	$SQLselect .= "FROM ";
	$SQLselect .= "lookUp WHERE type='field'";
	$SQLselect .= "Order By value ";
	
	$fields = mysqli_query($con, $SQLselect);
	
	$fields = mysqli_query($con, $SQLselect);
	$SQLselect = "SELECT  ";
	$SQLselect .= "ID, value ";	
	$SQLselect .= "FROM ";
	$SQLselect .= "lookUp WHERE type='skill'";
	$SQLselect .= "Order By value ";
	
	$skills = mysqli_query($con, $SQLselect);
	
?>
<html>
<body>
		<h6>Filters</h6>
		<div class="dropdown">
		  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" 
		  data-toggle="dropdown" aria-expanded="true">
		    Field
		    <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
		    <li role="presentation"><a role="menuitem" tabindex="-1" href="home.php">All</a></li>
		    <?php
					while($row=mysqli_fetch_assoc($fields)) {
						echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="home.php?field='.
						$row['value'].'">'
								.$row['value'].'</a></li>';
					}
		    ?>
		  </ul>
		</div>
		<div class="dropdown">
		  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" 
		  data-toggle="dropdown" aria-expanded="true">
		    Skills
		    <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
		    <li role="presentation"><a role="menuitem" tabindex="-1" href="home.php">All</a></li>
		    <?php
					while($row=mysqli_fetch_assoc($skills)) {
						echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="home.php?skill='.
						$row['value'].'">'
								.$row['value'].'</a></li>';
					}
		    ?>
		  </ul>
		</div>
		<script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="jquery.min.js"></script>
</body>
</html>