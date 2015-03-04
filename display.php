<?php
/*
*	File:			company/oldPosts.php
*
*	Display old Posts 
*
*
*=====================================
*/
?>
<html>
<body>

	<?php
	/*	if(isset($_GET['value'])){
			// detailed view of a post
			if(isset($_GET['get'])) {
				// Displays requests to Post owner
				echo '<h4>Requests</h4>';
				showRequests($_GET['value'],"");
			}
			showPostDetails($_GET['value']);
		}else if(isset($_GET['display']) && $_GET['display']=="myrequests"){
			echo '<h3>My Requests</h3>';
			showRequests("",$user);
		}
		else {
			showPosts($_GET);
		}*/
		if(isset($_GET['postid']) && isset($_GET['get'])) {
			echo '<h4>Requests</h4>';
			showRequests($_GET['postid'],"");
			showPostDetails($_GET['postid']);
		}else if(isset($_GET['postid']) && !isset($_GET['get'])) {
			showPostDetails($_GET['postid']);
		}else if(isset($_GET['display']) && $_GET['display']=="myrequests"){
			echo '<h3>My Requests</h3>';
			showRequests("",$user);
		}else if(isset($_GET['get'])) {
			echo '<h3>My Projects</h3>';
			showPosts($_GET);
		}else {
			echo '<h3>Projects</h3>';
			showPosts($_GET);
		}
	?>	
	<script type="text/javascript">
		$(document).ready(function () {
			$(".timeago").timeago();
		});
	</script>
</body>
</html>
