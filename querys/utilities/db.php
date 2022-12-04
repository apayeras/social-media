<?php
    global $con;
    function getDB() {
        global $con;
        $con = mysqli_connect("localhost","root","","bd212") or die();
    }

    function closeDB() {
        global $con;
        mysqli_close($con);
    }
?>