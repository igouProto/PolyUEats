<!DOCTYPE html>

<html>
<?php
   session_start();
   if (!isset($_SESSION["list"]))  {
     $_SESSION["list"]= array();
   }

?>

<head>
  <!-- CSS style -->
  <style type="text/css">
  /* header */
  .header {
  padding: 60px;
  background: #1abc9c;
  color: white;
  font-size: 30px;
  }

/* fonts */
  h1{color: white;}

    /* food type */
  .food_type {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    margin: 2cm 2cm 0.5cm 0.5cm; }
  .food_type h2{
    padding: 12px;
    color: #1abc9c;
  }
  .food_type h4{
    color: #1abc9c;
  }

  /* food card */
  .card{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    background-color: #fff;
    width: 250px;
    margin: 1cm 2cm 2cm 1cm;
    text-align: center;
    font-family: arial;
    display: inline-block;
  }
  .price {
  color: black;
  font-size: 22px;
}

.card button {
  border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #1abc9c;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.card button:hover {
  opacity: 0.7;
}

/* check the cart button */
.check {
  border: none;
  outline: 0;
  padding: 12px;
  color: black;
  background-color: white;
  text-align: center;
  cursor: pointer;
  width: 200px;
  font-size: 18px;
}

.check:hover {
  opacity: 0.7;
}

.sp{
  color: #d25757;
}

/* side-bar */
.menu{
position: fixed;
background:#a0db8e;
width: 260px;
height: 330px;
    right: 50%;
top: 100px;
    margin-right:450px;
}

.content{
position: relative;
    width: 1200px;
left: 10%;
    margin: 0px auto;
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
    color: white;
}
.menu li a:hover,
.menu li .current{
    background: #f1f0f4;
    color: #a0db8e;
}
.main h1{
    color: #498;
}

</style>


<script type='text/javascript'>
var list = [];//stores ids of food
var i=0; //store no. of items

//add the numbers after 'shopping car:''
    function add(foodNo) {

       xmlHttp = new XMLHttpRequest();
       i++;

          url = "MainMenu.php?q=" + i;
          list.push(foodNo);

       xmlHttp.onreadystatechange=function()  {
         if (xmlHttp.readyState == 4) {
            cart.innerHTML = i;
           }
         }

         xmlHttp.open("GET", url, true);
         xmlHttp.send(null);

         //localStorage.setItem("foodList",list);
        }

//pass the list to the next page
      function pass(){
        if (list.length == 0){
          alert("Your shopping cart is waiting for feeding...")
          return false;
        }
        //console.log(list);
        var foods = JSON.stringify(list);
        //console.log(jsondata);
        document.getElementById('foodArr').value = foods;
        return true;
      }

</script>

<?php

$conn = mysqli_connect("localhost","root","","project");

  if ($conn->connect_error)  {
 echo "Unable to connect to database";
 exit;
}

 $can=$_GET["canteen"];
 $_SESSION["can"]=$_GET["canteen"];


 $query1 = "SELECT id, fooditem as food, type as t, price as p, picture as pic FROM `".$can."` ORDER BY Popularity DESC";
 $result = $conn->query($query1);

 if ($result == false)  {
 echo "Something wrong";
 } else {
 $result->data_seek(0);
}

?>

</head>

<body>

<!-- header -->
<div class="header">
  <center>
  <h4>Welcome to</h4><h1> <?php echo $can;?></h1>
  <h3>Please select your food :)</h3>
</center>
</div>

<!-- SideBar -->
<div id="menu" class="menu">
    <ul>
    <li><a href="#Course">Course</a></li>
        <li><a href="#Drink">Drink</a></li>
        <li><a href="#Fruit">Fruit</a></li>
    </ul>
    <hr>
<center>
    <form method="get" action="confirmScreen.php" onsubmit="return pass();">
      <p>Shopping Cart: <span class="sp" id="cart">0</span></p>
      <input type="submit" value="check the cart" class="check"/>

      <!-- A hidden txt field for passing the json food list string to -->
      <input type="hidden" id="foodArr" name="foodArr">

    </form>
    <hr>
    <a href="Canteen.php">Change Canteen</a>
  </center>

</div>

<!-- food type 1 -->
<section id="content" class="content">
<div id="Course" class="food_type">
  <h2>Course</h2>

  <?php
  while ($row = $result->fetch_assoc())  {
      if (preg_match("/Course/", $row["t"])){
        echo "<div class='card' id=".$row['id']."> <img src='".$row['pic'].".jpg' height='250' width='250'/> ";
        echo "<h4>".$row['food']."</h4>";
        echo "<p class='price'>$".$row['p']."</p>";
        echo "<p><button class='add' value='1' onclick='add(".$row['id'].")'>Add to Cart</button></p></div>";
     }
   }
  ?>
</div>

<!-- food type 2 -->
<div id="Drink" class="food_type">
  <h2>Drink</h2>

  <?php
  mysqli_data_seek($result,0); //reset the pointer

  while ($row = $result->fetch_assoc())  {
      if (preg_match("/Drink/", $row["t"])){
        echo "<div class='card' id=".$row['id']."> <img src='".$row['pic'].".jpg' height='250' width='250'/> ";
        echo "<h4>".$row['food']."</h4>";
        echo "<p class='price'>$".$row['p']."</p>";
        echo "<p><button class='add' value='1' onclick='add(".$row['id'].")'>Add to Cart</button></p></div>";
     }
   }
  ?>

</div>

<!-- food type 3 -->
<div id="Fruit" class="food_type">
  <h2>Fruit</h2>

  <?php
  mysqli_data_seek($result,0); //reset the pointer

  while ($row = $result->fetch_assoc())  {
      if (preg_match("/Fruit/", $row["t"])){
        echo "<div class='card' id=".$row['id']."> <img src='".$row['pic'].".jpg' height='250' width='250'/> ";
        echo "<h4>".$row['food']."</h4>";
        echo "<p class='price'>$".$row['p']."</p>";
        echo "<p><button class='add' value='1' onclick='add(".$row['id'].")'>Add to Cart</button></p></div>";
     }
   }
  ?>

</div>
</section>


<?php
$result->free();
$conn->close();
 ?>


<!-- click shopping cart to view  -->
</body>

</html>
