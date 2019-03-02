<?php
    ob_start();
    session_start();
    
    $errMsg = "";
    try {
        require_once("connectcd105g2.php");
        $sql = "delete from favorite where memNo = :memNo and snackNo = :snackNo";
        $hearts = $pdo -> prepare($sql); 
        $hearts -> bindValue(':memNo', $_SESSION['g2memNo']);
        // $hearts -> bindValue(':memNo', 2);
        $hearts -> bindValue(':snackNo', $_REQUEST['snackNo']);
        $hearts -> execute();
        echo "true";
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;        
    }

?>