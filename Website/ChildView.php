<?php
include_once 'Extras/Webfunctions.php';
include_once 'Extras/Stylesheet.php';
include_once  '../API/GetDeadlines.php';
?>
<script type="text/javascript">
    function onload() {
        //send data
        fetch('../API/GetDeadlines.php', {
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
    function savedline(get) {
        var sendto = "";
        if (get == "adddeadline") {
            sendto = '../API/Deadlines/AddDead.php';
            formview("Addform");
        } else if (get == "editappoinment") {
            sendto = '../API/Deadlines/EditDead.php';
            formview("Editform");
        } else if (get == "deleteappoinment") {
            sendto = '../API/Deadlines/DelDead.php';
            formview("Deleteform");
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
    function getdetails(sel) {
        var text = sel.options[sel.selectedIndex].text;
        var str = text.split(", ");
        var what = str[0];
        var time = str[1];
        var date = str[2];
        var note = str[3];

        alert(what);
        document.getElementById('oldwhatfor').value = what;
        document.getElementById('oldforwhen').value = time;
        document.getElementById('oldfordate').value = date;
        document.getElementById('olddednote').value = note;

        document.getElementById('whatfor').value = what;
        document.getElementById('forwhen').value = time;
        document.getElementById('fordate').value = date;
        document.getElementById('dednote').value = note;

        document.getElementById('delwho').value = what;
        document.getElementById('dellocation').value = time;
        document.getElementById('deltime').value = date;
        document.getElementById('deldate').value = note;
    }
    function clearallforms(form) {
        if(form.id == "Addform"){
            document.getElementById("Editform").style.display = "none";
            document.getElementById("Deleteform").style.display = "none";
        }
        if(form.id == "Editform"){
            document.getElementById("Addform").style.display = "none";
            document.getElementById("Deleteform").style.display = "none";
        }
        if(form.id == "Deleteform"){
            document.getElementById("Editform").style.display = "none";
            document.getElementById("Addform").style.display = "none";
        }


        //add page
        document.getElementById('AddDedname').value = "";
        document.getElementById('addtime').value = "";
        document.getElementById('adddate').value = "";

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
    }
</script>
<html>
<!-- Header -->
<div class="header">
    <h1>Welcome <?php echo $_SESSION["name"]?></h1>
    <button onclick="Logout()" style="position: absolute; right: 50px; top: 30px">Log out</button>
</div>
<body onload="onload()">
<!-- Appt section -->
<div class="views"; style="padding-top: 20px; max-width: 50%;">
    <div class="w3-content" style="padding-left: 50px;">
        <button onclick="formview('Addform')" id="btn_Add">Add Deadline</button>
        <button onclick="formview('Editform')" id="btn_Edit">Edit Deadline</button>
        <button onclick="formview('Deleteform')" id="btn_Delete">Delete Deadline</button>
        <br><br>
    </div>
    <div class="w3-content" style="padding-left: 50px;" >
        <h5>List of upcoming deadlines:</h5>
        <div>
            <table id="maintable">
                <tr>
                    <th>What For </th>
                    <th>Time</th>
                    <th>Date</th>
                    <th>Note</th>
                </tr>
                <tr>
                    <?php
                    $results = $_SESSION["deadlines"];
                    $x = 0;
                    if ($results != null) {
                        foreach ($results as $row) {
                            foreach ($row as $cell) {
                                echo "<td>", $cell, "</td>";
                            }
                            $x = $x + 1;
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
        <form id="adddeadline">
            <label for="AddDedname">What For: </label>
            <label for="member" hidden></label>
            <input type="text" id="member" name="member" value="<?php echo $_SESSION["member"] ?>" hidden>
            <label for="family" hidden></label>
            <input type="text" id="family" name="family" value="<?php echo $_SESSION["family"] ?>" hidden>
            <input type="text" id="AddDedname" name="AddDedname"> <br><br>
            <label for="time">Time: </label>
            <input type="text" name="addtime" id="addtime"><br><br>
            <label for="date">Date: </label>
            <input type="text" name="adddate" id="adddate"><br><br><br>
            <input type="submit" value="Submit" onclick="savedline('adddeadline')">
        </form>
    </div>
</div>
<div id="Editform" class="views"; style="padding-top: 20px; max-width: 50%;">
    <div class="container" style="padding-left: 10px; max-width: 100%;">
        <form id="editdeadl">
            <select onchange="getdetails(this)" id="whatselecter">
                <option value="select">-- Please Select Deadline to Edit--</option>
                <?php
                $results = $_SESSION["deadlines"];
                if ($results != null) {
                    $x = 0;
                    foreach ($results as $row) {
                        $stringed = "";
                        foreach ($row as $cell) {
                            if ($x == 3) {
                                $stringed .= $cell;
                            } else {
                                $cell .= ", ";
                                $stringed .= $cell;
                                $x = $x + 1;
                            }
                        }
                        $x = 0;
                        echo "<option value='" . $stringed . "'>", $stringed, "</option>";
                    }
                }
                ?>
            </select>
            <label for="family" hidden></label>
            <input type="text" id="family" name="family" value="<?php echo $_SESSION["family"] ?>" hidden><br>
            <label for="whatfor">What For: </label>
            <input type="text" id="whatfor" name="whatfor" > <br><br>
            <input type="text" id="oldwhatfor" name="oldwhatfor" hidden>
            <label for="forwhen">Time: </label>
            <input type="text" name="forwhen" id="forwhen"><br><br>
            <input type="text" name="oldforwhen" id="oldforwhen" hidden>
            <label for="fordate">Date: </label>
            <input type="text" name="fordate" id="fordate"><br><br>
            <input type="text" name="olddednote" id="olddednote" hidden>
            <label for="dednote">Note: </label>
            <input type="text" name="dednote" id="dednote"><br><br>
            <input type="submit" value="Submit" onclick="saveappt('editdeadl')">
        </form>
    </div>
</div>
<div id="Deleteform" class="views"; style="padding-top: 20px; max-width: 50%;">
    <div class="container" style="padding-left: 10px; max-width: 100%">
        <form id="deleteappoinment">
            <select onchange="getdetails(this)" id="delholder">
                <option value="select">-- Please Select Family Member --</option>
                <?php
                $results = $_SESSION["Deadlines"];
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
</body>
</html>