<?php
include_once 'Extras/Stylesheet.php';
include_once 'Extras/Webfunctions.php';
include_once '../API/API_GetAppointments.php';
include_once  '../API/API_GetFamily.php';
include_once  '../API/API_SendAppt.php';
session_start();
?>
<script>
    function onload(){
        <?php
        getAppts();
        ?>
        addappt();
        editappt();
        deleteappt();
    }

    function Logout(){
        <?php
        session_destroy();
        ?>
        Backtohome();
    }

    function addappt(){
        var x = document.getElementById("Addform");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    function editappt(){
        var x = document.getElementById("Editform");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    function deleteappt(){
        var x = document.getElementById("Deleteform");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    function subAdd(){
        <?php
            #echo $_POST["newappt"];

        ?>
        addappt();
    }
</script>

<html>
<!-- Header -->
<div class="header">
    <h1>Welcome <?php echo $_SESSION["name"] ?></h1>
    <button onclick="Logout()" style="position: absolute; right: 50px; top: 30px">Log out</button>
</div>
<body onload="onload()">
<!-- Appt section -->
<div class="views"; style="padding-top: 20px; max-width: 50%;">
    <div class="w3-content" style="padding-left: 50px;">
        <button onclick="addappt()">Add Appointment</button>
        <button>Edit Appointment</button>
        <button>Delete Appointment</button>
        <br><br>
    </div>
    <div class="w3-content" style="padding-left: 50px;" >
        <h5>List of upcoming appointments:</h5>
        <div>
            <table>
                <tr>
                    <th>Who For</th>
                    <th>Where</th>
                    <th>Time</th>
                    <th>Date</th>
                </tr>
                <tr>
                     <?php
                     $results = $_SESSION["Appts"];
                     $x = 0;
                     if ($results != null) {
                         foreach ($results as $row) {
                             foreach ($row as $cell) {
                                 if ($x == 0) {
                                 } else if ($x == 2) {
                                 } else if ($cell == null){
                                     } else {
                                     if ($x == 1) {
                                         $cell = getApptName($cell);
                                     }
                                     if ($x == 4) {
                                         $dateandtime = explode(" ", $cell);
                                         echo "<td>", $dateandtime[1], "</td>";

                                         $datereversed = date("d-m-Y", strtotime($dateandtime[0]));
                                         echo "<td>", $datereversed, "</td>";
                                     } else {
                                         echo "<td>", $cell, "</td>";
                                     }
                                 }
                                 $x = $x + 1;
                             }
                             #add new line and reset x
                             echo "<tr>", "</tr>";
                             $x = 0;
                         }
                     }
                     ?>
                </tr>
            </table>
        </div>
    </div>
</div>
<div id="Addform" class="views"; style="padding-top: 20px; max-width: 50%;">
    <div class="container" style="padding-left: 10px; max-width: 100%">
        <form method="post" name="newappt">
            <label>Who For: </label>
            <select id="whos">
                <?php
                retriveFam();

                $results = $_SESSION["Testing"];
                if ($results != null) {
                    foreach ($results as $row) {
                        foreach ($row as $cell) {
                            echo "<option value='" . $cell . "'>", $cell, "</option>";
                        }
                    }
                }
                ?>
            </select><br><br>
            <label>Where: </label>
            <input type="text" id="location"><br><br>
            <label>Time: </label>
            <input type="text" id="time"><br><br>
            <label>Date: </label>
            <input type="text" id="date"><br><br><br>
            <input type="submit" value="Submit" onclick="subAdd()">
        </form>
    </div>
</div>
<div id="Editform" class="views"; style="padding-top: 20px; max-width: 50%;">

<p>editform</p>
</div>
<div id="Deleteform" class="views"; style="padding-top: 20px; max-width: 50%;">

<p>deleteform</p>
</div>
</body>
</html>
