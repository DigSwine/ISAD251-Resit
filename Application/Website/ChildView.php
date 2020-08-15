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
        for (var y = 0; y < 3; y++){
            formview("Addform");
        }
    }
    function Logout(){
        <?php
        session_destroy();
        ?>
        Backtohome();
    }
    function savedline(get) {
        var sendto = "";
        var formopen = "";
        if (get == "adddeadline") {
            sendto = '../API/Deadlines/AddDead.php';
            formopen = "Addform";
        } else if (get == "editdeadl") {
            sendto = '../API/Deadlines/EditDead.php';
            formopen = "Editform";
        } else if (get == "deldead") {
            sendto = '../API/Deadlines/DelDead.php';
            formopen = "Deleteform";
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
                if(text == "nu") {
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
        var what = str[0];
        var time = str[1];
        var date = str[2];
        var note = str[3];
        var comp = str[4];
        var ticked = str[5];

        clearselectors(sel);

        if (ticked == "un") {
            sel.name = what + "^/" + time + "^/" + date + "^/" + note + "^/" + comp + "^/ti";

            btnuse('btn_Edit');
            btnuse('btn_Delete');

            document.getElementById('oldwhatfor').value = what;
            document.getElementById('oldforwhen').value = time;
            document.getElementById('olddate').value = date;
            document.getElementById('dednote').value = note;
            document.getElementById('oldcomp').value = comp;

            document.getElementById('whatfor').value = what;
            document.getElementById('forwhen').value = time;
            document.getElementById('fordate').value = date;
            document.getElementById('dednote').value = note;
            document.getElementById('comp').value = comp;

            document.getElementById('delwhat').value = what;
            document.getElementById('deltime').value = time;
            document.getElementById('deldate').value = date;
            document.getElementById('delnote').value = note;
        } else {
            clearallforms();
            for (var y = 0; y < 4; y++){
                formview("Addform");
            }
            btnuse('btn_Edit');
            btnuse('btn_Delete');
            sel.name = what + "^/" + time + "^/" + date + "^/" + note + "^/" + comp + "^/un";
        }
    }
    function clearallforms() {
        //selecters
        clearselectors(0);

        //add page
        document.getElementById('AddDedname').value = "";
        document.getElementById('addtime').value = "";
        document.getElementById('adddate').value = "";

        //edit page
        document.getElementById('oldwhatfor').value = "";
        document.getElementById('oldforwhen').value = "";
        document.getElementById('olddate').value = "";
        document.getElementById('dednote').value = "";
        document.getElementById('oldcomp').value = ""

        document.getElementById('whatfor').value = "";
        document.getElementById('forwhen').value = "";
        document.getElementById('fordate').value = "";
        document.getElementById('dednote').value = "";
        document.getElementById('comp').value = "";

        //delete page
        document.getElementById('delwhat').value = "";
        document.getElementById('deltime').value = "";
        document.getElementById('deldate').value = "";
        document.getElementById('delnote').value = "";
    }
    function clearselectors(sel){
        var numofappts = 1;
        <?php
        foreach($_SESSION["deadlines"] as $dedl){
            echo "if(numofappts != sel.id){";
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
            echo "}}";
            echo "numofappts = numofappts + 1;";
        }
        ?>
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
                    <th>Completed</th>
                </tr>
                <tr>
                    <?php
                    $results = $_SESSION["deadlines"];
                    $x = 0;
                    $checkname = "";
                    $numberofappts = 0;
                    $y = 1;
                    if ($results != null) {
                        foreach ($results as $row) {
                            foreach ($row as $cell) {
                                $checkname .= $cell;
                                $checkname .= "^/";
                                echo "<td>", $cell, "</td>";
                                if ($x == 4) {
                                    $checkname .= "un";
                                    echo "<td>", "<input type='checkbox' id='" . $y . "' name='" . $checkname . "' onchange='getdetails(this)'>", "</td>";
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
        <form id="adddeadline">
            <label for="AddDedname">What For: </label>
            <label for="member" hidden></label>
            <input type="text" id="addmember" name="member" value="<?php echo $_SESSION["member"] ?>" hidden>
            <label for="family" hidden></label>
            <input type="text" id="addfamily" name="family" value="<?php echo $_SESSION["family"] ?>" hidden>
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
            <input type="text" id="edimember" name="member" value="<?php echo $_SESSION["member"] ?>" hidden>
            <input type="text" id="edifamily" name="family" value="<?php echo $_SESSION["family"] ?>" hidden><br>
            <label for="whatfor">What For: </label>
            <input type="text" id="whatfor" name="whatfor" > <br><br>
            <input type="text" id="oldwhatfor" name="oldwhatfor" hidden>
            <label for="forwhen">Time: </label>
            <input type="text" name="forwhen" id="forwhen"><br><br>
            <input type="text" name="oldforwhen" id="oldforwhen" hidden>
            <label for="fordate">Date: </label>
            <input type="text" name="fordate" id="fordate"><br><br>
            <input type="text" name="olddate" id="olddate" hidden>
            <label for="dednote">Note: </label>
            <input type="text" name="dednote" id="dednote"><br><br>
            <input type="text" name="oldcomp" id="oldcomp" hidden>
            <label for="comp">Completed:</label>
            <input type="text" name="comp" id="comp"><br><br>
            <input type="submit" value="Submit" onclick="savedline('editdeadl')">
        </form>
    </div>
</div>
<div id="Deleteform" class="views"; style="padding-top: 20px; max-width: 50%;">
    <div class="container" style="padding-left: 10px; max-width: 100%">
        <form id="deldead">
            <input type="text" id="delmember" name="member" value="<?php echo $_SESSION["member"] ?>" hidden>
            <input type="text" id="delfamily" name="family" value="<?php echo $_SESSION["family"] ?>" hidden>
            <input type="text" id="delwhat" name="delwhat" hidden>
            <input type="text" name="deltime" id="deltime" hidden>
            <input type="text" name="deldate" id="deldate" hidden>
            <input type="text" name="delnote" id="delnote" hidden><br><br><br>
            <input type="submit" value="Are you sure you want to delete the selected deadline?" onclick="savedline('deldead')">
        </form>
    </div>
</div>

<!-- needed to solve an issue with how the forms are hidden -->
<div id="Newmember" class="views"; style="padding-top: 20px; max-width: 50%;">

</div>
</body>
</html>