<?php
    session_start();
    if(isset($_SESSION["memId"])){
        echo $_SESSION["memId"];
    }else{
        echo "error";
    }
?>