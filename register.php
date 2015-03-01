
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
                    
                    <a class="glow" href="index.php">LOGIN</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    
                </div>
            </div>
        </nav>









        <br><br><br>

        <form action="" method="POST">
 <center>
 <h2>Details FORM</h2>
 UserName:
<input type="text" name="username" size="20"  autofocus placeholder="UserName" required>
<br><br>
First Name:
<input type="text" name="firstname" placeholder="FirstName" required><br>

<br>
Last Name:
<input type="text" name="lastname" placeholder="LastName" ><br>

<br>
Email Id:
<input type="text" name="emailid" placeholder="Email Id" ><br>

<br>
Password:
<input type="password" name="password" placeholder="Password" ><br>
<input type="submit" value="Create Account"  name="register">
</center>
</form> 




<?php

$key=md5('india');
$salt=md5('india');

//encrypt
function encrypt($string,$key){
    $string=rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$key,$string, MCRYPT_MODE_ECB)));
    return $string;
}
//decrypt
function decrypt($string,$key){
    $string=rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$key,base64_decode($string), MCRYPT_MODE_ECB));
    return $string;
}
//hashing
function hashword($string,$salt){
    $string=crypt($string,'$1$'.$salt.'$');
    return $string;
}






if(isset($_POST["register"])){
    echo 'registering !  .';
        if(!empty($_POST['username']) && !empty($_POST['password'])) {
              $user=$_POST['username'];
              $first=$_POST['firstname'];
              $last=$_POST['lastname'];
              $email=$_POST['emailid'];
              $pass=$_POST['password'];

            $con=mysqli_connect('localhost','root','','IDEAS') or die(mysql_error());
          

            $query=mysqli_query($con,"SELECT * FROM users WHERE BINARY UserName='".$user."'");
            $numrows=mysqli_num_rows($query);
            if($numrows==0)
            {
                $pass=hashword($pass,$salt);
             $sql="INSERT INTO users(UserName,FirstName,LastName,Email_Id,Password) VALUES('$user','$first','$last','$email','$pass')";

                $result=mysqli_query($con,$sql);


                if($result){
                echo "Account Successfully Created";
                } else {
                echo "Failure!";
                }

            } else {
            echo "That username already exists! Please try again with another.";
            }

        } else {
            echo "All fields are required!";
        }
}
?>




        <script src="bootstrap/js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap/js/problems.js"></script>
    </body>
</html>

