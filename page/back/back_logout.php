<?php
    ob_start();
    session_start();
    unset($_SESSION['managerName']);
    header('location:back_login.html');
?>