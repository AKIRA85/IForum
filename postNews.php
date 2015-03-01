
<?php
/*

*	File:			postNews.php
*
*=====================================
*/

	include('function.php');
	if(isset($_POST["save"])) {
		{  //   collect the data with $_POST
			$subject = $_POST["subject"];	
			$text = $_POST["text"];	
			$field = serialize($_POST["field"]);
			$min = $_POST["min"];
			$max = $_POST["max"];
			$skill = serialize($_POST["skill"]);
				
		}
			
		{  //   SQL:     $tCompany_SQLinsert	
		
			$SQLinsert = "INSERT INTO posts (";			
			$SQLinsert .=  "Username, ";
			$SQLinsert .=  "Body, ";
			$SQLinsert .=  "Title, ";
			$SQLinsert .=  "min, ";
			$SQLinsert .=  "max, ";
			$SQLinsert .=  "skills, ";
			$SQLinsert .=  "field ";
			$SQLinsert .=  ") ";
			$SQLinsert .=  "VALUES (";
			$SQLinsert .=  "'".$user."', ";
			$SQLinsert .=  "'".$text."', ";
			$SQLinsert .=  "'".$subject."', ";
			$SQLinsert .=  "'".$min."', ";
			$SQLinsert .=  "'".$max."', ";
			$SQLinsert .=  "'".$skill."', ";
			$SQLinsert .=  "'".$field."' ";
			$SQLinsert .=  ") ";
		}
		
		{	//		check the data and process it 
			
			if (empty($user) || empty($field) || empty($subject)) {
				echo '<span style="color:red; ">Failed to make qeqwepost.</span><br /><br />'; 
			} else {
					if (mysqli_query($con, $SQLinsert))  {	
						echo 'Successfully Posted.<br /><br />';
					} else {
						echo '<span style="color:red; ">FAILED to mnake POST.</span><br /><br />';
						echo $SQLinsert."<br>";
						echo mysqli_errno($con);
					}	
			}
		}

	}

?>
<html>
        <h2 style="font-family: arial" >
				New Post
			</h2>

	<br /> 
	<form name="postCompany" action="home.php?content=postNews.php" method="post">
				<table border="1">
					<tr>
						<td>Subject :</td>
						<td class="input" colspan="3"><input type="text" name="subject" size="60"/></td>
					</tr>
					<tr id="field">
					<td>Field :</td>
					<td style="width:300px">
					<?php
						dropDown("field", $con);
					?>
					</tr>
					<tr>
						<td></td>
						<td>
							<button form="" class="add" id="field+">+</button>
							<button form="" class="add" id="field-">-</button>
						</td>					
					</tr>
					<td>Skill :</td>
					<td style="width:300px">
					<?php
						dropDown("skill", $con);		
					?>
					</tr>
					<tr>
						<td></td>
						<td>
							<button form="" class="add" id="skill+">+</button>
							<button form="" class="add" id="skill-">-</button>
						</td>						
					</tr>
					<tr>
						<td colspan="2">Team members required</td>				
					</tr>
					<tr>
					<td>Min :</td>
					<td><input type="number" name="min" min="2" max="100" value="2"></td>						
					<td>Max :</td>
					<td><input type="number" name="max" min="2" max="100" value="2"></td>						
					</tr>
					<tr>
						<td valign="top" colspan="1">Body :</td>
						<td align="right" colspan="3"><textarea cols="60" rows="15" name="text"></textarea></td>
					</tr>
					<tr>
						<td align="right" colspan="4"><input type="submit" name="save" value="Post" /></td>
					</tr>
				</table>
	 </form>
	 <script type="text/javascript">
	 	$(".add").click(function () {
	 		var type = this.id.slice(0,-1);
	 		var num = $("."+type).size();
	 		if (this.id.slice(-1)==="+") {
	 			$("."+type+":last").after($("."+type+":last").clone());
	 		}
	 		else if (this.id.slice(-1)==="-" && num !== 1) {
	 			$("."+type+":last").remove();
	 		}
	 	});	
	 </script>
</html>