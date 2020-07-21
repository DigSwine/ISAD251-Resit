<?php
include 'header.php';
include_once '../API/API_functions.php';
?>

<html>

<!-- Header with image -->
<header class="bgimg w3-display-container w3-grayscale-min" id="home">
    <div class="w3-display-middle w3-center">
        <span class="w3-text-white" style="font-size:70px">BattleForce<br>Sleep</span>
    </div>
</header>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
      integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

<!-- Add a background color and large text to the whole page -->
<div class="w3-sand w3-grayscale w3-large">

    <center>

    <!-- About Container -->
    <div class="w3-container" id="about">
        <div class="w3-content" style="max-width:100%">
            <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide">PRODUCT VISION</span></h5>
            <div class="w3-panel w3-leftbar w3-light-grey">
                <p>“Our product is for students who want to improve their sleeping routines and their overall well-being.
                    Our health and fitness application monitors our customer’s daily sleeping habits.
                    The recorded data will be displayed in the form of graphs and charts in order to make it easier for consumers to understand.
                    Our customers will have access to all features without any additional costs.”</p>
                <br>
            </div>
        </div>

        <!-- Reasons to download app Container -->
        <div class="w3-container" id="about">
            <div class="w3-content" style="max-width:100%">
                <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide">REASONS YOU SHOULD GET OUR APP</span></h5>
                <div class="w3-panel w3-leftbar w3-light-grey">

                    <div class="row" >

                        <div class="column" >
                            <h6>Reason 1</h6>
                            <p>This app and website that we have made has been made with the user in mind.
                                By making everything as user-friendly and even some aspects of disability have been
                                taken into consideration, by selecting a
                                colour scheme which works with colourblindness. </p>

                        </div>
                        <div class="column" >
                            <h6>Reason 2</h6>
                            <p>We have tried a few sleeping applications ourselves, and we all found one thing in
                                common... they all required some kind of payment. As student's this is not always possible, as students dont have much money.
                                So we decided to make our application free</p>
                        </div>

                    </div>

                    <br>
                </div>
            </div>
            <style>

                /* Create two equal columns that floats next to each other */
                .column {
                    float: left;
                    width: 50%;
                    padding: 10px;
                }
            </style>


    </div>
    <br>

    <!-- App Download Container -->

    <div class="w3-container" id="App_download">
        <div class="w3-content" style="max-width:100%">
            <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide">Download Mobile Application For Android</span></h5>
            <form action="" target="_blank">
                <p>Please click the button bellow to download our mobile application</p>
                <p><button class="w3-button w3-black" onclick="DownloadAlert()" >BattleForce Sleep</button></p>

                <p>If the download does not begin please click the button below. You will be redirected to our GitHub where you can initiate the download</p>
                <p><button class="w3-button w3-black" onclick="window.open('https://github.com/Plymouth-University/prco204-battleforce3/tree/master/AppDownload')" >GitHub link</button></p>
            </form>
        </div>
    </div>

    <!-- End page content -->

    </center>
    <br>
    <br>
</div>


<!-- Footer -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<style>
    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: #000000;
        color: white;
        text-align: center;
    }
</style>

<div class='footer'>
    <span>
        <p><strong>Address:</strong> Smeaton Building, Drake Circus, Plymouth PL4 8AA.
        BattleForce Sleep</p>
    </span>
</div>

</body>
</html>