<?php
include_once 'Extras/Stylesheet.php';
include_once 'Extras/Webfunctions.php';
include_once '../API/API_GetAppointments.php';
include_once  '../API/API_SendAppt.php';
session_start();
?>
<script type="text/javascript">
    function onload(){
        <?php
        getAppts();
        ?>
        formview("Addform");
        formview("Editform");
        formview("Deleteform");
    }

    function Logout(){
        <?php
        session_destroy();
        ?>
        Backtohome();
    }

    function formview(name){
        var x = document.getElementById(name);
        if (x.style.display === "none") {
           //show
            x.style.display = "block";
        } else {
            //hide
            x.style.display = "none";
        }
    }

    function saveoption(sel) {
        //set the hidden textbox value
        document.getElementById('whos').value = sel.options[sel.selectedIndex].text;
    }

    function saveappt(get) {
        var sendto = "";
        var openedform = "";
        if(get == "addnewappoinment"){
            sendto = '../API/API_SendAppt.php';
            openedform = "Addform";
        }
        if(get == "editappoinment"){
            sendto = '../API/API_SendAppt.php';
            openedform = "Editform";
        }

        //sending data to api
        const form = document.getElementById(get);

        form.addEventListener('submit', function (e) {
            //stop reloading
            e.preventDefault();
            //get form data
            const formData = new FormData(this);
            //send data
            fetch(sendto, {
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
        formview(openedform);
    }

    function getdetails(sel){
        var text = sel.options[sel.selectedIndex].text;
        var str = text.split(" ");
        var who = str[0];
        var time = str[2];
        var date = str[3];
        console.log(who);
        console.log(time);
        console.log(date);
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
        <button onclick="formview('Addform')" id="btn_Add">Add Appointment</button>
        <button onclick="formview('Editform')" id="btn_Edit">Edit Appointment</button>
        <button onclick="formview('Deleteform')" id="btn_Delete">Delete Appointment</button>
        <br><br>
    </div>
    <div class="w3-content" style="padding-left: 50px;" >
        <h5>List of upcoming appointments:</h5>
        <div>
            <table id="maintable">
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
                <option value="select">-- Please Select Family Member --</option>
                <?php
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
            <label for="family" hidden></label>
            <input type="text" id="family" name="family" value="<?php echo $_SESSION["family"] ?>" hidden>
            <input type="text" id="whos" name="whos" hidden> <br><br>
            <label for="location">Where: </label>
            <input type="text" name="location" id="location"><br><br>
            <label for="time">Time: </label>
            <input type="text" name="time"><br><br>
            <label for="date">Date: </label>
            <input type="text" name="date"><br><br><br>
            <input type="submit" value="Submit" onclick="saveappt('addnewappoinment')">
        </form>
    </div>
</div>
<div id="Editform" class="views"; style="padding-top: 20px; max-width: 50%;">
    <div class="container" style="padding-left: 10px; max-width: 100%">
        <form id="editappoinment">
            <label for="forwho">Who For: </label>
            <select onchange="getdetails(this)" id="whatselecter">
                <option value="select">-- Please Select Appointment to Edit--</option>
                <?php
                $results = $_SESSION["Appts"];
                if ($results != null) {
                    foreach ($results as $row) {
                        $stringed = "";
                        $x = 0;
                        foreach ($row as $cell) {
                            if ($x == 0) {
                                //apptid
                            } else if ($x == 1){
                                //memid
                                $stringed = getApptName($cell);
                                $stringed .= " ";
                            } else if($x == 2){
                                //famid
                            } else {
                                $cell .= " ";
                                $stringed .= $cell;
                            }
                            $x = $x + 1;
                        }
                        echo "<option value='" . $stringed . "'>", $stringed, "</option>";
                    }
                }
                ?>
            </select>
            <label for="family" hidden></label>
            <input type="text" id="family" name="family" value="<?php echo $_SESSION["family"] ?>" hidden>
            <input type="text" id="forwho" name="forwho" hidden> <br><br>
            <label for="location">Where: </label>
            <input type="text" name="location" id="location"><br><br>
            <label for="time">Time: </label>
            <input type="text" name="time"><br><br>
            <label for="date">Date: </label>
            <input type="text" name="date"><br><br><br>
            <input type="submit" value="Submit" onclick="saveappt('editappoinment')">
        </form>
    </div>
</div>
<div id="Deleteform" class="views"; style="padding-top: 20px; max-width: 50%;">

<p>deleteform</p>
</div>
</body>
</html>
