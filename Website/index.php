<?php
include_once 'Extras/Stylesheet.php';
include_once 'Extras/Webfunctions.php';
session_start();
?>
<html>
<!-- Header with image -->
<div class="header">
    <h1>Home Page</h1>
    <button onclick="Loginpage()" style="position: absolute; right: 50px; top: 30px">Log in</button>
    <button onclick="newuser()" style="position: absolute; right: 50px; top: 65px">New User</button>
</div>
<body>
<!-- Add a background color to the about section -->
        <div id="about"; style="padding-top: 20px; max-width: 100%;">
            <!-- About Container -->
            <div class="w3-content" style="padding-left: 50px;" >
                <h5>About this web page and its service</h5>
                <div>
                    <p>This website that has been created to ensure easy navigation for all users.<br>
                        This has been achieved by making everything user-friendly, with some disability adaptations added.                        taken into consideration.<br><br>
                        The website aims to aid a family in management of their appointments, and the children's deadlines.<br>
                        Using individual logins will ensure that users can be separately identified as a parent or child.
                    </p>
                    <br>
                </div>
            </div>

            <!-- Banner positioning and headers-->
            <div id="banners">
                <div style="padding-left: 50px">
                    <h5>What you can expect from this website</h5>
                    <!-- Banners -->
                    <div style="padding-left: 10px">
                        <div class="row" >
                            <div class="views" >
                                <h6>Parent View</h6>
                                <p> Parent Banner </p>
                            </div>
                            <div class="views" >
                                <h6>Child View</h6>
                                <p> Child Banner </p>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </body>
</html>