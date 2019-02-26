<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "select snackName, snackPrice from snack where snackNo = {$_REQUEST['snackNo']}";
        $snacks = $pdo -> query($sql);
        $snack = $snacks -> fetch();
        echo $snack['snackName']."|".$snack['snackPrice'];
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>