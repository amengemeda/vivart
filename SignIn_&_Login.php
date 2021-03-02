<!DOCTYPE html>
<html lang>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link

        />
    <link href="css/style.css" type="text/css" rel="stylesheet"/>
    <title>Login & SignUp</title>
</head>

<body>
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form id="formRegister" action="#">
            <h1 id="title">Create Account</h1>
            <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>or use your email for registration</span>
            <label>
                <input name="first_name" placeholder="First Name" type="Name"/>
                <input name="last_name" placeholder="Last Name" type="Name"/>
                <input name="email" type="email" placeholder="Email"/>
                <input name="password" type="password" placeholder="Password"/>
                <input name="conf_password" placeholder="Confirm Password" type="password"/>
            </label>
            <p class="error" id="reg_error"></p>
            <p class="success" id="reg_success"></p>
            <button type="submit">Sign Up</button>
            <!-- <p id="Message" style='color:red; margin-left: 39px;'>Hey</p> -->
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form id="formLogin"action="#">
            <h1 id="title">Sign in</h1>
            <div class="social-container">
                <a href=".idea/Pictures/facebook-f-brands.svg" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href=".idea/Pictures/google-brands.svg" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href=".idea/Pictures/linkedin-in-brands.svg" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>or use your account</span>
            <label>
                <input type="email" name="user_email" placeholder="Email" />
                <input type="password" name="user_password" placeholder="Password" />
            </label>
            
            <button type="submit">Sign In</button>
            <p id="Message" style='color:red; margin-left: 39px;'></p>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <img src=".idea/Pictures/emoticon-square-smiling-face-with-closed-eyes.svg" alt="Avatar">
                <br>
                <h1>Hello, Friend!</h1>
                <p>Join and start your journey with us by sharing your work with the masses</p>
                <button class="ghost" id="signIn">Sign In</button>
                <a href="index.html"><button class="ghost" id="Quit">Cancel</button></a>
            </div>
            <div class="overlay-panel overlay-right">
                <img id="emoji" src=".idea/Pictures/emoticon-square-smiling-face-with-closed-eyes.svg" alt="Avatar">
                <br>
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="ghost" id="signUp">Sign Up</button>
                <a href="index.html"><button class="ghost" id="cancel">Cancel</button></a>
            </div>
        </div>
    </div>
</div>

<script src="js/style.js"></script>
<script src="js/script.js"></script>
<script src="https://kit.fontawesome.com/d728f4e8e5.js" crossorigin="anonymous"></script>
</body>

</html>
