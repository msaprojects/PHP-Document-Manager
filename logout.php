<?php
    session_start();
    session_unset();
    session_destroy();
    $_SESSION = array();
    // echo $_SESSION['sesi_nama'];
    header("Location:login.php");
?>  