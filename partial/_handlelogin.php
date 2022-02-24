<?php
$showloginerror = "false";
 if(isset($_SERVER['REQUEST_METHOD']) == 'POST'){
     include "_connect.php";
     $email = $_POST['loginemail'];
     $pass = $_POST['loginpassword'];

     $sql = "select * from users where user_email = '$email'";
     $result = mysqli_query($conn,$sql);
     $num = mysqli_num_rows($result);
     
         if($num == 1){
             $row = mysqli_fetch_assoc($result);
             if(password_verify($pass,$row['password'])){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['sno'] = $row['user_id'];
                $_SESSION['useremail'] = $email;
              
                header("location: /forum/index.php?loginsuccess=true");

                exit();

             }else{
                 $showloginerror = "Please enter the correct password";
     
             }
         }
         header("location: /forum/index.php?loginsuccess=false&loginerror=$showloginerror");
 }

?>