<?php
include_once 'Extras/Stylesheet.php';
include_once 'Extras/Webfunctions.php';
?>

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
        <div class="w3-content" style="padding-left: 50px;" >
            <h5>This form is for one person, once signed up you can add more members to your family</h5>
            <form style="max-width: 30%;">
                <div class="views">
                    First Name<br><br>
                    Family Name<br><br>
                    User Name<br><br>
                    Password<br><br>
                    Confirm Password<br><br>
                </div>
                <div class="views">
                    <input type="text" placeholder="First Name" style="height: 25px"><br><br>
                    <input type="text" placeholder="Family Selected Name" style="height: 25px"><br><br>
                    <input type="text" placeholder="Username" style="height: 25px"><br><br>
                    <input type="password" placeholder="Password" style="height: 25px"><br><br>
                    <input type="password" placeholder="Confirm Password" style="height: 25px"><br><br>
                </div>

                <button onclick="Signup()" style="width: 400px">Submit</button>
            </form>


        </div>
    </div>
</body>
</html>