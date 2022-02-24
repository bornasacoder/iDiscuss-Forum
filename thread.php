<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Welcome TO iDiscuss - Coding Forums</title>
</head>

<body>
    <?php  
    include "partial/_header.php"; 
    include "partial/_connect.php";
    ?>

    <?php  
    $id = $_GET['threadid'];
    $sql = "select * from thread where thread_id = $id ";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];
        // query the users table to find out the name of op
        $sql2 = "select user_email from users where user_id = '$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
    }
?>


    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4"> <?php echo $title; ?></h1>
            <p class="lead"> <?php echo $desc;  ?>.</p>
            <hr class="my-4">
            <p>This is a peer to peer forum . No spam / Advertising / Self-promote in the forum is not allowed . Do not
                post copyright infringing material .
                Do not post 'offensive ' posts ,links, or images. Do not cross post questions . remain respectful of
                other members at all time .
            </p>
            <p class="lead">Posted By: <b><?php echo $row2['user_email']; ?></b> </p>
        </div>
    </div>
    <!--  fetching record from thread table in mysql data-->


    <?php  
    $showalert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    
    if($method == 'POST'){
        // insert into database 
        $comment = $_POST['comment'];
        $comment = str_replace("<","&lt;",$comment);
        $comment = str_replace(">","&gt;",$comment);
        $sno = $_POST['sno'];
    

        $sql = "insert into comment (comment_content, thread_id, comment_by, comment_time) values ('$comment', '$id', '$sno',current_timestamp())";
        $result = mysqli_query($conn,$sql);
          $showalert = true;
          if($showalert){
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong> Success! </strong> Your comment has been added!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
          }
       
    }

?>
<?php  
   if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
   echo ' <div class="container">
        <h2 class="py-4">Post a comment</h2>

        <form action="'. $_SERVER["REQUEST_URI"] .'" method="POST">

            <div class="form-group">
                <label for="comment">Type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            </div>

            <button type="submit" class="btn btn-primary">Post Comment</button>
        </form>
    </div>';
   }else{
           echo ' <div class="container">
           <h2 class="py-2">Post a comment</h2>
               <p class="lead">You are not logged in . Please login to post a comment.</p>
           </div>';     
   }
?>

    <div class="container my-5">
        <h2 class="my-2">Discussions</h2>

        <?php  
    $id = $_GET['threadid'];
    $sql = "select * from comment where thread_id = $id";
    $result = mysqli_query($conn, $sql);
    $noresult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noresult = false;
      
       $content = $row['comment_content'];
       $comment_time = $row['comment_time'];
       $thread_user_id = $row['comment_by'];
  $sql2  ="select user_email from users where user_id  = '$thread_user_id'";
  $result2 = mysqli_query($conn,$sql2);
  $row2 = mysqli_fetch_assoc($result2);
    

       echo '<div class="media my-4">
            <img src="img/user.png" width="54px" class="mr-3" alt="...">
            <div class="media-body">
               <p class="font-weight-bold my-0"> '. $row2["user_email"] .' '. $comment_time .' </p>
                 ' . $content . '
            </div>
        </div>
    ';  
    
        }
        
    if($noresult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No Comments Found.</p>
          <p class="lead">Be the first person to comment.</p>
        </div>
      </div>';
    }
    ?>
    </div>

    
    <?php
    include "partial/_footer.php";
    ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>