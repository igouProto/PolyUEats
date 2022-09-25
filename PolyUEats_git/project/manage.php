<!DOCTYPE> 

<html> 
<?php
   session_start();
   if (!isset($_SESSION["can"]))  {
     $_SESSION["can"]= array();
   }

?>
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
		
		.button{
		    background-color:#498;
		    height:80px;
		    width:230px;
		    display:inline-block;
		    border:3px white double;
		    color:white;
		    font-size: 24px;
		    border-radius: 12px;
		    transition: all 0.5s;
            cursor: pointer;
		}
		
         }
    </style>
</head>
<body>
    <div id="menu" class="menu">
        <ul>
		    <li><a href="#content1" class="current">Management System</a></li>
            <li><a href="#content2">View/Manage your Order</a></li>
            <li><a href="#content3">View/Manage your Menu</a></li>
        </ul>
    </div>
	
    <div id="main" class="main">
        <h1>PolyU-Eat Canteen Food Ordering System</h1>
		<a href="logout.php" class='a1'>Log out</a>
		<div id="content1" class="content">
		<?php $can=$_GET["canteen"];
		  $_SESSION["can"] = $_GET["canteen"];
        ?>
		<h4>Welcome to <?php echo $can ?>! You can using this page to update the order status and menu lists.</h4>
        </div>
        <div id="content2" class="content">
            <h2>View/Manage Your Order</h2>
			<table>
			<?php
			    
                $servername = "localhost";
                $username = "root"; 
                $password = ""; 
                 $dbname = "project"; 
                $conn = new mysqli($servername, $username, $password, $dbname); 

                if ($conn->connect_error) { 
                  die("Connection failed: " . $conn->connect_error); 
                   } 
                $sql = "SELECT OrderNo, OrderItems FROM orders ORDER BY OrderNo"; 
                $result = $conn->query($sql); 
				$result->data_seek(0);
				
				echo "<tr><th>OrderNo</th><th>Food</th></tr>";
				while ($row=$result->fetch_assoc()) {
					echo "<tr align=\"center\"><td>".$row["OrderNo"]."</td><td>".$row["OrderItems"]."</td></tr>";					
		         }
				?>
				</table>
				<input type="button" class="button" style="vertical-align:middle" onclick="location.href='OrderList.php'" value="View Details"  />
        </div>
        <div id="content3" class="content">
            <h2>View/Manage Your Menu</h2>
            <table>
			<?php 
				$count=1;
				$conn = mysqli_connect("localhost","root","","project");
	
                 if ($conn->connect_error) {
                     echo "Unable to connect to database";
                     exit;
                    }
	  
                $query1 = "SELECT ID, FoodItem, Type, Price, Picture FROM ".$can."";
                $result1 = $conn->query($query1);
	            $result1->data_seek(0);
				
				echo "<tr><th>ID</th><th>Food Item</th><th>Type</th><th>Picture</th><th>Price</th></tr>";
				while ($row1=$result1->fetch_assoc()) {
					echo "<tr align=\"center\"><td>".$row1["ID"]."</td><td>".$row1["FoodItem"]."</td>
					<td>".$row1["Type"]."</td>
					<td><img src='".$row1["Picture"].".jpg' height='250' width='250'/></td>
					<td>".$row1["Price"]."</td></tr>";					
		         }
				 $count++;
			?>
                </table>
				<input type="button" class="button" style="vertical-align:middle" onclick="location.href='Admin.php'" value="Update the Menu"  />"

        </div>
        
    </div>
</body>
</html>