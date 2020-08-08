<?php
include_once 'Extras/Webfunctions.php';
include_once 'Extras/Stylesheet.php';
include_once  '../API/API_GetAppointments.php';
?>
<script type="text/javascript">
    function onload() {
        //send data
        fetch('../API/API_GetAppointments.php', {
            method: 'post'
        }).then(function (response) {
            return response.text();
        }).then(function (text) {
            console.log(text);
        }).catch(function (error) {
            console.error();
        })

        formview("Addform");
        formview("Editform");
        formview("Deleteform");
        formview("Newmember");
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
            clearallforms(x);
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
        if (get == "addnewappoinment") {
            sendto = '../API/Appointments/API_SendAppt.php';
            formview("Addform");
        } else if (get == "editappoinment") {
            sendto = '../API/Appointments/API_EditAppt.php';
            formview("Editform");
        } else if (get == "deleteappoinment") {
            sendto = '../API/Appointments/API_DelAppt.php';
            formview("Deleteform");
        } else if (get == "AddNewMember"){
            sendto = '../API/Members/API_AddNewMember.php';
            formview("Newmember");
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
    }
    function getdetails(sel){
        var text = sel.options[sel.selectedIndex].text;
        var str = text.split(", ");
        var who = str[0];
        var loc = str[1];
        var time = str[2];
        var date = str[3];
        var note = str[4];

        document.getElementById('oldforwho').value = who;
        document.getElementById('oldloc').value = loc;
        document.getElementById('oldtime').value = time;
        document.getElementById('olddate').value = date;

        document.getElementById('forwho').value = who;
        document.getElementById('loc').value = loc;
        document.getElementById('editedtime').value = time;
        document.getElementById('editeddate').value = date;
        document.getElementById('apptnote').value = note;

        document.getElementById('delwho').value = who;
        document.getElementById('dellocation').value = loc;
        document.getElementById('deltime').value = time;
        document.getElementById('deldate').value = date;
    }
    function clearallforms(form) {
        if(form.id == "Addform"){
            document.getElementById("Editform").style.display = "none";
            document.getElementById("Deleteform").style.display = "none";
            document.getElementById("Newmember").style.display = "none";
        }
        if(form.id == "Editform"){
            document.getElementById("Addform").style.display = "none";
            document.getElementById("Deleteform").style.display = "none";
            document.getElementById("Newmember").style.display = "none";
        }
        if(form.id == "Deleteform"){
            document.getElementById("Editform").style.display = "none";
            document.getElementById("Addform").style.display = "none";
            document.getElementById("Newmember").style.display = "none";
        }
        if(form.id == "Newmember"){
            document.getElementById("Editform").style.display = "none";
            document.getElementById("Addform").style.display = "none";
            document.getElementById("Deleteform").style.display = "none";
        }


        //add page
        document.getElementById('whoholder').options.selectedIndex = 0;
        document.getElementById('whos').value = "";
        document.getElementById('location').value = "";
        document.getElementById('time').value = "";
        document.getElementById('date').value = "";

        //edit page
        document.getElementById('whatselecter').options.selectedIndex = 0;
        document.getElementById('oldforwho').value = "";
        document.getElementById('oldloc').value = "";
        document.getElementById('oldtime').value = "";
        document.getElementById('olddate').value = "";
        document.getElementById('forwho').value = "";
        document.getElementById('loc').value = "";
        document.getElementById('editedtime').value = "";
        document.getElementById('editeddate').value = "";
        document.getElementById('apptnote').value = "";

        //delete page
        document.getElementById('delholder').options.selectedIndex = 0;
        document.getElementById('delwho').value = "";
        document.getElementById('dellocation').value = "";
        document.getElementById('deltime').value = "";
        document.getElementById('deldate').value = "";

        //newmember page
        document.getElementById('CorPHolder').options.selectedIndex = 0;
        document.getElementById('PorC').value = "";
        document.getElementById('NewUser').value = "";
        document.getElementById('NewPass').value = "";

    }
    function CorpSave(sel) {
        //set the hidden textbox value
        document.getElementById('PorC').value = sel.options[sel.selectedIndex].text;
    }
</script>
<html>
<!-- Header -->
<div class="header">
    <h1>Welcome <?php echo $_SESSION["name"]?></h1>
    <button onclick="Logout()" style="position: absolute; right: 50px; top: 30px">Log out</button>
    <button onclick="formview('Newmember')" style="position: absolute; right: 50px; top: 65px">Add New Family Member</button>
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
                    <th>Note</th>
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
                                     } else if($x == 6){
                                         //notes
                                         if ($cell != null){

                                         } else {
                                             $cell = "No note avaliable";
                                         }
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
                $results = $_SESSION["Fammembers"];
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
            <input type="text" name="time" id="time"><br><br>
            <label for="date">Date: </label>
            <input type="text" name="date" id="date"><br><br><br>
            <input type="submit" value="Submit" onclick="saveappt('addnewappoinment')">
        </form>
    </div>
</div>
<div id="Editform" class="views"; style="padding-top: 20px; max-width: 50%;">
    <div class="container" style="padding-left: 10px; max-width: 100%;">
        <form id="editappoinment">
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
                                $stringed .= ", ";
                            } else if($x == 2){
                                //famid
                            } else if($x == 6){
                                $stringed .= $cell;
                            } else {
                                $cell .= ", ";
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
            <input type="text" id="family" name="family" value="<?php echo $_SESSION["family"] ?>" hidden><br>
            <label for="forwho">Who For: </label>
            <input type="text" id="forwho" name="forwho" > <br><br>
            <input type="text" id="oldforwho" name="oldforwho" hidden>
            <label for="location">Where: </label>
            <input type="text" name="location" id="loc"><br><br>
            <input type="text" name="oldlocation" id="oldloc" hidden>
            <label for="editedtime">Time: </label>
            <input type="text" name="editedtime" id="editedtime"><br><br>
            <input type="text" name="oldtime" id="oldtime" hidden>
            <label for="editeddate">Date: </label>
            <input type="text" name="editeddate" id="editeddate"><br><br>
            <input type="text" name="olddate" id="olddate" hidden>
            <label for="apptnote">Note: </label>
            <input type="text" name="apptnote" id="apptnote"><br><br>
            <input type="submit" value="Submit" onclick="saveappt('editappoinment')">
        </form>
    </div>
</div>
<div id="Deleteform" class="views"; style="padding-top: 20px; max-width: 50%;">
    <div class="container" style="padding-left: 10px; max-width: 100%">
        <form id="deleteappoinment">
            <select onchange="getdetails(this)" id="delholder">
                <option value="select">-- Please Select Family Member --</option>
                <?php
                $results = $_SESSION["Appts"];
                if ($results != null) {
                    foreach ($results as $row) {
                        $stringed = "";
                        $x = 0;
                        foreach ($row as $cell) {
                            if ($x == 0) {
                                //apptid
                            } else if ($x == 1) {
                                //memid
                                $stringed = getApptName($cell);
                                $stringed .= ", ";
                            } else if ($x == 2) {
                                //famid
                            } else if ($x == 6) {
                                $stringed .= $cell;
                            } else {
                                $cell .= ", ";
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
            <input type="text" id="delwho" name="delwho" hidden>
            <input type="text" name="dellocation" id="dellocation" hidden>
            <input type="text" name="deltime" id="deltime" hidden>
            <input type="text" name="deldate" id="deldate" hidden><br><br><br>
            <input type="submit" value="Submit" onclick="saveappt('deleteappoinment')">
        </form>
    </div>
</div>
<div id="Newmember" class="views"; style="padding-top: 20px; max-width: 50%;">
<div class="container" style="padding-left: 10px; max-width: 100%">
    <form id="AddNewMember">
        <label for="family" hidden></label>
        <input type="text" id="family" name="family" value="<?php echo $_SESSION["family"] ?>" hidden>
        <label for="whosnew">First Name: </label>
        <input type="text" id="whosnew" name="whosnew"><br><br>
        <label for="CorPHolder">Parent or Child: </label>
        <select onchange="CorpSave(this)" id="CorPHolder">
            <option>-- Please Select if the member is a Parent or Child</option>
            <option>Parent</option>
            <option>Child</option>
        </select>
        <input type="text" name="PorC" id="PorC" hidden><br><br>
        <label for="NewUser">Username: </label>
        <input type="text" name="NewUser" id="NewUser"><br><br>
        <label for="NewPass">Password: </label>
        <input type="text" name="NewPass" id="NewPass"><br><br><br>
        <input type="submit" value="Submit" onclick="saveappt('AddNewMember')">
    </form>
</div>
</div>
</body>
</html>