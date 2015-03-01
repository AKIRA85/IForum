<?php
	
	function dropDown($type, $con) {
		$SQLselect = "SELECT  ";
		$SQLselect .= "ID, value ";	
		$SQLselect .= "FROM ";
		$SQLselect .= "lookUp WHERE type='$type'";
		$SQLselect .= "Order By value ";
		
		$result = mysqli_query($con, $SQLselect);
	
	echo '<select class="'.$type.'"name="'.$type.'[]">';
	echo '<option value="" selected="selected">..select..</option>';
	  		while($row = mysqli_fetch_assoc($result)) {
	  			echo '<option value="'.$row['value'].'">'.$row['value'].'</option>';	
			}
	echo'</select>';
	}

?>