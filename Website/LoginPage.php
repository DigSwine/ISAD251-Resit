<?php
include_once 'Extras/Stylesheet.php';
include_once 'Extras/Webfunctions.php';
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
    <div class="w3-content" style="padding-left: 50px;" >
        <form>
            <p>Username: <input name="user"; placeholder="Username"; type="text"></p>
            <p>Password: <input name="pass"; placeholder="Password"; type="password"></p>
            <button onclick="Login()" style="position: absolute; left: 150px">Login</button>
        </form>
    </div>
</div>
</body>
</html>
