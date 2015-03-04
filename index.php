
<!DOCTYPE html>

    <head>
        

        <title>Idea's Forum Dashboard</title>
 
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <link href="bootstrap/css/problems.css" rel="stylesheet">
        


        
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">	
            <div class="container-fluid">
                <div class="navbar-header">
                    
                    <a class="glow" href="register.php">REGISTER??</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    
                </div>
            </div>
        </nav>
<!---------------------------------------------------->


		<br>
		<br>
		<br>

	<center>
	<b><h1>Please enter your credentials below</h1></b>
 
	<form action="index.php" method="POST">
	<br><br>
	USERNAME:<br>
	<input type="text" name="user" required>
	<br>
	PASSWORD:<br>
	<input type="password" name="pass" required><br>	

	<input type="submit" value="Login" name="login">

	</form> 	






<?php


$key=md5('india');
$salt=md5('india');

//encrypt
function encrypt($string,$key){
	$string=rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$key,$string, MCRYPT_MODE_ECB)));
}
//decrypt
function decrypt($string,$key){
	$string=rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$key,base64_decode($string), MCRYPT_MODE_ECB));
}
//hashing
function hashword($string,$salt){
	$string=crypt($string,'$1$'.$salt.'$');
	return $string;
}

$host ="localhost";
$user="root";
$pass="";
$db="IDEAS";
$con=mysqli_connect('localhost','root','','IDEAS') or die(mysql_error());
mysqli_connect($host,$user,$pass);
mysqli_select_db($con,$db);

if(isset($_POST["login"])){
if(!empty($_POST['user']) && !empty($_POST['pass'])) {


$username=$_POST['user'];
$password= $_POST['pass'];
$password=hashword($password,$salt);


$sql="SELECT * FROM users Where BINARY UserName='".$username."' AND Password='".$password."' LIMIT 1 ";
$res=mysqli_query($con,$sql);

if(mysqli_num_rows($res)==1){
	$row = mysqli_fetch_assoc($res);
	session_start();
	$_SESSION['userID']=$row['UserId'];
	$_SESSION['username']=$username;
	
	header("Location: home.php");

}
else{
	echo "invalid login information";
}

}else{
	echo "All fields are required!";
}
}
?>



<!------------------------------------------------------------------------------------------------------------------------------------------------------------------->
       
        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap/js/problems.js"></script>
    </body>
</html>

