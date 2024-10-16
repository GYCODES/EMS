<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
       
    .login-link {
        font-size: 14px; 
        margin-top: 10px; 
        margin-bottom: 0; 
    }   
    .role-selection {
        margin-bottom: 15px;
    }
    .hidden{
        display:none;
    }
    .hiddenreg{
        opacity: 0;
        transform :translateY(20px);
    }
    .loginPoint{
        cursor: pointer;
    }
    </style>
</head>
<body>
    <?php
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "loginpage";

    $employeeIdRegErr = $roleRegErr = $usernameRegErr = $passwordRegErr = $passwordRegLenErr= "";
    $errorEm = $errorUser = $errorRole = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        //Function to ensure safety of form data
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //Retrieve form data
        $usernameReg = test_input($_POST['usernameReg']);
        $passwordReg = test_input($_POST['passwordReg']);
        $roleReg = test_input($_POST['roleReg']);
        $employeeIdReg = test_input($_POST['employeeIdReg']);

        //Functions to check any errors
        function checkPasswordNum($passwordReg){
            $patternNum="/[0-9]/";
            if (!preg_match($patternNum, $passwordReg)) {
                return true;
            }
            else{
                return false;
            }
        }

        function checkPasswordChar($passwordReg){
            $patternChar="/[!@#$%^&*(),.?\":{}|<>]/";
            if (!preg_match($patternChar, $passwordReg)) {
                return true;
            }
            else{
                return false;
            }
        }
        function checkPasswordLen($passwordReg){
            $str=(string)$passwordReg;
            $length=strlen($str);
            if($length<8){
                return true;
            }
            else{
                return false;
            }
        }

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
        //If Employee ID Error Exists
        if (!filter_var($employeeIdReg, FILTER_VALIDATE_INT)) {
            $employeeIdRegErr="Employee ID can only be integers.";
            $errorEm=true;
        } else if(checkIdLen($employeeIdReg)){
            $employeeIdRegErr="Employee ID must be only 8 numbers.";
            $errorEm=true;
        }

        //If Password Error Exists
        if(checkPasswordNum($passwordReg)){
            $passwordRegErr = "Password must include at least one number.";
        }
        else if(checkPasswordChar($passwordReg)){
            $passwordRegErr="Password must include at least one special character.";
        }
        else if(checkPasswordLen($passwordReg)){
            $passwordRegErr="Password must be at least 8 characters long.";
        }

        

        //No error above then continue
        if (empty($usernameRegErr) && empty($passwordRegErr) && isset($roleReg) && empty($roleRegErr) && empty($employeeIdRegErr)) {
            
                $passwordReg = password_hash($passwordReg, PASSWORD_DEFAULT);

                $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } else {
                    $sqlUsrchck = "SELECT * FROM login WHERE username=?";
                    $prpsqlUsrchck = $conn->prepare($sqlUsrchck);
                    $prpsqlUsrchck->bind_param("s", $usernameReg);
                    $prpsqlUsrchck->execute();
                    $usernamexists = $prpsqlUsrchck->get_result();

                    $sqlEIDchck = "SELECT * FROM login WHERE employeeId=?";
                    $prpsqlEIDchck = $conn->prepare($sqlEIDchck);
                    $prpsqlEIDchck->bind_param("i", $employeeIdReg);
                    $prpsqlEIDchck->execute();
                    $employeeIdexists = $prpsqlEIDchck->get_result();

                    if ($usernamexists->num_rows > 0) {
                        $usernameRegErr="Username exists.";
                        $errorUser = true;
                        $prpsqlUsrchck->close();
                    } else if ($employeeIdexists->num_rows > 0) {
                        $employeeIdRegErr="Employee ID exists.";
                        $errorEm = true;
                        $prpsqlEIDchck->close();
                    }

                    else if ($roleReg === "manager") {
                        $pattern = "/88888888/";
                        if (!preg_match($pattern, $employeeIdReg)) {
                            $employeeIdRegErr="You are not a manager.";
                            $errorRole = true;
                        }
                    }
                    else if ($roleReg === "employee"){
                        $pattern = "/88888888/";
                        if (preg_match($pattern, $employeeIdReg)) {
                            $employeeIdRegErr="You are not a manager.";
                            $errorRole = true;
                        }
                    }
                     else {
                        $errorEm = false;
                        $errorUser = false;
                        $errorRole = false;
                    }

                    if (!$errorEm && !$errorUser && !$errorRole) {
                        $sqlreg = "INSERT INTO login(username, password, role, employeeId) VALUES (?, ?, ?, ?)";
                        $prpsqlreg = $conn->prepare($sqlreg);
                        $prpsqlreg->bind_param("sssi", $usernameReg, $passwordReg, $roleReg, $employeeIdReg);
                        if ($prpsqlreg->execute()) {
                            echo "<script>alert('Successfully registered!'); window.setTimeout(function(){ window.location.href='login.php'; }, 1000);</script>";
                        } else {
                            echo "Error: " . $sqlreg . "<br>" . $conn->error;
                        }
                        $prpsqlreg->close();
                    }

                    $conn->close();
                }
            
        }
    }
    ?>

    <div class="container" id="registerPage">    
        <h1>Register</h1>
        <form id="registerForm"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="employeeId">Employee ID:</label>
            <input type="text" id="regEmployeeId" name="employeeIdReg" required>
            <label for="username">Username:</label>
            <input type="text" id="regUsername" name="usernameReg" required>
            <label for="password">Password:</label>
            <div class="password-container">
                <input type="password" id="regPassword" name="passwordReg" required>
                <span class="eye-symbol" id="registerEyeSymbol" onclick="togglePasswordVisibility('regPassword', 'registerEyeSymbol')">🙈</span>
            </div>
            <div class="role-selection">
                <label for="role">Role:</label>
                <select id="role" name="roleReg" required>
                    <option value="employee">Employee</option>
                    <option value="manager">Manager</option>
                </select>
            </div>
            <p id="error-message" class="error">
            
                   <?php 
                   if($employeeIdRegErr!=""){
                    echo"$employeeIdRegErr";
                   }
                   else if($usernameRegErr!=""){
                    echo"$usernameRegErr";
                   }
                   else if($passwordRegErr!=""){
                    echo"$passwordRegErr";
                    }?></p>
            <p id="success-message" class="success hidden">Successfully registered! Redirecting to login...</p>
            <button type="submit">Register</button>
            <p class="login-link">Already have an account? <a class="loginPoint" onclick="showLoginPage()">Click here to login</a></p>
        </form>
    </div>

    <script>

        function showLoginPage() {
          
            const registerPage = document.getElementById('registerPage');
            registerPage.classList.add('hiddenreg');
            registerPage.addEventListener('transitionend',()=>{
                 // Hide success message
                document.getElementById('success-message').classList.add('hidden');
                // Clear registration form 
                document.getElementById('regEmployeeId').value = '';
                document.getElementById('regUsername').value = '';
                document.getElementById('regPassword').value = '';
                document.getElementById('role').value = 'employee'; // Reset role to default
                document.getElementById('error-message').textContent = '';
                registerPage.style.display = 'none';
                setTimeout(() => {
                window.location.href="login.php";
            }, 50);
        });
        }

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


 

    </script>
</body>
</html>




    </script>
</body>
</html>
