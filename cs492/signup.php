<?php
    //include_once 'dbh.php';
    

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "cs492db";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword ,$dbName);


    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $userName = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['repassword'];
    $firstSecQt = $_POST['firstSecQt'];
    $answer1 = $_POST['answer1']; 
    $secondSecQt = $_POST['secondSecQt'];
    $answer2 = $_POST['answer2'];
    $thirdSecQt3 = $_POST['thirdSecQt'];
    $answer3 = $_POST['answer3'];

    $sql = "INSERT INTO users (firstName, lastName, userName, password, re_password, firstSecQt, answer1, secondSecQt, answer2, thirdSecQt, answer3) VALUES ('$firstName', '$lastName', '$userName', '$password', '$re_password', '$firstSecQt', '$answer1', '$secondSecQt', '$answer2', '$thirdSecQt', '$answer3');";

    mysqli_query($conn, $sql);
        
    header ("Location: ../cs492/CreateUser.html?signup=success");
    

