<?php 

session_start();
session_unset();
echo "Logging you out . please wait...";
session_destroy();

header("Location: /forum/index.php");

?>