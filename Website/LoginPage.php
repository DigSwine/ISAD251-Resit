<?php
include_once 'Extras/Stylesheet.php';
include_once 'Extras/Webfunctions.php';
include_once '../API/API_Login.php';
?>

<html>
<!-- Header with image -->
<div class="header">
    <h1>Login Page</h1>
    <button onclick="Backtohome()" style="position: absolute; right: 50px; top: 30px">Cancel</button>
</div>
<body>
<!-- Add a background color to the form -->
<div id="about"; style="padding-top: 20px; max-width: 100%;">
    <!-- Login Container -->
    <div class="container" style="padding-left: 50px;" >
        <form id="loginform">
            <label for="user">Username: </label>
            <input id="user" name="user"; placeholder="Username"; type="text"><br><br>
            <label for="pass">Password: </label>
            <input id="pass" name="pass"; placeholder="Password"; type="password"><br><br><br>
            <input type="submit" value="Submit" onclick="compare('loginform')">
        </form>
    </div>
</div>
</body>
</html>

<script>
    function compare(get) {
        //sending data to api
        const form = document.getElementById(get);

        form.addEventListener('submit', function (e) {
            //stop reloading
            e.preventDefault();
            //get form data
            const formData = new FormData(this);
            //send data
            fetch('../API/API_Login.php', {
                method: 'post',
                body: formData
            }).then(function (response) {
                return response.text();
            }).then(function (text) {
                console.log(text);
                if(text == "P"){
                    openParent();
                } else if (text == "C"){
                    openChild();
                } else {
                 alert("Username or Password is incorrect: Please try again.")
                }

            }).catch(function (error) {
                console.error();
            })
        })
    }
</script>