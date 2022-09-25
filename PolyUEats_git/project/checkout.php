<?php
	session_start();

	date_default_timezone_set("Asia/Taipei");
	
	#prepare all the order information
	$canteen = $_SESSION["can"];
	$orderArr = $_SESSION["order"];
	$priceArr = $_SESSION["itemPrice"];
	$orderSet = implode(", ", $orderArr);
	$orderTime = date("Y-m-d h:i:s", strtotime("now + 0 minutes"));
	$raw_pickTime = strtotime("now + " . $_GET["pickupTime"] . "minutes");
	$pickupTime = date("Y-m-d h:i:s", $raw_pickTime);
	$plasticBag = $_GET["plasticBag"];
	$status = "confirmed";

	if (isset($_GET["seasoning"])){
		$seasoningSet = implode(", ", $_GET["seasoning"]);
	}else{
		$seasoningSet = "nothing";
	}

	if ($_GET["plasticBag"] == "1"){
		$total = $_SESSION["total"] + 1;
	}else{
		$total = $_SESSION["total"];
	}

	$ordernum = $_SESSION["orderNum"];

	#connect to the database
	$conn = mysqli_connect("localhost", "root", "", "project"); //I'm using the root account for the DB
	if ($conn -> connect_error){
		echo ("Unable to connect to DB!");
		exit();
	}

	#check for duplicate order no (usually caused by user refreshing the page at this stage)
	$idCheck = "SELECT count(*) as 'count' FROM `UsedId` where ID = '" . $ordernum . "'";
	$result = $conn -> query($idCheck);
	$row = $result -> fetch_assoc();
	if ($row['count'] == 1){
		echo "<script> alert('You had already ordered! Please close this tab or return to the home page!')</script>";
	}else{
		#write the order into the database
		$query = "INSERT INTO Orders" . 
				 "(OrderNo, OrderItems, Canteen, Seasoning, PlasticBag, OrderTime, PickupTime, Total, Status)" . 
				 "VALUES " . 
				 "('$ordernum', '$orderSet', '$canteen', '$seasoningSet', '$plasticBag', '$orderTime', '$pickupTime', '$total', '$status')";
		$result = $conn -> query($query);
		if (!$result){
			die($conn->error);
		}

		#record the used ID
		$writeID = "INSERT INTO UsedId (ID) VALUES ('$ordernum')";
		$result2 = $conn -> query($writeID);
		if (!$result2){
			die($conn->error);
		}
	}

?>
<head>
	<title>Thank you!</title>
	<!-- these are the css template sources (hosted), the official site of the css template is https://getmdl.io/index.html -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

	<style type="text/css">

		.demo-card-wide.mdl-card {
  			width: 512px;
		}

  		.header {
  			padding: 5px;
  			text-align: center;
  			background: #1abc9c;
  			color: white;
  			font-size: 20px;
  			}

  		h1{color: white;}

  		.mdl-data-table{
  			border: 0px
  		}

  		largeTxt{font-size: 50px;}
  		medTxt{font-size: 40px;}
  		total{font-size: 30px;}

	</style>
	
</head>
	<div class="header">
		<h1>Thank You.</h1>
		<h5>Your order is confirmed.</h5>
	</div>
<br>

<center>
<div class="demo-card-wide mdl-card mdl-shadow--2dp">

	<div class="mdl-card__supporting-text">
			Order number
			<br><br>
			<largeTxt><?php echo $ordernum; ?></largeTxt>
			<br><br><br>
			Picking up at
			<br><br>
			<medTxt><?php echo $canteen ?></medTxt>
			<br><br><br>
			Estimated Time for Pickup
			<br><br>
			<medTxt><?php echo $pickupTime ?></medTxt>
			<br><br><br>
			Order Details
			<br><br>
			<table class="mdl-data-table mdl-js-data-table shadow" width="500">
				<thead>
					<tr>
      					<th class="mdl-data-table__cell--non-numeric">Item</th>
      					<th>Price</th>
    				</tr>
				</thead>
				<tbody>
					<?php
						
						for($i = 0; $i < count($orderArr); $i++){
							echo "<tr>";
							echo "<td class='mdl-data-table__cell--non-numeric'>" . "$orderArr[$i]" . "</td>";
							echo "<td> $" . "$priceArr[$i]" . "</td>";
							echo "</tr>";
						}
						if($plasticBag == 1){
							echo "<tr>";
							echo "<td class='mdl-data-table__cell--non-numeric'>" . 'Plastic Bag' . "</td>";
							echo "<td> $" . "1" . "</td>";
							echo "</tr>";							
						}
						if (isset($_GET["seasoning"])){
							for($i = 0; $i < count($_GET["seasoning"]); $i++){
								echo "<tr>";
								echo "<td class='mdl-data-table__cell--non-numeric'>" . $_GET["seasoning"][$i] . "</td>";
								echo "<td> $" . "0" . "</td>";
								echo "</tr>";
							}							
						}
						echo "<tr>";
						echo "<th class='mdl-data-table__cell--non-numeric'>" . "TOTAL" . "</th>";
						echo "<th><total> $" . $total . "</total></th>";
						echo "</tr>";

					?>

				</tbody>

			</table>
			<br>
			Check your order status at Main Page > Check Order.
    </div>
</div>
</center>
<br>
<center>You may close this tab now or <a href = "Canteen.php"> Return to the home page.</a> </center>
<br><br>
