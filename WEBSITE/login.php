<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    body {
    font-family: 'Poppins', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    background-image: url(img/bgpic.jpg);
    background-size: auto;
    height: 100vh;
    margin: 0;
    }
    .container {
    width: 350px;
    padding: 20px;
    border: 3px solid rgba(255, 255, 255, 0.264);
    border-radius: 28px;
    backdrop-filter: blur(50px);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    position: relative;
    transition: opacity 0.5s ease, transform 0.5s ease;
    }
    h1 {
    margin-bottom: 20px;
    text-align: center;
    color: #000000;
    }
    form {
    display: flex;
    flex-direction: column;
    }
    label {
    margin-bottom: 5px;
    font-weight: bold;
    font-size: 18px;
    color: #000000;
    }
    input {
    padding: 10px;
    margin-bottom: 10px;
    background-color: rgba(255, 255, 255, 0.723);;
    border: 1px solid #ccc;
    border-radius: 99px;
    font-size: 20px;
    font-weight: 500;
    transition: border-color 0.4s ease;
    }
    input:focus {
    border-color: #007bff;
    border-width: 3px;
    outline: none;
    }
    .password-container {
    position: relative;
    }
    .password-container input {
    padding-right: 40px; 
    }
    .password-container .eye-symbol {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 20px; 
    color: #0084ff; 
    }   
    button {
    width: 100%;
    padding: 10px 0;
    background-color: #006aff;
    color: white;
    border: none;
    border-radius: 99px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.5s ease;
    }
    button:hover {
    background-color: #034ded;
    }   
    p {
    font-size: 16px;
    text-align: center;
    margin: 0px;
    }
    a {
    color: #007bff;
    margin-left: 4px;
    text-decoration: none;
    font-weight: bold;
    }   
    a:hover {
    text-decoration: underline;
    }
    .error, .success {
    font-size: 14px;
    margin-top: -10px;
    margin-bottom: 15px;
    }
    .error {
    color: #e74c3c; 
    }
    .success {
    color: #2ecc71;  
    animation: fadeInOut 4s ease;
    }
    @keyframes fadeInOut {
        0% { opacity: 0; }
        20% { opacity: 1; }
        80% { opacity: 1; }
        100% { opacity: 0; }
    }
    .hidden {
        opacity:0;
         transform:translateY(-20px);
    }
    .login-link {
        font-size: 14px; 
        margin-top: 10px; 
        margin-bottom: 0; 
    }
    .role-selection {
        margin-bottom: 15px;
    }
        
    .regPoint{
        cursor: pointer;
    }
   
    </style>
    
 
</head>
<body>
    <!-- LOGIN PHP CODE GOES HERE-->
    <?php
    session_start();

    $generalErr=$employeeIdErr=$passwordErr=$usernameErr="";

    $servername="localhost";
    $dbusername="root";
    $dbpassword="";
    $dbname="loginpage";

 if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    function test_input($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    
    }


    $conn= new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if($conn -> connect_error){
    die("Connection error: ".$conn->connect_error);
    }

    
    $employeeId=test_input($_POST['employeeId']);
    $username=test_input($_POST['username']);
    $password=test_input($_POST['password']);

    $sql="SELECT * FROM login";

    function checkIdLen($employeeIdReg){
        $string=(string)$employeeIdReg;
        $len=strlen($string);
        if($len<8 || $len>8){
            return true;
        }
        else{
            return false;
        }
    }


    if(filter_var($employeeId,FILTER_VALIDATE_INT)==false){
        $employeeIdErr="Employee ID must be integers.";
    }
    else if(checkIdLen($employeeId)){
        $employeeIdErr="Employee ID must be only 8 numbers.";
    }
    else{
    $result=$conn->query($sql);
    if($result->num_rows >0){
    while($row=$result -> fetch_assoc()){
        if($row['username']==$username && password_verify($password,$row['password'])&&$row['employeeId']==$employeeId){
            echo"<script> alert('You have successfully log in!');</script>";
            if($employeeId==88888888){
                echo"<script>window.setTimeout(function(){ window.location.href= 'manager.php';},1000);</script>";
            }
            else{
                echo"<script>window.setTimeout(function(){ window.location.href= 'employee_main2.php';},1000);</script>";
            }
        }
        else if($row['employeeId']==$employeeId && $row['username']==$username && !password_verify($password,$row['password'])){
            $passwordErr="Wrong password. Please try again.";
        }
        else{
            $generalErr="Something not right. Please try again.";
        }
    }
    }
    

    if(isset($_POST['rmbme'])){
        $rmbme = test_input($_POST['rmbme']);
    } else {
        $rmbme = "";
    }

    if($rmbme!=""){
        setcookie($employeeId, $username,time()+(86400*30),"/");
    }
    $_SESSION["username"]=$username;
    $_SESSION["employeeId"]=$employeeId;
    
 
}
 $conn->close();



}

?>


    <!--HTML LOGIN CODE GOES HERE-->

    <div class="container" id="loginPage">
        <h1>Login</h1>
        <form id="loginForm"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="employeeId">Employee ID:</label>
            <input type="text" id="loginEmployeeId" name="employeeId" required>
            <label for="username">Username:</label>
            <input type="text" id="loginUsername" name="username" required>
            <label for="password">Password:</label>
            <div class="password-container">
                <input type="password" id="loginPassword" name="password" required>
                <span class="eye-symbol" id="loginEyeSymbol" onclick="togglePasswordVisibility('loginPassword', 'loginEyeSymbol')">🙈</span>
            </div>

            <label>
                <input type="checkbox" id="rememberMe" name="rmbme" value="true"> Remember Me
            </label>
            <p id="error-message" class="error"><?php 
                                             if($employeeIdErr!=""){
                                                echo"$employeeIdErr";
                                                }
                                              elseif($generalErr!=""){
                                                echo"$generalErr";
                                               }
                                               elseif($passwordErr!=""){
                                                echo"$passwordErr";
                                               }
                                               
                                                ?></p>
            <button type="submit">Login</button>
            <p class="login-link">Don't have an account? <a class="regPoint" onclick="showRegisterPage()">Click here to register</a></p>
        </form>
    </div>

    
    <!--JAVASCRIPT CODE GOES HERE-->
    <script>

        function togglePasswordVisibility(passwordFieldId, eyeSymbolId) {
            const passwordField = document.getElementById(passwordFieldId);
            const eyeSymbol = document.getElementById(eyeSymbolId);
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeSymbol.textContent = '👀';
            } else {
                passwordField.type = 'password';
                eyeSymbol.textContent = '🙈';
            }
        }
        function showRegisterPage() {
            const loginPage = document.getElementById('loginPage');
            loginPage.classList.add('hidden');
            loginPage.addEventListener('transitionend', ()=> {
            
            loginPage.style.display = 'none';
            setTimeout(() => {
            window.location.href="register.php";
            }, 50);

        
            
    });
}
            
        
        
      

    </script>
</body>
</html>
