<?php
    session_start();
    if(isset($_SESSION["g2memNo"])){
        echo $_SESSION["g2memNo"];
    }else{
        echo "error";
    }
?>