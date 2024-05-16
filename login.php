<?php
//session start
session_start();

// connection between Form and Mysql server
$con = mysqli_connect("localhost","root","","user");

//username and password is recieved from login page
$usertrim = trim($_POST['username']);
//eliminated space and special characters here
$usertrip = stripcslashes($usertrim);
$finaluser = htmlspecialchars($usertrip);

//similar for password space and special charchter s
$passtrim = trim($_POST['password']);

//eliminated space and special characters
$passtrip = stripcslashes($passtrim);
$finalpass = htmlspecialchars($passtrip);

//comparison between user input with database values
$sql = "SELECT * FROM user_tbl where username = '$finaluser' AND password = '$finalpass'";
//SQL result executed

$result = mysqli_query($con,$sql);

//if number of rows is greater than 0 then there is username and password match is found else is not found

if (mysqli_num_rows($result)>=1) 
{
    //username is stored to session and forwarded to next page
    $_SESSION["myuser"]= $finaluser;
    header("location:index.html");
}
else{
    //error is shown in the samepage or next page
    $_SESSION["error"]= "You are not valid user";
    header("location:error.html");
}

