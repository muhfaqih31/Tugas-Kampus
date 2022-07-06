<?php 
    // inisiasi session
    session_start();

    // unset semua variabel sesi
    $_SESSION = array();

    session_destroy();

    // arahkan ke login page
    header("location: login.php");
    exit;

?>