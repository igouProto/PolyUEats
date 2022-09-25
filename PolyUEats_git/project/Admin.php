<?php
session_start(); //$_SESSION["can"];
$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
    $id = $_REQUEST['id'];
    $name =$_REQUEST['name'];
	$type = $_REQUEST['type'];
    $price = $_REQUEST['price'];
	$picture = $_REQUEST['picture'];
	$conn = mysqli_connect("localhost","root","","project");
    if ($conn->connect_error) {
    echo "Unable to connect to database";
    exit;
     }
    $ins_query="insert into ".$_SESSION["can"]."
    (`ID`,`FoodItem`,`Type`,`Price`,`Picture`) values
    ('$id','$name','$type','$price','$picture')";
    $result = $conn->query($ins_query);
    $status = "You have been successfully inserted a new record.<br /><a href='Admin.php'>View Inserted Record</a>";
}
?>

<!DOCTYPE> 

<html> 
    <head> 
	<style type="text/css">
	
	    body {
            margin: 0;
            padding: 0;
        }
        li{
            list-style: none;
        }
        a{
            text-decoration: underline;
        }
		.a1{
            float:right
        }
        .main{
		    position: relative;
            width: 1000px;
			left: 8%;
            margin: 40px auto;  			
        }
        .menu{
            position: fixed;
			background:#498;
			width: 260px;
            right: 50%;
			top: 100px;
            margin-right:400px;
        }
        .menu li a{
            display: block;
            margin: 5px 0;
            height: 50px;
            width: 200px;
            line-height: 40px;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            color: #333;
        }
        .menu li a:hover,
        .menu li .current{
            background: #0088bb;
            color: #fff;
        }
        .main h1{
            color: #498;
        }
        .content{
            padding: 20px;
            border: 2px solid #ddd;
            margin-bottom: 10px;
        }
        .content h2{
		    color: #498;
            border-bottom: 2px solid green;
            margin-bottom: 5px;
        }
        .content li{
            display: inline;
            margin-right: 10px;
        }
        .content img{
            width: 300px;
            height: 230px;
        }
		
		input[type=submit] {
			background-color:#498;
		    height:50px;
		    width:150px;
		    display:inline-block;
		    border:3px white double;
		    color:white;
		    font-size: 24px;
		    border-radius: 12px;
		    transition: all 0.5s;
            cursor: pointer;
		}
	
		.button{
		    background-color:#498;
		    height:80px;
		    width:400px;
		    display:inline-block;
		    border:3px white double;
		    color:white;
		    font-size: 24px;
		    border-radius: 12px;
		    transition: all 0.5s;
            cursor: pointer;
		}
		
		.button span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }

        .button span:after {
             content: '\00bb';
             position: absolute;
             opacity: 0;
             top: 0;
             right: -20px;
             transition: 0.5s;
        }

        .button:hover span {
             padding-right: 25px;
         }

         .button:hover span:after {
             opacity: 1;
             right: 0;
         }
    </style>
	<script type="text/javascript">
	function validate()  {
	var t1=0;
	if (document.getElementById("id").value == "")  {
		document.getElementById("1").className="s1";
		document.getElementById("1").innerHTML = "You need to fill in all the field! ";
		t1=1;
	} 
	if (t1==1) return false;
	else return true;
   }
	</script>
</head>
<body>
    <div id="menu" class="menu">
        <ul>
		    <li><a href="#content1" class="current">Management System</a></li>
            <li><a href="#content2">Change the Price</a></li>
            <li><a href="#content3">Change the Items</a></li>
        </ul>
    </div>
	
    <div id="main" class="main">
        <h1>PolyU-Eat Canteen Food Ordering System</h1>
		<a href="logout.php" class='a1'>Log out</a>
		<div id="content1" class="content">
		<h4> Welcome to <?php echo $_SESSION["can"] ?> </h4>
		<p>Here is the newest menu! You can update the menu by adding items or changing the price.</p>
        </div>
        <div id="content2" class="content">
            <h2>Change the Price</h2>
			<form name="form1" method="get" action="changeprice.php">
            <table>
			    <?php 
				$count=1;
				$conn = mysqli_connect("localhost","root","","project");
	
                 if ($conn->connect_error) {
                     echo "Unable to connect to database";
                     exit;
                    }
	  
                $query1 = "SELECT ID, FoodItem, Type, Price, Picture FROM ".$_SESSION["can"]."";
                $result1 = $conn->query($query1);
	            $result1->data_seek(0);
				
				echo "<tr><th>ID</th><th>Food Item</th><th>Type</th><th>Picture</th><th>Current Price</th><th>Change Price</th></tr>";
				while ($row1=$result1->fetch_assoc()) {
					echo "<tr align=\"center\"><td>".$row1["ID"]."</td><td>".$row1["FoodItem"]."</td>
					<td>".$row1["Type"]."</td>
					<td><img src='".$row1["Picture"].".jpg' height='250' width='250'/></td>
					<td>".$row1["Price"]."</td>
					<td><input type='text' name='price' id='price' placeholder='Enter the changed price' /></td>
					<td><a href='' onclick=\"this.href='changeprice.php?id=".$row1["ID"]."&price='+document.getElementById('price').value\">Update</a></td></tr>";
					
		         }
				 $count++;
				?>
            </table>
			</form>
			<div id="disInfo"></div>
        </div>
        <div id="content3" class="content">
            <h2>Change the Items</h2>
			<h3>Delete the current food item.</h3>
            <table>
				 <?php 
				$conn = mysqli_connect("localhost","root","","project");
	
                 if ($conn->connect_error) {
                     echo "Unable to connect to database";
                     exit;
                    }
	  
                $query2 = "select ID, FoodItem, Type, Price from ".$_SESSION["can"]." order by ID";
                $result2 = $conn->query($query1);
	            $result2->data_seek(0);
				echo "<tr><th>ID</th><th>Food Item</th><th>Type</th><th>Price</th><th>Delete</th></tr>";
				while ($row2=$result2->fetch_assoc()) {
					echo "<tr align=\"center\"><td>".$row2["ID"]."</td><td>".$row2["FoodItem"]."</td><td>".$row2["Type"]."</td><td>".$row2["Price"]."</td>
					          <td><a href=\"delete.php?id=".$row2["ID"]."\">Delete</a></td></tr>";
		         }
				?>
            </table>
			
			
			<h3>Add a new food item.</h3>
			<form name="form2" method="post" onsubmit="return validate()"> 
                <input type="hidden" name="new" value="1" />
                <p><input type="text" name="id" placeholder="Enter ID"/></p><span id="1" name="1">  </span>
				<p><input type="text" name="name" placeholder="Enter Food Name"/></p>
				<p><input type="text" name="type" placeholder="Enter Type"/></p>
				<p><input type="text" name="price" placeholder="Enter Price"/></p>
				<p><input type="text" name="picture" placeholder="Enter Picture"/></p>
				<input type="submit" name="submit" value="Submit"/>
            </form>
			<p style="color:#FF0000;"><?php echo $status; ?></p>
        </div>
        <button class="button" style="vertical-align:middle" onclick="location.href='manage.php?canteen=<?php echo $_SESSION["can"] ?>'"><span>Return</span></button>
    </div>
</body>
</html>