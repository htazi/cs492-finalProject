<?php


//session_start(); 

if (isset($_POST['submit'])){
    
    include 'dbh.php';
    
    $uid = mysqli_real_escape_string($conn, $_POST['username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Erroe handlers
    // Check if inputs are empty
    
    if(empty($uid)  || empty ($pwd)){
         header("Location: ../cs492/index.html?login=empty");
         exit ();
        
    }else{
        $sql = "SELECT *FROM users WHERE user_uid = '$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck <1 ){
            header("Location: ../cs492/index.html?login=error");
            exit ();
        }else{
            if ($row = mysqli_fetch_assoc($result)) {
                // De-hashing the password
                $hashedPwdCheck = password_verify($pwd, $row['password']);
                if ($hashedPwdCheck == false){
                     header("Location: ../cs492/index.html?login=errop");
                     exit ();
                }elseif ($hashedPwdCheck == true ) {
                    header("Location: ../cs492/questionVerification.html?login=success");
                     exit ();
                }
            }
        }
    }
}else{
    
    header("Location: ../cs492/index.html?login=error");
    exit ();
}





?>