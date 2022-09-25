<!DOCTYPE html>
<html>
<head>
<?php
session_start();

 ?>
 <?php
    $var = $_POST['foodList'];
?>
 <script>
 window.onload = JSON.stringify(localStorage.getItem("foodList"));

 alert(jsondata);
 //localStorage.removeItem("foodList");
 </script>

</head>
<body>
  <h1> Food Cart </h1>
  <?php
  $array1=json_decode($_POST['jsondata']);
  echo $array1;
   ?>

</body>
</html>
