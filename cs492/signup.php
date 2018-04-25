<?php
    include_once 'dbh.php';
    



    $first = mysqli_real_escape_string($conn, $_POST['firstname']);
    $last = mysqli_real_escape_string($conn, $_POST['lastname']);
    $uid = mysqli_real_escape_string($conn, $_POST['username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['password']);
    $re_pwd = mysqli_real_escape_string($conn, $_POST['repassword']);
    $sec1 = mysqli_real_escape_string($conn, $_POST['firstSecQt']);
    $ans1 = mysqli_real_escape_string($conn, $_POST['answer1']); 
    $sec2 = mysqli_real_escape_string($conn, $_POST['secondSecQt']);
    $ans2 = mysqli_real_escape_string($conn, $_POST['answer2']);
    $sec3 = mysqli_real_escape_string($conn, $_POST['thirdSecQt']);
    $ans3 = mysqli_real_escape_string($conn, $_POST['answer3']);

    $sql = "INSERT INTO users (user_first, user_last, user_uid, password, re_password, user_first_sec_qt, user_answer1, user_second_sec_Qt, user_answer2, user_third_sec_qt, user_answer3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

    //prepare the initial statement
    $stmt = mysqli_stmt_init($conn);
    
    // check for SQL error
    if (!mysqli_stmt_prepare($stmt, $sql)){
        echo "SQL error";
    }else{
        // Tell mysql that the '?' should be replaced with the value in post
        mysqli_stmt_bind_param($stmt, "sssssssssss", $first, $last, $uid, $pwd, $re_pwd, $sec1, $ans1, $sec2, $ans2, $sec3, $ans3);
        
        // execute the statement
        mysqli_stmt_execute($stmt);
    }

        
    header ("Location: ../cs492/home.html?signup=success");
    

