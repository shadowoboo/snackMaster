<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "update clearance set startTime = :startTime, endTime = :endTime where clearanceNo = :clearanceNo"
        ;
        $startTime = $_REQUEST['startTime'].' 00:00:00';
        $endTime = $_REQUEST['endTime'].' 00:00:00';
        $clearance = $pdo -> prepare($sql); 
        $clearance -> bindValue(':startTime', $startTime);
        $clearance -> bindValue(':endTime', $endTime);
        $clearance -> bindValue(':clearanceNo', $_REQUEST['clearanceNo']);
        $clearance -> execute();

        $sql = "update clearanceitem set snackNo = :snackNo, salePrice = :salePrice, quantity = :quantity where clearanceNo = :clearanceNo and clearItemNo = 1";
        $clearItems = $pdo -> prepare($sql);
        $clearItems -> bindValue(':clearanceNo', $_REQUEST['clearanceNo']);
        $clearItems -> bindValue(':snackNo', $_REQUEST['item1No']);
        $clearItems -> bindValue(':salePrice', $_REQUEST['item1Price']);
        $clearItems -> bindValue(':quantity', $_REQUEST['item1Qty']);
        $clearItems -> execute();
        $sql = "update clearanceitem set snackNo = :snackNo, salePrice = :salePrice, quantity = :quantity where clearanceNo = :clearanceNo and clearItemNo = 2";
        $clearItems = $pdo -> prepare($sql);
        $clearItems -> bindValue(':clearanceNo', $_REQUEST['clearanceNo']);
        $clearItems -> bindValue(':snackNo', $_REQUEST['item2No']);
        $clearItems -> bindValue(':salePrice', $_REQUEST['item2Price']);
        $clearItems -> bindValue(':quantity', $_REQUEST['item2Qty']);
        $clearItems -> execute();
        $sql = "update clearanceitem set snackNo = :snackNo, salePrice = :salePrice, quantity = :quantity where clearanceNo = :clearanceNo and clearItemNo = 3";
        $clearItems = $pdo -> prepare($sql);
        $clearItems -> bindValue(':clearanceNo', $_REQUEST['clearanceNo']);
        $clearItems -> bindValue(':snackNo', $_REQUEST['item3No']);
        $clearItems -> bindValue(':salePrice', $_REQUEST['item3Price']);
        $clearItems -> bindValue(':quantity', $_REQUEST['item3Qty']);
        $clearItems -> execute();
        echo "<script>alert('修改即期品專案成功！');location.href='back_clearance.php';</script>";
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>