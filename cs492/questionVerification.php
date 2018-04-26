<?php


//session_start(); 

if (isset($_POST['submit'])){
    
    include 'dbh.php';
    
   // $secqt = mysqli_real_escape_string($conn, $_POST['secqt']);
    $answer = mysqli_real_escape_string($conn, $_POST['questionanswer']);
    
    // Erroe handlers
    // Check if inputs are empty
    
    if(empty ($answer)){
         header("Location: ../cs492/questionVerification.html?login=empty");
         exit ();
        
    }else{
        $sql = "SELECT *FROM users WHERE user_answer1 = '$answer'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck <1 ){
            header("Location: ../cs492/questionVerification.html?login=error");
            exit ();
        }else{
            if ($row = mysqli_fetch_assoc($result)) {
               // if ($answer == false{
                     header("Location: ../cs492/KeyGeneration.html?login=success");
                     exit ();
                }else{
                    header("Location: ../cs492/questionVerification.html?login=error");
                     exit ();
                }
            
        }
    }
}else{
    
    header("Location: ../cs492/index.html?login=error");
    exit ();
}





?>