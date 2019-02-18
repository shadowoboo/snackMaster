<?php
    session_start();
    $_SESSION["snackNo"]=1;
    echo "Done write ".'$_SESSION["snackNo"]'."=".$_SESSION["snackNo"];

    $_SESSION["memId"]=1;
    echo "memId: ".$_SESSION["memId"]." already loggin";
?>