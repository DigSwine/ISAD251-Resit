<?php
include_once 'Extras/Stylesheet.php';
include_once 'Extras/Webfunctions.php';
?>

<html>
<!-- Header with image -->
<div class="header">
    <h1>Login Page</h1>
</div>

<!-- Add a background color to the about section -->
<div id="about"; style="padding-top: 20px; max-width: 100%;">
    <!-- Login Container -->
    <div class="w3-content" style="padding-left: 50px;" >
        <form>
            <p>Username: <input name="user"; placeholder="Username"; type="text"></p>
            <p>Password: <input name="pass"; placeholder="Password"; type="password"></p>
            <button onclick="Login()" style="position: absolute; left: 150px">Login</button>
            <br><br>
            <button onclick="Backtohome()" style="position: absolute; left: 145px">Cancel</button>
        </form>
    </div>
</div>
</body>
</html>
