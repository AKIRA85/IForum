<?php
/*
*	File:			company/oldPosts.php
*
*	Display old Posts 
*
*
*=====================================
*/
{
	$condition = "";
	if(isset($_GET['value'])) {
		$id = $_GET['value'];
		$selectQuery = "SELECT * FROM posts WHERE PostId=$id";
	}else {
		if(isset($_GET['field'])) {
			$condition = "WHERE fields LIKE '%".$_GET['field']."%'";		
		}else if(isset($_GET['skill'])) {
			$condition = "WHERE skills LIKE '%".$_GET['skill']."%'";		
		}
		$selectQuery ="SELECT PostId, Username, Title, time FROM posts "
								.$condition." ORDER BY time ASC";			
	}
	$posts = mysqli_query($con, $selectQuery);
}
?>
<html>
<head>

	<!-- HTML Headers and Links to CSS -->

</head>
<body>

	<h2 style="font-family: arial, helvetica, sans-serif;" >
				Projects
			</h2>
	<?php 
		if(isset($_GET['value'])){
			$row = mysqli_fetch_assoc($posts);
			echo '<table>
				<tr>
					<td>Subject :&nbsp</td>
					<td>'.$row['Title'].'</td>
				</tr>
				<tr>
					<td>Time : </td>
					<td>'.$row['time'].'</td>
				</tr>
				<tr>
					<td>Field : </td>
					<td>';
		$array = unserialize($row['fields']);
		foreach($array as $field){
			echo '<div style="width=100%">'.$field.'</div>';
		}	
		echo '</td>
				</tr>		
				<tr>
					<td>Skills :</td>
					<td>';
		$array = unserialize($row['skills']);
		foreach($array as $field){
			echo '<div style="width=100%">'.$field.'</div>';
		}		
		echo '</td>
				</tr>
				<tr>
					<td colspan="2">Team members required</td>				
				</tr>
				<tr>
					<td>Min : '.$row['min'].'</td>						
					<td>Max : '.$row['max'].'</td>						
					</tr>
				</table>
				<hr>';
			echo nl2br($row['Body']);		
			exit;
		}
		echo '<table border="1">
				<tr>
					<th>Posted By</th>
					<th>Subject</th>
					<th>Time</th>
				</tr>';
		while($row = mysqli_fetch_assoc($posts)) {
			echo '<tr>
					<td>'.$row['Username'].'</td>
					<td>
					<a href="home.php?content=display.php&value='.$row['PostId'].'">'.$row['Title'].'</a>
					</td>
					<td>'.$row['time'].'</td>
				</tr>';
		}
		echo '</table>';
	?>

</body>
</html>
