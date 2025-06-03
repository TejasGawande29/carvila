

<!-- <?php
    include_once("Layouts/header.php")
    ?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        /* Reset margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            /* Soft gray background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 10px;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            /* Gradient background for the container */
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            /* Subtle shadow for depth */
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .login-container img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .login-container h2 {
            color: white;
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: bold;
        }

        .input-group {
            margin-bottom: 25px;
            text-align: left;
        }

        .input-group span {
            font-size: 14px;
            color: #ddd;
            /* Lighter color for labels */
            display: block;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-size: 16px;
            color: #333;
            background-color: #fff;
            transition: border 0.3s ease;
        }

        .input-group input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .forgot-password {
            text-align: right;
            font-size: 14px;
            color: #ddd;
        }

        .login-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #45a049;
        }

        .signup-link {
            margin-top: 25px;
            font-size: 14px;
            color: #ddd;
        }

        .signup-link a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .external-links {
            margin-top: 40px;
            font-size: 14px;
            text-align: center;
            color: #fff;
        }

        .external-links a {
            text-decoration: none;
            color: #ddd;
            margin: 5px;
        }

        .external-links a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function login() {
            if (userid.value != "" && password.value != "") {
                $.ajax({
                    url: "functions.php",
                    type: "POST",
                    data: {
                        "RESULT_TYPE": "LOGIN",
                        "USERID": userid.value,
                        "PASS1": password.value,

                    },
                    success: function(res) {
                        console.log(res);
                        var jobj=JSON.parse(res);
                        if(jobj.result==1){
                            toastr.success("Login Success")
                            setTimeout(() => {
                                window.location.replace("index.php?id=index");
                            }, 500);
                            
                        }else{
                            toastr.error("Login Failed")
                        }
                    }
                });
            } else {
                toastr.info("Enter UserName and Password...!")
            }
           
        }
    </script>
</head>

<body>


    <div class="login-container">

        <img src="../img/login.jpg" alt="login">
        <h2>Admin Login Form</h2>

        <div class="input-group">
            <span>Username:</span>
            <input type="text" name="userid" placeholder="Mobile or Email" id="userid" required>
        </div>
        <div class="input-group">
            <span>Password:</span>
            <input onkeypress="passwordChanged(event);" type="password" name="pass1" placeholder="Password" id="password" required>
            <!-- <input type="text" name="RESULT_TYPE" value="LOGIN" hidden> -->
        </div>
        <div class="forgot-password">
            <a href="#">Forget Password?</a>
        </div>
        <button type="submit" class="login-button" onclick="login();">Login Now</button>

    </div>
<script>
    function passwordChanged(event){
        if(event.code=="Enter"){
            login();
        }
        console.log(event);
    }
</script>
</body>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



</html>