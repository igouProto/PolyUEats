<?php 
session_start();
//echo $_SESSION["can"]; //Remember canteen value?>
<html>
<head>
<?php
// Could have used Session variables to do the job, but this is much easier.
if($_SESSION["can"] == "VACanteen")
{
	print("
		<script>
			//After 3 seconds, the website will redirect to List.html.
			function timeout()
			{
				setTimeout(function(){ window.location.href='manage.php?canteen=VACanteen'; }, 3000);
			}
		</script>");
}
else if ($_SESSION["can"] == "AmericanDiner")
{
	print("
		<script>
			//After 3 seconds, the website will redirect to List.html.
			function timeout()
			{
				setTimeout(function(){ window.location.href='manage.php?canteen=AmericanDiner'; }, 3000);
			}
		</script>");
}
else
{
	//Do nothing.
}
?>
	<style tpye="text/css">
		.String{
			font-style: italic;
			color: red;
		}

body {
  margin: 0;
  padding: 0;
  background: #DDD;
  font-size: 16px;
  color: #222;
  font-family: 'Roboto', sans-serif;
  font-weight: 300;
}

h1 {
  margin: 0 0 20px 0;
  font-weight: 300;
  font-size: 28px;
}

	</style>
</head>
<body onload="timeout()">
	<?php
			//Start the session
			//session_start();
		
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "project";
			
			//Call the SESSION variables from OrderList.php
			$index = $_SESSION['index'];
			$orderNo = $_SESSION['OrderNo'];
			
			//Create an array to store a length (index) of status.
			$stats = array();
			//OrderNo Status variables.
			//$index = 
			for($i = 0; $i < $index; $i++)
			{
				$stats[$i] = $_POST['status' . $i ];
			}

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			if(isset($_POST["status0"]))
			{
				//Check every OrderList records to update the table. Very slow in terms of code execution.
				for($i = 0; $i < $index; $i++)
				{
					$sql = "UPDATE orders SET Status='". $stats[$i] ."' WHERE OrderNo=" . $orderNo[$i];

					if ($conn->query($sql) === TRUE) {
						echo "Record updated successfully on orderNo ". $orderNo[$i]. "<br>";
					} else {
						echo "Error updating record: " . $conn->error;
					}
				}
				echo "<h3>Update completed, redirecting to manage.html </h3>";
			}
			else
			{
				print("please set up your status first in OrderList.php");
			}

			$conn->close();
	?>
</body>
</html> 
