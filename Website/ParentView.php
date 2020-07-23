<?php
include_once 'Extras/Stylesheet.php';
include_once 'Extras/Webfunctions.php';
include_once '../API/API_GetAppointments.php';
?>
<script>
    function onload(){
        getAppts();
        <?php
           echo $_SESSION["appts"];


        ?>
    }
</script>
<html>
<!-- Header with image -->
<div class="header">
    <h1>Welcome</h1>
    <button onclick="Logout()" style="position: absolute; right: 50px; top: 30px">Log out</button>
</div>
<body onload="onload()">
<!-- Add a background color to the about section -->
<div id="about"; style="padding-top: 20px; max-width: 100%;">
    <!-- About Container -->
    <div class="w3-content" style="padding-left: 50px;" >
        <h5>List of upcoming appointments:</h5>
        <div>
            <table>
                <tr>
                
                    <th style="padding-left: 10px">Who For</th>
                    <th style="padding-left: 10px">Where</th>
                    <th style="padding-left: 10px">Time</th>
                    <th style="padding-left: 10px">Date</th>
                </tr>
                <tr>
                    <td style="padding-left: 10px">Jeff</td>
                    <td style="padding-left: 10px">11am</td>
                    <td style="padding-left: 10px">25/07/2020</td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>

