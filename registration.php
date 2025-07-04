<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: 'Arial', sans-serif;
        }

        .registration-form {
            width: 100%;
            max-width: 500px;
            margin: 30px auto;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .form-header {
            font-size: 1.5rem;
            font-weight: bold;
            color: #0056b3;
            text-align: center;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .form-check-label {
            margin-left: 5px;
        }

        .btn-register {
            width: 100%;
            padding: 10px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        .btn-register:hover {
            background-color: #004085;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            color: #0056b3;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        img.logo {
            display: block;
            margin: 20px auto;
            max-width: 150px;
            border-radius: 10px;
        }
    </style>
    <script>
        function register() {
      if (username.value != "" && password.value != "" && mobile.value!="" && age.value!="" && dob.value!="" && city.value!="" ) {
        $.ajax({
          url: "functions.php",
          type: "POST",
          data: {
            "RESULT_TYPE": "REGISTRATION",
            "USERNAME": username.value,
            "PASSWORD": password.value,
            "MOBILE": mobile.value,
            "AGE": age.value,   
            "DOB": dob.value,
            "CITY": city.value,
            "GENDER":$('input[name="gender"]:checked').val(),
            "HOBBIES":getHobbies()
            
          },
          success: function(res) {
            console.log(res)
            var jobj = JSON.parse(res)
            if (jobj.result == 1) {
              toastr.success("Registration Successful")
            
              setTimeout(() => {
                window.location.replace("login.php");
              }, 1000);
 
            } else {
              toastr.error("Registration Failed")
            }


          }
        });

      } else {
        toastr.info("Enter Username and Password")
      }
    }
    function getHobbies(){
    var hobbies=""
    if($('#coding:checked'))
    hobbies=$('#coding:checked').val()+"|";

    if($('#riding').is(":checked"))
    hobbies=hobbies+$('#riding:checked').val()+"|";

    if($('#swimming').is(":checked"))
    hobbies=hobbies+$('#swimming:checked').val()

  return hobbies
  }
    </script>
</head>

<body>
    <div class="container">
        <div class="registration-form">
            <h5 class="form-header">Registration Page</h5>

            <div class="text-center">
                <img src="img/logo.jpg" alt="Logo" class="logo">
            </div>

           
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" name="username" type="text" id="username" required placeholder="Enter your username">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" name="password" type="password" id="password" required placeholder="Enter your password">
                </div>

                <div class="form-group">
                    <label for="age">Age</label>
                    <input class="form-control" name="age" type="number" id="age" placeholder="Enter your age">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input class="form-control" name="mobile" type="number" id="mobile" placeholder="Enter your Mobile">
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <div id=gender>
                        <label for="male">
                            <input class="form-check-input" type="radio" id="male" name="gender" value="Male"> Male
                        </label>
                        <label for="female">
                            <input class="form-check-input" type="radio" id="female" name="gender" value="Female"> Female
                        </label>
                        <label for="other">
                            <input class="form-check-input" type="radio" id="other" name="gender" value="other"> Other
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input class="form-control" name="dateofbirth" type="date" id="dob" name="dob">
                </div>

                <div class="form-group">
                    <label for="time">Time</label>
                    <input class="form-control" name="time" type="time" id="time">
                </div>

                <div class="form-group">
                    <label for="city">Select City</label>
                    <select class="form-control" name="city" id="city">
                        <option value="Select City">Select City</option>
                        <option value="Amravati">Amravati</option>
                        <option value="Nagpur">Nagpur</option>
                        <option value="Akola">Akola</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Hobbies</label>
                    <div id="hobbies">
                        <label>
                            <input class="form-check-input" type="checkbox" name="hobbies[]" value="Coding" id="coding"> Coding
                        </label>
                        <label>
                            <input class="form-check-input" type="checkbox" name="hobbies[]" value="Riding" id="riding"> Riding
                        </label>
                        <label>
                            <input class="form-check-input" type="checkbox" name="hobbies[]" value="Swimming" id="swimming"> Swimming
                        </label>
                    </div>
                    <input type="text" name="RESULT_TYPE" value="REGISTRATION" hidden>
                </div>

                <button type="submit" class="btn-register" onclick="register();">Register Now</button>

                <div class="form-footer">
                    <a href="login.php">Already have an account? Login Now</a>
                </div>
           
        </div>
    </div>
</body>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</html>
