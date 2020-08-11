<?php
include_once 'Extras/Webfunctions.php';
include_once 'Extras/Stylesheet.php';
include_once  '../API/GetAppointments.php';
?>
<script type="text/javascript">
    function onload() {
        //send data
        fetch('../API/GetAppointments.php', {
            method: 'post'
        }).then(function (response) {
            return response.text();
        }).then(function (text) {
            console.log(text);
        }).catch(function (error) {
            console.error();
        })

        for (var y = 0; y < 3; y++)
        {
            formview("Addform");
        }
        //formview("btn_Edit");
        //formview("btn_Delete");
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
            hideforms(x);
        } else {
            //hide
            x.style.display = "none";
            clearallforms(x);
        }
    }
    function saveoption(sel) {
        //set the hidden textbox value
        document.getElementById('whos').value = sel.options[sel.selectedIndex].text;
    }
    function saveappt(get) {
        var sendto = "";
        var formopen = "";
        if (get == "addnewappoinment") {
            sendto = '../API/Appointments/SendAppt.php';
            formopen = "Addform";
        } else if (get == "editappoinment") {
            sendto = '../API/Appointments/EditAppt.php';
            formopen = "Editform";
        } else if (get == "deleteappoinment") {
            sendto = '../API/Appointments/DelAppt.php';
            formopen = "Deleteform";
        } else if (get == "AddNewMember"){
            sendto = '../API/Members/AddNewMember.php';
            formopen = "Newmember";
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
                if(text == "pass"){
                    alert("Password did not match, please try again");
                } else if (text == "user") {
                        alert("Username is already in use, please try again");
                    } else if(text == "nu") {
                        alert("Please fill in all missing text box(s)");
                    } else {
                    formview(formopen);
                }
            }).catch(function (error) {
                console.error();
            })
        })

    }
    function getdetails(sel) {
        var text = sel.name;
        var str = text.split("^/");
        var who = str[0];
        var loc = str[1];
        var time = str[2];
        var date = str[3];
        var note = str[4];
        var ticked = str[5];
        var numofappts = 1;
        <?php
        foreach($_SESSION["Appts"] as $appt){
            echo "if(numofappts == sel.id){";
            //the box that has been ticked - avoid unticking it
            echo "";
            echo "} else {";
            #untick other boxs
            echo "document.getElementById(numofappts).checked = false;";
            #change name of the one unticked
            echo "var toswap = document.getElementById(numofappts).name;";
            echo "var changing = toswap.split('^/');";
            echo "var cw = changing[0];";
            echo "var cl = changing[1];";
            echo "var ct = changing[2];";
            echo "var cd = changing[3];";
            echo "var cn = changing[4];";
            echo "var untic = changing[5];";
            echo "if(untic == 'ti'){";
            echo "document.getElementById(numofappts).name = cw+'^/'+cl+'^/'+ct+'^/'+cd+'^/'+cn+'^/un';";
            echo "}";
            echo "}";
            echo "numofappts = numofappts + 1;";
        }
        ?>


        if (ticked == "un") {
            sel.name = who+"^/"+loc+"^/"+time+"^/"+date+"^/"+note+"^/ti";
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
        } else {
            clearallforms();
            sel.name = who+"^/"+loc+"^/"+time+"^/"+date+"^/"+note+"^/un";
        }
    }
    function clearallforms() {
        //add page
        document.getElementById('whoholder').options.selectedIndex = 0;
        document.getElementById('whos').value = "";
        document.getElementById('location').value = "";
        document.getElementById('time').value = "";
        document.getElementById('date').value = "";

        //edit page
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
    function hideforms(form){
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
                     $checkname = "";
                     $numberofappts = 0;
                     $y = 1;
                     if ($results != null) {
                         foreach ($results as $row) {
                             foreach ($row as $cell) {
                                 if ($x == 0) {
                                 } else if ($x == 2) {
                                 } else if ($cell == null) {
                                 } else {
                                     if ($x == 1) {
                                         $cell = getApptName($cell);
                                         $checkname .= $cell;
                                         $checkname .= "^/";
                                         echo "<td>", $cell, "</td>";
                                     } else {
                                         $checkname .= $cell;
                                         $checkname .= "^/";
                                         echo "<td>", $cell, "</td>";
                                         if ($x == 6) {
                                             $checkname .= "un";
                                             echo "<td>", "<input type='checkbox' id='" . $y . "' name='" . $checkname . "' onchange='getdetails(this)'>", "</td>";
                                         }
                                     }
                                 }
                                 $x = $x + 1;
                             }
                             #add new line and reset x
                             echo "<tr>", "</tr>";
                             $y = $y + 1;
                             $x = 0;
                             $checkname = "";
                             $numberofappts = $numberofappts + 1;
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
            <input type="text" id="addfamily" name="family" value="<?php echo $_SESSION["family"] ?>" hidden>
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
            <input type="text" id="editfamily" name="family" value="<?php echo $_SESSION["family"] ?>" hidden><br>
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
            <label for="family" hidden></label>
            <input type="text" id="delfamily" name="family" value="<?php echo $_SESSION["family"] ?>" hidden>
            <input type="text" id="delwho" name="delwho" hidden>
            <input type="text" name="dellocation" id="dellocation" hidden>
            <input type="text" name="deltime" id="deltime" hidden>
            <input type="text" name="deldate" id="deldate" hidden><br><br><br>
            <input type="submit" value="Confirm you wish to delete the selected appointment" onclick="saveappt('deleteappoinment')">
        </form>
    </div>
</div>
<div id="Newmember" class="views"; style="padding-top: 20px; max-width: 50%;">
<div class="container" style="padding-left: 10px; max-width: 100%">
    <form id="AddNewMember">
        <label for="family" hidden></label>
        <input type="text" id="thefamily" name="family" value="<?php echo $_SESSION["family"] ?>" hidden>
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
        <input type="password" name="NewPass" id="NewPass"><br><br>
        <label for="ConPass">Confirm Password: </label>
        <input type="password" name="ConPass" id="ConPass"><br><br><br>
        <input type="submit" value="Submit" onclick="saveappt('AddNewMember')">
    </form>
</div>
</div>
</body>
</html>