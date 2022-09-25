<?php
   session_start();
   if (!isset($_SESSION["can"]))  {
     $_SESSION["can"]= array();
   }
$ID=$_REQUEST['id'];
$conn = mysqli_connect("localhost","root","","project");
 if ($conn->connect_error) {
    echo "Unable to connect to database";
    exit;
 }
$query = "DELETE FROM ".$_SESSION["can"]." WHERE ID = $ID"; 
$result = $conn->query($query);
header("Location: Admin.php"); 
?>