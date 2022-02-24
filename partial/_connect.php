<?php

$servername = "sql211.epizy.com";
$username = "epiz_30794063";
$password = "IstS8zQksblqp";
$database = "epiz_30794063_idiscuss";

$conn  = mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    die("Sorry to failed connection" . mysqli_connect_error());
}
?>