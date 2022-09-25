
<html> 
  
<head> 
    <style type="text/css">
.String{
  padding: 60px;
  text-align: center;
  background: #1abc9c;
  color: white;
  font-size: 30px;
  }
.choice{
    text-align: center;
}

.card{
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    background-color: #fff;
    width: 300px;
    margin: 1cm 1cm 1cm 1cm;
    text-align: center;
    font-family: arial;
    display: inline-block;
  }
 
.add{
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

.add:hover {
  opacity: 0.7;
}
.logout {
   position:fixed;
   right:10px;
   top:10px;
}
.logout:hover {
  opacity: 0.7;
}

    </style>

</head> 
  
<body> 
      
    <?php 
    session_start();
    $name = $_SESSION["type"];
    //$name = $_POST["type"];
    //$name = "vvvv";
    if($name=="Customer"){
      echo( "
      <form name='FormA' method='GET' action='Menu.php'>
      <h1 class='String' >Please Choose One Canteen</h1>
     <div class='choice'>
        <div class='card'><img src='2.jpg' height='300' width='300'>
        <p><input class='add' type='submit' name='canteen' value='VACanteen'/></p>
        </div>
        <div class='card'><img src='1.jpg' height='300' width='300'>
        <p><input class='add' type='submit' name='canteen' value='AmericanDiner'/></p></div>
        <input class='logout' type='button' name='Log out' value='Log out' onclick='location.href='logout.php''/>
      
    </form>
    ");
    }else{
      echo ("
      <form name='FormA' method='GET' action='manage.php'>
      <h1 class='String' >Please Choose One Canteen</h1>
      <div class='choice'>
        <div class='card'><img src='2.jpg' height='300' width='300'>
        <p><input class='add' type='submit' name='canteen' value='VACanteen'/></p>
        </div>
        <div class='card'><img src='1.jpg' height='300' width='300'>
        <p><input class='add' type='submit' name='canteen' value='AmericanDiner'/></p></div>
        <input class='logout' type='button' name='Log out' value='Log out' onclick='location.href='logout.php''/>  
      </form>
    ");
    }
    ?>
    
   
    

  
</body> 
  
</html> 
 
      


