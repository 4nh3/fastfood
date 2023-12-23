<?php
    include('./config/contants.php') ;
    session_destroy();
    header("location: login.php");
?>