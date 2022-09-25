<html>
<head>
<script>
        function check(){
                
                var flag2=0;
                var flag3=0;
               
                if((FormA.Username.value=="")&&(FormA.password.value=="")){
                    document.getElementById("Ainfo").innerHTML="This field is required!";
                    document.getElementById("pwd").innerHTML="This field is required!";
                    flag2=0;
                }else if((FormA.Username.value!="")&&(FormA.password.value=="")){
                    document.getElementById("Ainfo").innerHTML="";
                    document.getElementById("pwd").innerHTML="This field is required!";
                    flag2=0;
                }else if((FormA.Username.value=="")&&(FormA.password.value!="")){
                    document.getElementById("Ainfo").innerHTML="This field is required!";
                    document.getElementById("pwd").innerHTML="";
                    flag2=0;
                }else{
                    flag2=1;
                }
                
                if(FormA.type.value==""){
                    document.getElementById("type").innerHTML="This field is required!";
                    flag3=0;
                }else{
                    document.getElementById("type").innerHTML="";
                    flag3=1
                }

                if((flag2==1)&&(flag3==1)){
                    return true;
                }else{
                    return false;
                }
        }
</script>
<style>
      body
        {
         margin: 0;
         padding: 0;
         background: #DDD;
         font-size: 16px;
         color: #222;
         font-family: 'Roboto', sans-serif;
         font-weight: 300;
        }
        .String{
            font-style: italic;
            color: red;
        }
        #login-box {
           position: relative;
           margin: 5% auto;
           width: 800px;
           height: 600px;
           background: #FFF;
           border-radius: 2px;
           box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        } 
        .login {
           position: absolute;
           top: 0;
           left: 0;
           box-sizing: border-box;
           padding: 40px;
           width: 300px;
           height: 400px;
        }
        h1 {
           margin: 0 0 20px 0;
           font-weight: 300;
           font-size: 28px;
        }
        input[type="text"],input[type="password"] {
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
        input[type="text"]:focus,input[type="password"]:focus {
           border-bottom: 2px solid #16a085;
           color: #16a085;
           transition: 0.2s ease;
        }
        /**/
       
</style>
</head>
<body>
	<form name="FormA" method="POST" action="LogIn.php" onsubmit="return check()">
       
     <div id="login-box">
     <div class="login">
        <h1>Log in</h1>
        

           <input type="text" name="Username" placeholder="Username" />
            <span id="Ainfo" class="String"></span><br/>
           <input type="password" name="password" placeholder="Password"/>
            <span id="pwd" class="String"></span><br/>
       
        <input type="radio" name="type" id = "type" value="Customer"><label>Customer</label>
        <input type="radio" name="type" id = "type" value="Admin"><label>Admin</label><br/><span id="type" class="String"></span><br>
        
        <input class="sub" type="submit" value="Log in" /><input class="but" type="button" value="Register" onclick="location.href='Register.php'"/>
    </div>
    </div> 
  </form>    

    <?php 

      session_start();

      $flag=0;

      if(isset($_POST["Username"]) && isset($_POST["password"])  && isset($_POST["type"]) && ($_POST["Username"] != Null) && ($_POST["password"] != NULL) && ($_POST["type"]) != NULL){
  
        $name=$_POST["Username"];
        $pwd=$_POST["password"];    
        $type=$_POST["type"];
       
        if(isset($_POST["Name"]))
        {
            $_SESSION["Name"]=$_POST["Name"];
        }
        $_SESSION["type"] = $_POST["type"];
        

        if($type=="Customer"){
            
            $conn = mysqli_connect("localhost", "root", "", "project");
        
       
            if ($conn->connect_error)  {
               echo "Unable to connect to the database";
               exit;
            }

             $sql = "SELECT Name, Password FROM customer"; 
             $result = $conn->query($sql); 
  
       
             if(!$result) die("No information");

             $result->data_seek(0);
        
             while($row = $result->fetch_assoc()) {   
                if(($name==$row["Name"])&&($pwd==$row["Password"])){
                  $flag=1;
                  break;   
                }else{
                  $flag=5; 
                }
             } 
            $result->free();
            $conn->close(); 
        }else{
                
                $conn = mysqli_connect("localhost","root","","project");
        
       
                if ($conn->connect_error)  {
                    echo "Unable to connect to the database";
                    exit;
                }
                $sql = "SELECT Name, Password FROM Administrator"; 
                $result = $conn->query($sql); 
  
       
                 if(!$result) die("No information");

                 $result->data_seek(0);
        
                  while($row = $result->fetch_assoc()) {   
                        if(($name==$row["Name"])&&($pwd==$row["Password"])){
                           $flag=2;
                           break;   
                        }else{
                           $flag=5; 
                        }
                  } 
                  $result->free();
                  $conn->close(); 
        }
    
  
        if($flag==0){
            echo "";  
        }else if($flag==5){
            echo "<script>alert(\"Username or password is not correct!\");</script>";
            
        }else if($flag==1){
             
            header("Refresh:0;url=Canteen.php");
        }else{
            
            header("Refresh:0;url=Canteen.php");
        }
       
    }     
        
    ?> 
 
</body>
</html>