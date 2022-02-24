<?php
$showerror = "false";
if(isset($_SERVER['REQUEST_METHOD']) == "POST"){
    include "_connect.php";
    $user_email = $_POST['signupemail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];
    
    $existsql = "select * from users where user_email = '$user_email'";
    $result = mysqli_query($conn,$existsql);
     $num = mysqli_num_rows($result);
     if($num>0 ){
          
         $showerror =  "Email already exists";
     }else{
         if($pass == $cpass){
             $hash = password_hash($pass,PASSWORD_DEFAULT);
            $sql = "insert into users(user_email,password,tstamp) values('$user_email','$hash',current_timestamp())";
            $result = mysqli_query($conn,$sql);
           
            if($result){
                $showalert = true;
               header("Location: /forum/index.php?signupsuccess=true");

               exit();
            }
         }else{
             $showerror = "Password do not match";
         }
     }
      
     header("location: /forum/index.php?signupsuccess=false&error=$showerror");
    }
?>