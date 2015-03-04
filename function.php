<?php
	
	// builds Drop Down from lookUp table
	function dropDown($type) {
		global $con;
		$SQLselect = "SELECT  ";
		$SQLselect .= "ID, value ";	
		$SQLselect .= "FROM ";
		$SQLselect .= "lookUp WHERE type='$type'";
		
		$result = mysqli_query($con, $SQLselect);
	
	echo '<select class="'.$type.'"name="'.$type.'[]">';
	echo '<option value="" selected="selected">..select..</option>';
	  		while($row = mysqli_fetch_assoc($result)) {
	  			echo '<option value="'.$row['value'].'">'.$row['value'].'</option>';	
			}
	echo'</select>';
	}
	
	//show Requests by post_id or owner
	function showRequests($PostID="" ,$owner="" )
	{
		$disabled = '';
		global $con;
		if($PostID!=""){
			$getRequests = "SELECT requestedBy , status, time, requestID FROM requests 
								WHERE PostID='".$PostID."'";	
		}
		else if($owner!=""){
			$getRequests = "SELECT posts.Title , status, requests.time, requests.PostID, requestID FROM requests 
								INNER JOIN posts ON requests.PostID=posts.PostID WHERE requestedBy='".$owner."'";
			$disabled = 'disabled="true"';
		}
		$req = mysqli_query($con, $getRequests);
		echo '<table border="1">
				<tr>';
		if($owner=="") {
			echo '<th>Request By</th>';			
		}else {
			echo '<th>Project</th>';			
		}		
		echo '<th>time</th>
					<th>status</th>
				</tr>';			
		while($row=mysqli_fetch_assoc($req)) {
			echo '<tr>';
			if($owner==""){
				echo '<td>'.$row['requestedBy'].'</td>';					
			}else {
				echo '<td><a href="home.php?postid='.$row['PostID'].'">'.$row['Title'].'</td>';					
			}
			echo '<td class="timeago"  title="'.$row['time'].'">'.$row['time'].'</td>';
			if($row['status']=="pending" ) {
				echo '<td>
					<button class="status" value="'.$row['requestID'].'" '.$disabled.'>
					Pending
					</button>
				</td>';
			}else {
				echo '<td><button disabled="true">Accepted</button></td>';
			}
			echo '</tr>';
		}
		echo '</table>
		<hr>';
	}
	// show details of a post	
	function showPostDetails($id) {
		global $con;
		$selectQuery = "SELECT * FROM posts WHERE PostId=$id";
		$posts = mysqli_query($con, $selectQuery);
		$row = mysqli_fetch_assoc($posts);
			echo '<table>
				<tr>
					<td style="text-align:right">Subject :&nbsp</td>
					<td>'.$row['Title'].'</td>
				</tr>
				<tr>
					<td style="text-align:right">Posted By :&nbsp</td>
					<td>'.$row['Username'].'</td>
				</tr>
				<tr>
					<td style="text-align:right">Time :&nbsp</td>
					<td class="timeago">'.$row['time'].'</td>
				</tr>
				<tr>
					<td style="text-align:right">Field :&nbsp</td>
					<td>';
		$array = unserialize($row['fields']);
		foreach($array as $field){
			echo '<div style="width=100%">'.$field.'</div>';
		}	
		echo '</td>
				</tr>		
				<tr>
					<td style="text-align:right">Skills :&nbsp</td>
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
				</table>';
		$req = "SELECT status FROM requests WHERE PostId='$id' AND requestedBy='".$_SESSION['username']."'";
		$result = mysqli_query($con,$req);
		$num = mysqli_num_rows($result);
		if($num==0) {
			echo '<button class="join" value="'.$id.'">Join Request</button>';
		}else {
			$row2 = mysqli_fetch_assoc($result);
			if($row2['status']=="pending") {
				echo 'Request Status : <button disabled="true">Pending</button>';		
			}else {
				echo 'Request Status : <button disabled="true">Accepted</button>';
			}
		}
		echo '
				<hr id="afterResponse">';
			echo '<h4>Description</h4>';
			echo nl2br($row['Body']);	
	}
	//
	function showPosts($array) {
		global $user, $con;
		$condition = "";
		if(isset($array['field'])) {
			$condition = " AND fields LIKE '%".$_GET['field']."%'";		
		}else if(isset($array['skill'])) {
			$condition = " AND skills LIKE '%".$_GET['skill']."%'";		
		}
		$sign = "!";  //used in sql select query
		$urlSign = "?"; // used in url for link to detailed view
		if(isset($array['get'])) {
			$sign = "";
			$urlSign = "&";
		}
		$selectQuery ="SELECT PostId, Username, Title, time , min, max FROM posts WHERE Username"
		              .$sign."='$user'".$condition." ORDER BY time ASC";
		$posts = mysqli_query($con, $selectQuery);
		echo '<table border="1">
				<tr>';
		if(!isset($array['get'])) {
			echo '<th>Posted By</th>';
		}
			echo '<th>Subject</th>
					<th>Time</th>
					<th>Min Members</th>
					<th>Max Members</th>
					<th>Join Requests<th>
				</tr>';
		while($row = mysqli_fetch_assoc($posts)) {
			$select = "SELECT requestID FROM requests WHERE PostID='".$row['PostId']."'";
			$req = mysqli_query($con, $select);
			$num = mysqli_num_rows($req);
			$urlArray = explode("/", $_SERVER['REQUEST_URI']);
			$lastIndex = count($urlArray)-1;
			$url = $urlArray[$lastIndex];
			
			if(!isset($array['get'])) {
				echo '<tr>
					<td>'.$row['Username'].'</td>';
			}
			echo '<td><a href="'.$url.$urlSign.'postid='.$row['PostId'].'">'.$row['Title'].'</a>
					</td>
					<td class="timeago" title="'.$row['time'].'">'.$row['time'].'</td>
					<td style="text-align:center">'.$row['min'].'</td>
					<td style="text-align:center">'.$row['max'].'</td>
		         <td style="text-align:center">'.$num.'</td>
					</tr>';
				;
		}
		echo '</table>';
	}
?>