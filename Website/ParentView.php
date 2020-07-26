<?php
include_once 'Extras/Stylesheet.php';
include_once 'Extras/Webfunctions.php';
include_once '../API/API_GetAppointments.php';
session_start();
?>

<html>
<!-- Header with image -->
<div class="header">
    <h1>Welcome <?php echo $_SESSION["name"] ?></h1>
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
                    <td id="demo"></td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>
<script>
    function onload(){
        <?php
        getAppts();
        ?>
        var x = 0;
        var cell = [];
        <?php
        $resultSet = $_SESSION["Appts"];
        if ($resultSet != null) {
            $columns = empty($resultSet) ? array() : array_keys($resultSet[0]);
            $idColumn = $columns[0];
            $tableString = '<table border="1"><tr>';
            $inputString = '';
            $insertString = '';
            #foreach ($columns as $column) {
              #  $tableString .= '<h5>' . $column . '</h5>';
             #   $inputString .= '<h5>' . $column . '</h5>';
            #    $insertString .= '<td><input type=\'text\' name=\'' . $column . '\'/></td>';
           # }
            foreach ($resultSet as $row) {
                foreach ($row as $cell) {
                    "cell[x] = "$cell;
                    echo $cell;
                    x = x + 1;
                }
            }
        }
        ?>
        for(var y =0; y > x; y++){
            print x[y];
        }
    }

    function Logout(){
        <?php
        session_destroy();
        echo "done";
        ?>
        Backtohome();
    }
</script>