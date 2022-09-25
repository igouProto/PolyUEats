<?php
session_start();
unset($_SESSION['Username']);
unset($_SESSION['password']);
echo "<h3>Log Out Successfully</h3>";
header("Refresh:1;url=LogIn.php");
exit();
?>
