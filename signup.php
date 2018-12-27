<?php

   // session_start(); 


if (isset($_POST['submit'])){
    
    include 'dbh.php';

    $first = mysqli_real_escape_string($conn, $_POST['firstname']);
    $last = mysqli_real_escape_string($conn, $_POST['lastname']);
    $uid = mysqli_real_escape_string($conn, $_POST['username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['password']);
    $sec1 = mysqli_real_escape_string($conn, $_POST['firstSecQt']);
    $ans1 = mysqli_real_escape_string($conn, $_POST['answer1']); 
    $sec2 = mysqli_real_escape_string($conn, $_POST['secondSecQt']);
    $ans2 = mysqli_real_escape_string($conn, $_POST['answer2']);
    $sec3 = mysqli_real_escape_string($conn, $_POST['thirdSecQt']);
    $ans3 = mysqli_real_escape_string($conn, $_POST['answer3']);
    
     // Erroe handlers
    // Check if inputs are empty
    
    if(empty($first)  || empty ($last) || empty($uid) || empty($pwd) || empty($sec1) || empty($ans1) || empty($sec2) || empty($ans2) || empty($sec3) || empty($ans3) ){
         header("Location: ../cs492/CreateUser.html?signup=empty");
         exit ();
        
    }else{
        // check if input characters are valid
        if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
            header("Location: ../cs492/CreateUser.html?signup=invalid");
         exit ();
        }else{
            $sql = "SELECT *FROM users WHERE user_uid = '$uid'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            
        if ($resultCheck > 0 ){
            header("Location: ../cs492/CreateUser.html?signup=usertaken");
            exit ();
        }else{
            // Hashing the password
            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
            
            //Insert the user into the dayabase
            
            $sql = "INSERT INTO users (user_first, user_last, user_uid, password, user_first_sec_qt, user_answer1, user_second_sec_Qt, user_answer2, user_third_sec_qt, user_answer3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

            //prepare the initial statement
            $stmt = mysqli_stmt_init($conn);
    
        // check for SQL error
            if (!mysqli_stmt_prepare($stmt, $sql)){
                echo "SQL error";
            }else{
        // Tell mysql that the '?' should be replaced with the value in post
        mysqli_stmt_bind_param($stmt, "ssssssssss", $first, $last, $uid, $hashedPwd, $sec1, $ans1, $sec2, $ans2, $sec3, $ans3);
        
        // execute the statement
        mysqli_stmt_execute($stmt);
                header("Location: ../cs492/index.html?seccuss");
            exit ();
                
            }
            
        }
       }

    }

        
}else {
    header ("Location: ../cs492/index.html?signup=success");
    exit();
}
    

?>