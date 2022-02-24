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
    <style>
    #last {
        min-height: 300px;

    }
    </style>
</head>

<body>
    <?php  
    include "partial/_header.php"; 
    include "partial/_connect.php";
    ?>

    <?php  
      $id = $_GET['catid'];
    $sql = "select * from category where category_id = $id ";
    $result = mysqli_query($conn, $sql);
     while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
?>

    <?php  
    $showalert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    
    if($method == 'POST'){
        // insert into database 
        $th_title = $_POST['title'];
        $th_title = str_replace("<","&lt;",$th_title);
        $th_title = str_replace(">","&gt;",$th_title);

        $th_desc = $_POST['desc'];
        $th_desc = str_replace("<","&lt;",$th_desc);
        $th_desc = str_replace(">","&gt;",$th_desc);
       $sno  = $_POST['sno'];

        $sql = "insert into thread (thread_title,thread_desc,thread_cat_id,thread_user_id,tstamp) values('$th_title','$th_desc' , '$id' , '$sno' , current_timestamp())";
        $result = mysqli_query($conn,$sql);
          $showalert = true;
          if($showalert){
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong> Success! </strong> Your thread has been added! please wait for community to respond.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
          }
       
    }

?>

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome To <?php echo $catname; ?> Forum.</h1>
            <p class="lead"> <?php echo $catdesc;  ?>.</p>
            <hr class="my-4">
            <p>This is a peer to peer forum . No spam / Advertising / Self-promote in the forum is not allowed . Do not
                post copyright infringing material .
                Do not post 'offensive ' posts ,links, or images. Do not cross post questions . remain respectful of
                other members at all time .
            </p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <!--  fetching record from thread table in mysql data-->

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo '<div class="container">
        <h2 class="py-4">Start a discussion</h2>

        <form action="'. $_SERVER["REQUEST_URI"].'" method="POST">
            <div class="form-group">

                <label for="threadtitle">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                    possible.</small>
            </div>
            <input type="hidden" name="sno" value="'. $_SESSION['sno'].'">
            <div class="form-group">
                <label for="threaddesc">Ellaborate your concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>';
    }else{
        echo '<div class="container">
        <h2 class="py-4">Start a discussion</h2>
        <p class="lead"> You are not logged in . You are able to start a discussion.</p>
        </div>';
    }
?>
    <div class="container my-4" id="last">
        <h2 class="py-4">Browse Questions</h2>


        <?php  
        $id = $_GET['catid'];
    $sql = "select * from thread where thread_cat_id = $id";
    $result = mysqli_query($conn, $sql);
    $noresult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noresult = false;
        $id =   $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_time = $row['tstamp'];
        $thread_user_id = $row['thread_user_id'];
        $sql2 = "select user_email from `users` where user_id='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
       $row2 =  mysqli_fetch_assoc($result2);
    
    

       echo '<div class="media my-3">
            <img src="img/user.png" width="54px" class="mr-3" alt="...">
            <div class="media-body">'.
                '<h5 class="mt-0"> <a class="text-dark" href="thread.php?threadid='. $id .'">' . $title . ' </a></h5>
                 ' . $desc . ' </div>' . ' <p class="font-weight-bold my-0">Asked By: '. $row2['user_email'] . ' at '. $thread_time  
                 .'</p>'.
                 '</div>';
        
    }
    if($noresult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No Threads Found.</p>
          <p class="lead">Be the first person to ask a question.</p>
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