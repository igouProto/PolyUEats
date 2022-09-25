<html>
<head>
    <script type="text/javascript">
        function check() {
            flag1=0;
            flag2=0;
            flag3=0;
            var symbol=/\w+@\w+[\.]/;
            if(FormA.username.value==""){
                document.getElementById("Uname").innerHTML="This field can not be blank!";
                 flag1=0;
            }else{
                 document.getElementById("Uname").innerHTML="";
                 flag1=1;
            }


             if(FormA.email.value==""){
                document.getElementById("Email").innerHTML="This field can not be blank!";
                 flag2=0;
             }else if(!FormA.email.value.match(symbol)){
               document.getElementById("Email").innerHTML="The Email is not valid!";
               flag2=0;
             }else{
                document.getElementById("Email").innerHTML="";
                flag2=1;
             }


             if(FormA.password.value==""){
                 document.getElementById("pwd").innerHTML="This field can not be blank!";
                  flag3=0;
             }else{
                 document.getElementById("pwd").innerHTML="";
                 if(FormA.password2.value==""){
                      document.getElementById("pwd2").innerHTML="This field can not be blank!";
                      flag3=0;
                 }else if(FormA.password2.value!=FormA.password.value){
                      document.getElementById("pwd2").innerHTML="The password is not correct!";
                      flag3=0;
                 }else{
                      document.getElementById("pwd2").innerHTML="";
                      flag3=1;
                 }
            }

           
            if((flag1==1)&&(flag2==1)&&(flag3==1)){
                return true;
            }else{
                return false;
            }
      }

          
    </script>
    <style>
        .String{
            font-style: italic;
            color: red;
        }
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

#login-box {
  position: relative;
  margin: 5% auto;
  width: 800px;
  height: 600px;
  background: #FFF;
  border-radius: 2px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
}

.register {
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

.sub {
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

.sub:hover,.sub:focus {
  opacity: 0.8;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
  transition: 0.1s ease;
}

.sub:active {
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
  <form class="form" name="FormA" method="POST" action="Register.php" onsubmit="return check()">
<div id="login-box">
  <div class="register">
    <h1>Sign up</h1>
   
    <input type="text" name="username" placeholder="Username" />
    <span id="Uname" class="String"></span>
   
    <input type="text" name="email" placeholder="E-mail" />
    <span id="Email" class="String"></span>
    
    <input type="password" name="password" placeholder="Password" />
    <span id="pwd" class="String"></span>
   
    <input type="password" name="password2" placeholder="Retype password" />
    <span id="pwd2" class="String"></span>
    
    <input type="radio" name="type" value="Customer"><label>Customer</label>
    <input type="radio" name="type" value="Admin"><label>Admin</label><br>
    <input class="sub" type="submit" value="Sign me up"/>
    <input class="sub" type="button" value="Log In" onclick="location.href='LogIn.php'"/>
 </div>
</div>
    </form>
    <?php 
        
        if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["type"]) && ($_POST["username"] != NUll) && ($_POST["password"] != NULL) && ($_POST["email"] != NULL) && ($_POST["type"] != NULL )){
        
        $flag=0;
        
            $name=$_POST["username"];
            $pwd=$_POST["password"];
            $email=$_POST["email"];
            $type=$_POST["type"];
        
         if($type=="Customer"){ 

            $conn = mysqli_connect("localhost","root","","project");
         
            if ($conn->connect_error)  {
                 echo "Unable to connect to the database";
                 exit;
            }
            
            $sql = "INSERT INTO customer (Name,Password,Email) VALUES (\"".$name."\",\"".$pwd."\",\"".$email."\")";
            $result = $conn->query($sql); 
   
            if(!$result){
                echo "No information";
            }else{
                $flag=1;
                
            }
            
            $conn->close();

        }else{
             $conn = mysqli_connect("localhost","root","","project");
         
            if ($conn->connect_error)  {
                 echo "Unable to connect to the database";
                 exit;
            }
            
            $sql = "INSERT INTO Administrator (Name,Password,Email) VALUES (\"".$name."\",\"".$pwd."\",\"".$email."\")"; 
            $result = $conn->query($sql); 
   
            if(!$result){
                echo "No information";
            }else{
                $flag=2;
            }
            
            $conn->close();
        }

        if($flag==1){
          echo "<script>alert(\"Registeration is successful!\");</script>";
        }else if($flag==2){
          echo "<script>alert(\"Registeration is successful!\");</script>";
        }else{
          echo "";
        }
      }else{
        echo "";
      }
       
    ?>  
      
    
 
</body>

</html>