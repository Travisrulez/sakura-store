<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include("../core/database.php");
session_start();
$pid=$_SESSION['pi'];
mysqli_query($link,"DELETE FROM productimg WHERE id = '".$_GET['del_postimg']."'");
header("location:post_upload.php?post_id=$pid");  
?>