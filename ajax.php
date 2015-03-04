<?
{	//connect to db
	$host ="localhost";
	$user="root";
	$pass="";
	$db="IDEAS";
	$con=mysqli_connect('localhost','root','','IDEAS');
	$x=mysqli_select_db($con,$db);
	if($con)
		$dbsuccess = true;
	else
		echo "FAILED to connect to db.";
}
if($dbsuccess)
{
	if(isset($_POST['requestID'])) {
		$update = "UPDATE requests SET status='accepted'WHERE requestID='".$_POST['requestID']."'";
		if(mysqli_query($con, $update)){
			echo "success";
		}else {
			echo "failure $update"; 
		}
	}else if(isset($_POST['postID'])) {
		//send request and display corresponding message
		session_start();
		$requestID = $_POST['postID'].$_POST['postID'].$_SESSION['userID'];
		$insert = "INSERT INTO requests ( requestID, PostID, requestedBy, status) VALUES ";
		$insert .= "( '".$requestID."', '".$_POST['postID']."', '".$_SESSION['username']."', 'pending' )";
		if(mysqli_query($con, $insert)){
			echo '<div class="alert alert-success alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  						<span aria-hidden="true">&times;</span></button>
  						<strong>Request Sent</strong> 
				</div>';				
		}else {
				echo '<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>Failed to send request.</div>';
			}			
	}
}

?>