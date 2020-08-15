<?php
include_once 'Extras/Stylesheet.php';
include_once 'Extras/Webfunctions.php';
?>

<script>
    function signup(get) {
        //sending data to api
        const form = document.getElementById(get);

        form.addEventListener('submit', function (e) {
            //stop reloading
            e.preventDefault();
            //get form data
            const formData = new FormData(this);
            //send data
            fetch('../API/Members/Signup.php', {
                method: 'post',
                body: formData
            }).then(function (response) {
                return response.text();
            }).then(function (text) {
                if(text == "pass"){
                    alert("Passwords do not match, please try again");
                }
                if(text == "exists") {
                    alert("Username exists, please try again");
                }
                if(text == "nu"){
                    alert("Please fill in all text boxs, please try again")
                }
                if(text == "done"){
                    alert("Account has been created please login");
                    Loginpage();
                }
                console.log(text);
            }).catch(function (error) {
                console.error();
            })
        })
    }
</script>

<html>
<!-- Header with image -->
<div class="header">
    <h1>Sign Up Form</h1>
    <button onclick="Backtohome()" style="position: absolute; right: 50px; top: 30px">Cancel</button>
</div>
<body>
    <!-- Add a background color to the form -->
    <div id="about"; style="padding-top: 20px; max-width: 100%;">
        <!-- About Container -->
        <div id="Addform" class="views"; style="padding-top: 10px; max-width: 100%;">
            <h5>This form is for one person, once signed up you can add more members to your family when you have logged in.</h5><br>
            <div class="container" style="padding-left: 10px; max-width: 100%">
                <form id="signupform">
                    <label for="name">First Name: </label>
                    <input type="text" id="name" name="name"><br><br>
                    <label for="user">User Name: </label>
                    <input type="text" id="user" name="user"><br><br>
                    <label for="pass">Password: </label>
                    <input type="password" id="pass" name="pass"><br><br>
                    <label for="conpass">Confirm Password: </label>
                    <input type="password" id="conpass" name="conpass"><br><br><br>
                    <input type="submit" value="Submit" onclick="signup('signupform')">
                </form>
            </div>
        </div>
    </div>
</body>
</html>