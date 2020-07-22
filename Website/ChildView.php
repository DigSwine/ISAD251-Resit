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
        <h5>List of upcoming deadlines:</h5>
        <div>
            <table>
                <tr>
                    <th style="padding-left: 10px">Class</th>
                    <th style="padding-left: 10px">Time Due</th>
                    <th style="padding-left: 10px">Date Due</th>
                </tr>
                <tr>
                    <td style="padding-left: 10px">History</td>
                    <td style="padding-left: 10px">11pm</td>
                    <td style="padding-left: 10px">25/07/2020</td>
                </tr>

                <?php
                $deadlines = array();

                array_push($deadlines, "History, 1pm, 22/07/2020", "Art, 2pm, 22/07/2020", "ICT, 10am, 23/07/2020", "English, 11am, 25/07/2020");

                foreach($deadlines as $deadline) {
                    echo '<p>' . "$deadline" . '</p>';
                }
                ?>

            </table>
        </div>
    </div>



</div>
</body>
</html>