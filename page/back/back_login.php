<?php
    ob_start();
    session_start();
    
    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "select * from manager where managerId = :managerId and managerPsw = :managerPsw";
        $manager = $pdo -> prepare($sql);
        $manager -> bindValue(":managerId", $_REQUEST["magId"]);
        $manager -> bindValue(":managerPsw", $_REQUEST["magPsw"]);
        $manager -> execute();
        if( $manager -> rowCount() == 0 ){
            $errMsg .= "<script> alert('帳號或密碼錯誤！請重新登入');location.href='back_login.html';</script>";
            echo $errMsg;
        }else{
            $managerRow = $manager -> fetch();
            $_SESSION['managerName'] = $managerRow['managerName'];
            header('location:back_snack.php');
        }

    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>