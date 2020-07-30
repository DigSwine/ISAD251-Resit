<?php
include_once 'Extras/Stylesheet.php';
include_once 'Extras/Webfunctions.php';
include_once '../API/API_GetAppointments.php';
include_once  '../API/API_GetFamily.php';
include_once  '../API/API_SendAppt.php';
session_start();
?>
<script type="text/javascript">
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

    function saveoption(sel) {
        //set the hidden textbox value
        document.getElementById('whos').value = sel.options[sel.selectedIndex].text;
    }

    function addnewappt() {
        //sending data to api
        const addform = document.getElementById("addnewappoinment");

        addform.addEventListener('submit', function (e) {
            //stop reloading
            e.preventDefault();
            //get form data
            const formData = new FormData(this);
            //send data
            fetch('../API/API_SendAppt.php', {
                method: 'post',
                body: formData
            }).then(function (response) {
                return response.text();
            }).then(function (text) {
                console.log(text);
            }).catch(function (error) {
                console.error();
            })
        })
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
                                 } else if ($cell == null) {
                                 } else {
                                     if ($x == 1) {
                                         $cell = getApptName($cell);
                                     }
                                     echo "<td>", $cell, "</td>";
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
        <form id="addnewappoinment">
            <label for="whos">Who For: </label>
            <select onchange="saveoption(this)" id="whoholder">
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
            </select>
            <input type="text" id="whos" name="whos" hidden> <br><br>
            <label for="location">Where: </label>
            <input type="text" name="location"><br><br>
            <label for="time">Time: </label>
            <input type="text" name="time"><br><br>
            <label for="date">Date: </label>
            <input type="text" name="date"><br><br><br>
            <input type="submit" value="Submit" onclick="addnewappt()">
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
