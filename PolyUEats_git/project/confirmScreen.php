<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	session_start();


	$foodList=json_decode($_GET['foodArr']);
	$canteen = $_SESSION["can"];
/*
	for ($i = 0; $i < count($foodList); $i++){
		echo ($foodList[$i]);
	}
*/

	#check the database for duplicated order number
	$conn = mysqli_connect("localhost", "root", "", "project"); //I'm using the root account for the DB
	do{
		srand(mktime()); //or use the userID + the time
		$orderNum = rand(1000, 9999);
		$idCheck = "SELECT count(*) as 'count' FROM `UsedId` where ID = '" . $orderNum . "'";
		$result = $conn -> query($idCheck);
		$row = $result -> fetch_assoc();
	}while($row["count"] == "1");
	$_SESSION["orderNum"] = $orderNum; #if it's not a duplicated number then use it

	#retrive the food names and prices
	$foodArr = array(); //the array that hold the name of the foods
	$priceArr = array(); //prices!
	for ($i = 0; $i < count($foodList); $i++){
		$foodQuery = "SELECT FoodItem, Price FROM `" . $canteen . "` Where ID = '" . $foodList[$i] . "'";
		$result2 = $conn -> query($foodQuery);
		$row2 = $result2 -> fetch_assoc();
		array_push($foodArr, $row2['FoodItem']);
		array_push($priceArr, $row2['Price']);
	}

	#update the popularity of food
	for ($i = 0; $i < count($foodArr); $i++){
		$updateQuery = "update `" . $canteen . "` set Popularity = Popularity + 1 WHERE FoodItem = '" . $foodArr[$i] . "'";
		$result3 = $conn -> query($updateQuery);
	}

	#item to be passed to the next file
	$_SESSION["order"] = $foodArr;
	$_SESSION["itemPrice"] = $priceArr;
	$_SESSION["canteen"] = "American Diner";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Order Confirmation</title>
	<script type="text/javascript">
		function check(){
			if (additionalOrder.pickupTime.value == ""){
				alert("Please enter your pick up time!!");
				return false;
			}
		}
	</script>

	<!-- these are the css template sources (hosted), the official site of the css template is https://getmdl.io/index.html -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

	<!-- our custom css for this project -->
	<style type="text/css">

  		.header {
  			padding: 5px;
  			text-align: center;
  			background: #1abc9c;
  			color: white;
  			font-size: 20px;
  			}

  		h1{color: white;}

		.card{
			padding-top: 10px;
			padding-bottom: 10px;
			padding-right: 80px;
			padding-left: 80px;
    		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    		background-color: #fff;
    		width: 1000px;
    		margin: 0cm 1cm 1cm 0cm;
    		text-align: left;
    		font-family: arial;
    		display: inline-block;
  		}
  		.card button{
  			border: none;
  			outline: 0;
  			text-align: center;
  			cursor: pointer;
  			width: 100%;
  			font-size: 18px;
		}

		.card button:hover {
  			opacity: 0.7;
		}

		.shadow{box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);}

		.total{font-size: 18px}

	</style>

</head>
<body>
	<div class = "header">
		<h1> Almost done! </h1>
		<h5> Please check your order: </h5>
	</div>
	
	<br>
	<center>Note that your order is NOT YET confirmed!</center>
	<br>
	<center><table class="mdl-data-table mdl-js-data-table shadow" width="500">
  		<thead>
    		<tr>
      			<th class="mdl-data-table__cell--non-numeric">Item</th>
      			<th>Price</th>
    		</tr>
  		</thead>
  		<tbody>
  			<?php

				#for ($i = 0; $i < count($_SESSION["list"]); $i++){
					#echo $_SESSION["list"][$i];
					#echo "&nbsp;";
				#}

				$_SESSION["total"] = 0;
				for ($i = 0; $i < count($foodArr); $i++){
					echo "<tr>";
					echo "<td class='mdl-data-table__cell--non-numeric'>" . $foodArr[$i] . "</td>";
					echo "<td> $" . $priceArr[$i] . "</td>";
					$_SESSION["total"] += $priceArr[$i];
				}
			?>
			<?php
				echo "<tr>";
				echo "<td class='mdl-data-table__cell--non-numeric total'>" . "TOTAL" . "</td>";
				echo "<td class='total'>" . "$" . $_SESSION["total"] . "</td>"; 
			?>
  		</tbody>

  	</table></center>

	<hr>
	<center><div class="card">
		<center><h3> Before you check out...</h3></center>
		<form name = "additionalOrder" id = "additionalOrder" method="get" action="checkout.php" onsubmit="return check();">
			<h4>Some extra packs of seasoning, perhaps?</h4>

			<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="seasoning1">
  				<input type="checkbox" id="seasoning1" name="seasoning[]" value = "Ketchup" class="mdl-checkbox__input"> 
  				<span class="mdl-checkbox__label"> Ketchup </span>
  			</label>
  			<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="seasoning2">
  				<input type="checkbox" id="seasoning2" name="seasoning[]" value = "Pepper" class="mdl-checkbox__input">
  				<span class="mdl-checkbox__label"> Pepper </span>
			</label>
  			<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="seasoning3">
				<input type="checkbox" id="seasoning3" name="seasoning[]" value = "Mustard" class="mdl-checkbox__input">
				<span class="mdl-checkbox__label"> Mustard </span>
			</label>
			<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="seasoning4">
				<input type="checkbox" id="seasoning4" name="seasoning[]" value = "Sugar" class="mdl-checkbox__input">
				<span class="mdl-checkbox__label"> Sugar </span>
			</label>

			<h4>Do you need a plastic bag?</h4>
				<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="plasticBag0">
  					<input type="radio" id="plasticBag0" class="mdl-radio__button" name="plasticBag" value="0" checked>
  					<span class="mdl-radio__label">No</span>
				</label>
				&nbsp; &nbsp;
				<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="plasticBag1">
  					<input type="radio" id="plasticBag1" class="mdl-radio__button" name="plasticBag" value="1">
  					<span class="mdl-radio__label">Yes (+ $1)</span>
				</label>


			<h4>When would you like to pick it up?</h4>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" name = "pickupTime" id="pickupTime">
				<label class="mdl-textfield__label" for="pickupTime">...Minutes from now</label>
				<span class="mdl-textfield__error">Input is not a number!</span>
			</div>
			<br>
			Kindly note that your meal needs at least 15 minutes to process. There may be dalays during rush hours.
			<br><br>
			<div class="mdl-card__actions mdl-card--border">
				<button class="mdl-button mdl-js-button mdl-js-ripple-effect" type="submit" value="Confirm!">Confirm!</button>
			</div>
		</form>
	</div></center>

	<div id="demo-toast-example" class="mdl-js-snackbar mdl-snackbar">
		<div class="mdl-snackbar__text"></div>
		<button class="mdl-snackbar__action" type="button"></button>
	</div>

	<script>
	(function() {
  		'use strict';
  		var snackbarContainer = document.querySelector('#demo-toast-example');
  		var showToastButton = document.querySelector('#plasticBag1');
  		showToastButton.addEventListener('click', function() {
    		'use strict';
    		var data = {
    			message: 'A plastic bag will charge you 1 more dollar! Your total is now $<?php echo $_SESSION["total"] + 1 ?>.',
    			timeout: 5000};
    			snackbarContainer.MaterialSnackbar.showSnackbar(data);
  			});
	}());
	</script>


</body>

</html>