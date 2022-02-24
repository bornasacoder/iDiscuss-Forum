<?php
include "_connect.php";
    session_start();
 echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/forum">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/forum">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Top Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
        $sql = "select category_id, category_name from category";
        $result= mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
         $catname = $row['category_name'];
          $catid = $row['category_id'];
         echo ' <a class="dropdown-item" href="threadlist.php?catid=' . $catid .'">'. $catname .'</a>';
        }
          echo  '</div>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="contact.php">Contact</a>
    </li>
    </ul>
       <div class="mx-2 row">';

    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo '  <form class="form-inline my-2 my-lg-0" action="search.php" method="GET">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            <p class="text-light my-0 mx-2"> Welcome '. $_SESSION['useremail'] .' </p>

            <a href="partial/_logout.php" class="btn btn-outline-primary ml-2"  >Logout</a>
          </form>';
    }else{
         echo '   <form class="form-inline my-2 my-lg-0" action="search.php" method="GET">
                  <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
                 <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                 </form>
                 <button class="btn btn-outline-primary ml-2"  data-toggle="modal" data-target="#loginModal">Login</button>
                 <button class="btn btn-outline-primary mx-2" data-toggle="modal" data-target="#signupModal">Signup</button>';
    }
echo ' </div>
  </div>
</nav>';


    include "partial/_loginmodal.php";
    include "partial/_signupmodal.php";

    if(isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true"){
      echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
      <strong>Success!</strong> you can now login.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }

    if(isset ($_GET['signupsuccess']) && $_GET['signupsuccess'] == "false"){
      $showerror = $_GET['error'];
      echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
      <strong> Error! </strong> '. $showerror .'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
    // for login alert messages
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
      echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
      <strong>Success!</strong> Thank you for Login! Welcome To iDiscuss Forum.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    
    }  
    if(isset ($_GET['loginsuccess']) && $_GET['loginsuccess'] == "false"){
      $showerror = $_GET['loginerror'];
      echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
      <strong> Error! </strong> '. $showerror .'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }

?>
