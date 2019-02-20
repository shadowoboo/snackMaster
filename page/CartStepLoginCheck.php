<?php
    session_start();
    if(isset($_SESSION["memNo"])){
        echo $_SESSION["memNo"];
    }else{
        echo "error";
    }
?>