<?php
include_once 'Extras/Stylesheet.php';
include_once 'Extras/Webfunctions.php';
?>

<html>
<!-- Header with image -->
<div class="header">
    <h1>Welcome [-]</h1>
    <button onclick="Logout()" style="position: absolute; right: 50px; top: 30px">Log out</button>
</div>
<body>
<!-- Add a background color to the about section -->
<div id="about"; style="padding-top: 20px; max-width: 100%;">
    <!-- About Container -->
    <div class="w3-content" style="padding-left: 50px;" >
        <h5>List of upcoming appointments:</h5>
        <div>
            <ls>Danny, Doctors, 25/07/2020</ls>
            <ls>Jeff, Doctors, 25/07/2020</ls>
            <ls>Clara, Dentist, 29/07/2020</ls>
            <ls>Stacy, Opticians, 25/08/2020</ls>

        </div>
    </div>
</div>
</body>
</html>