<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "update material set materialGenre = :materialGenre, materialName = :materialName, materialPath = :materialPath where materialNo = :materialNo";
        $material = $pdo -> prepare($sql);
        $material -> bindValue(':materialGenre', $_REQUEST['materialGenre']);
        $material -> bindValue(':materialName', $_REQUEST['materialName']);
        $material -> bindValue(':materialPath', $_REQUEST['materialPath']);
        $material -> bindValue(':materialNo', $_REQUEST['materialNo']);
        $material -> execute();
        echo "true";
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>