<?php
session_start();
if(isset($_SESSION['email']))
{
  header('Location:week.php');
}

?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexP.css">
    <title>Your Website</title>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
        <nav>
            <div class="Left">
                <h2> Conference Booking System </h2> 
            </div>
            <div class="login">
                <a href="#" id="loginLink">Login</a>
            </div>
            <div class="signup">
                <a href="#" id="signupLink">Sign Up</a>
            </div>  
        </nav>
<div id="signupForm" class="form hidden">
    <div class="container">
    <div class="title">Sign Up</div>
    <div class="content">
      <form onsubmit="return Signvalidation()" action="register.php" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details"> First Name </span>
            <input type="text" id="fname" name="fname" placeholder="Enter your name">
            <span class="error" id="fnameError"></span>
          </div>
          <div class="input-box">
            <span class="details"> Last Name </span>
            <input type="text" id="lname" name="lname" placeholder="Enter your name">
            <span class="error" id="lnameError"></span>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" id="email" name="email" placeholder="Enter your email">
            <span class="error" id="emailError"></span>
          </div>
          <div class="input-box">
            <span class="details">Phone No</span>
            <input type="number" id="phone" name="phone" placeholder="Enter phone number">
            <span class="error" id="phoneError"></span>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" id="password" name="password" placeholder="Enter your password">
            <span class="error" id="passwordError"></span>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" id="cpassword" placeholder="Confirm your password">
            <span class="error" id="cpasswordError"></span>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="sign in" name="signin">
        </div>
      </form>
    </div>
  </div>
</div>

<div id="loginForm" class="form hidden">
  <div class="logcontainer">
        <div class="log-container" id="login-form">
            <div class="title">Log in</div>
            <form onsubmit="return Logvalidation()" action="loguser.php" method="post">
                <div class="loginput-box">
                    <label for="email">Email</label>
                    <input type="email" name="logemail" id="logemail" placeholder="Enter your email">
                    <span class="logerror" id="logemailError"></span>
                </div>
                <div class="loginput-box">
                    <label for="password">Password</label>
                    <input type="password" name="logpassword" id="logpassword" placeholder="Enter your password">
                    <span class="logerror" id="logpasswordError"></span>
                </div>
                <div class="logbutton">
                    <input type="submit" value="login" name="login">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="SignLogScript.js"></script>


</body>
</html>
