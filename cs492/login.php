<?php


session_start(); 

if (isset($_POST['submit'])){
    
    include 'dbh.php';
    
    $uid = mysqli_real_escape_string($conn, $_POST['username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Erroe handlers
    // Check if inputs are empty
    
    if(empty($uid)  || empty ($pwd)){
         header("Location: ../cs492/home.html?login=empty");
         exit ();
        
    }else{
        $sql = "SELECT *FROM users WHERE user_uid = '$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck <1 ){
            header("Location: ../cs492/home.html?login=error");
            exit ();
        }else{
            if ($row = mysqli_fetch_assoc($result)) {
                // De-hashing the password
                $hashedPwdCheck = password_verify($pwd, $row['password']);
                if ($hashedPwdCheck == false){
                     header("Location: ../cs492/home.html?login=error");
                     exit ();
                }elseif ($hashedPwdCheck == true ) {
                    // Log in the user here
                    $_SESSION['u_id'] = $row['user_id'];
                    $_SESSION['u_firt'] = $row['user_first'];
                    $_SESSION['u_last'] = $row['user_last'];
                    $_SESSION['u_uid'] = $row['user_uid'];
                    $_SESSION['u_pwd'] = $row['password'];
                    $_SESSION['u_re_pwd'] = $row['re_password'];
                    $_SESSION['u_sec1'] = $row['user_first_sec_qt'];
                    $_SESSION['u_ans1'] = $row['user_answer1'];
                    $_SESSION['u_sec2'] = $row['user_second_sec_qt'];
                    $_SESSION['u_ans2'] = $row['user_answer2'];
                    $_SESSION['u_sec3'] = $row['user_third_sec_qt'];
                    $_SESSION['u_ans3'] = $row['user_answer3'];
                    header("Location: ../cs492/home.html?login=seccess");
                     exit ();
                }
            }
        }
    }
}else{
    
    header("Location: ../cs492/home.html?login=error");
    exit ();
}





?>