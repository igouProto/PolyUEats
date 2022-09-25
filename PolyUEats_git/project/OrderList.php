<html> 

  

<head> 

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

input[type="text"],
input[type="password"] {
  display: block;
  box-sizing: border-box;
  margin-bottom: 20px;
  padding: 4px;
  width: 220px;
  height: 32px;
  border: none;
  border-bottom: 1px solid #AAA;
  font-family: 'Roboto', sans-serif;
  font-weight: 400;
  font-size: 15px;
  transition: 0.2s ease;
}

input[type="text"]:focus,
input[type="password"]:focus {
  border-bottom: 2px solid #16a085;
  color: #16a085;
  transition: 0.2s ease;
}

input[type="submit"] {
  margin-top: 28px;
  width: 120px;
  height: 32px;
  background: #16a085;
  border: none;
  border-radius: 2px;
  color: #FFF;
  font-family: 'Roboto', sans-serif;
  font-weight: 500;
  text-transform: uppercase;
  transition: 0.1s ease;
  cursor: pointer;
}

input[type="submit"]:hover,
input[type="submit"]:focus {
  opacity: 0.8;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
  transition: 0.1s ease;
}

input[type="submit"]:active {
  opacity: 1;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
  transition: 0.1s ease;
}

.or {
  position: absolute;
  top: 180px;
  left: 280px;
  width: 40px;
  height: 40px;
  background: #DDD;
  border-radius: 50%;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
  line-height: 40px;
  text-align: center;
}
	</style>

</head> 

  

<body> 

  

    <form action='processing.php' method='post'> 
     

    <?php 
	
		//Start the session
		session_start();

        $servername = "localhost"; 

        $username = "root"; 

        $password = ""; 

        $dbname = "project"; 

  

        // Create connection 

        $conn = new mysqli($servername, $username, $password, $dbname); 

        // Check connection 

        if ($conn->connect_error) { 

            die("Connection failed: " . $conn->connect_error); 

        } 

  
		//Display the OrderNo, OrderItems, PickupTime, Status and order it according to OrderNo (ASC)
        $sql = "SELECT OrderNo, OrderItems, PickupTime, Status FROM orders ORDER BY OrderNo"; 

        $result = $conn->query($sql);
        

    $_SESSION['index'] = 0; // this is to differentiate the button names.

    $_SESSION["can"];

    //echo $_SESSION["can"];
		
		//Create SESSION variables array to store the OrderNo.
		
		//First, we create an array.
		$order_array=array();
    
        if($_SESSION["can"] == "AmericanDiner")
        {
          print ("<a href='manage.php?canteen=AmericanDiner'> Back</a>");
        }
        else if ($_SESSION["can"] == "VACanteen")
        {
          print ("<a href='manage.php?canteen=VACanteen'> Back</a>");
        }

         

        if ($result->num_rows > 0) {

            // output data of each row 

            while($row = $result->fetch_assoc()) { 

                $items = preg_split("/,/", $row["OrderItems"]); 

                print("<p> OrderNo: " . $row["OrderNo"]. "</p><p> ETA: " . $row["PickupTime"]. "</p><p> Status: " . $row["Status"]. "</p>"); 

                
				print("<p> food: <ul>"); 

                for($i = 0; $i< count($items); $i++) 

                { 

                    print( "<li>". $items[$i]. "</li>"); 

                } 

                print("</ul>"); 
				
				//Modify the current status of each order.
				print("<p><input name='status". $_SESSION['index'] ."' type='radio' value='confirmed' checked='checked'>confirmed</option>
					  <input name='status". $_SESSION['index'] ."' type='radio' value='preparing'>preparing</input>
					  <input name='status". $_SESSION['index'] ."' type='radio' value='ready'>ready</input>
					  <input name='status". $_SESSION['index'] ."' type='radio' value='complete'>complete</input></p>");
					
				//Store the OrderNo to the order_array.
				$order_array[$_SESSION['index']] = $row["OrderNo"];
				
				$_SESSION['index']++;

            }
			//The submit button will bring the page to processing.php
                print("<p><input type='submit' name = 'update' value = 'update'></p>");
                print("</form>");
                if($_SESSION["can"] == "AmericanDiner")
                {
                  print ("<a href='manage.php?canteen=AmericanDiner'>Back</a>");
                }
                else if ($_SESSION["can"] == "VACanteen")
                {
                  print ("<a href='manage.php?canteen=VACanteen'>Back</a>");
                }
                //print ("<a href='List.html' class='current'>Back</a>");
				
		//Store order_array to the SESSION variable
		$_SESSION['OrderNo'] = $order_array;

        } else { 

            echo "0 results"; 

        }
		
         

    ?> 

  <h1> Peak time for people to Order.</h1>
  <?php 
        //Display the OrderNo, OrderItems, PickupTime, Status and order it according to OrderNo (ASC)
        $sql2 = "SELECT HOUR(OrderTime) as `hour` , COUNT(*) FROM `orders` GROUP BY HOUR(OrderTime) order BY COUNT(*) DESC "; 

        $result2 = $conn->query($sql2);

        $hour = array();

        $i=0;

        if ($result2->num_rows > 0) {

            while($row2 = $result2->fetch_assoc()) { 
                
                $hour[$i] = $row2["hour"];
                $i++;
            } 

        }
  ?>
  

  <p> The peak hour is (in 24 hour format): <?php echo $hour[0];?>

</p>

  <?php $conn->close(); ?>
</body> 


</html>

 