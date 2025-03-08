<?php
$firstname="";
$password="";
$err="";
//database connection
$conn= mysqli_connect("localhost","root","","db");
if(isset($_POST['LOGIN'])){
    $firstname=mysqli_real_escape_string($conn,$_POST['firstname']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);

    $sql="select * from users where firstname='".$firstname."' and passworrd='".$password."' LIMIT 1";
    $result = mysqli_query($conn,$sql);

    if(empty($firstname)){
        $err="Username is required!";
    }else if(empty($password)){
        $err="Password is required!";  
    }else if(mysqli_num_rows($result)==1){
        header('location:home.php');
    }else{
        $err="Username or password is incorrect!";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link rel="stylesheet" href="CSS/loginstyle.css">
</head>
<body>
   <div class="box">
    <h1>Login Here</h1>
    <div class="err">
         <?php echo $err;
         ?>
    </div>
    <form action="login.php" method="post">
        <input type="text" name="firstname" id="" placeholder="Enter username">
        <input type="password" name="password" id="" placeholder="Enter password">
        <input type="submit" value="LOGIN" name="LOGIN">
        Not yet a member? <a href="signup.php" style="color:#ffc107">REGISTER</a>
    </form>
   </div> 
</body>
</html>