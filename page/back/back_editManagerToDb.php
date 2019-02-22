<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");

        $sql = "select * from manager where managerId = :managerId and managerPsw = :managerPsw";
        $manager = $pdo -> prepare($sql);
        $manager -> bindValue(':managerId', $_REQUEST['managerId']);
        $manager -> bindValue(':managerPsw', $_REQUEST['managerPsw']);
        $manager -> execute();

        if( $manager -> rowCount() == 0 ){
            echo "false";
        }else{
            $sql = "update manager set managerName = :managerName where managerNo = :managerNo";
            $manager = $pdo -> prepare($sql); 
            $manager -> bindValue(':managerName', $_REQUEST['managerName']);
            $manager -> bindValue(':managerNo', $_REQUEST['managerNo']);
            $manager -> execute();
            echo "true";
        }

    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>