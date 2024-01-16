<?php
    session_start();
    include_once "connection.php";

    session_unset();
    session_destroy();
    header("location: login.php");
?>