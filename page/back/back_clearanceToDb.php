<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "insert into clearance(startTime, endTime)
         values(:startTime, :endTime)";
        $startTime = $_REQUEST['startTime'].' 00:00:00';
        $endTime = $_REQUEST['endTime'].' 00:00:00';
        $clearance = $pdo -> prepare($sql); 
        $clearance -> bindValue(':startTime', $startTime);
        $clearance -> bindValue(':endTime', $endTime);
        $clearance -> execute();
        $clearNo = $pdo -> lastInsertId();

        $sql = "insert into clearanceitem(clearItemNo, clearanceNo, snackNo, salePrice, quantity) values(1, :cNo, :no1, :price1, :qty1), (2, :cNo, :no2, :price2, :qty2), (3, :cNo, :no3, :price3, :qty3)";
        $clearItems = $pdo -> prepare($sql);
        $clearItems -> bindValue(':cNo', $clearNo);
        $clearItems -> bindValue(':no1', $_REQUEST['item1No']);
        $clearItems -> bindValue(':price1', $_REQUEST['item1Price']);
        $clearItems -> bindValue(':qty1', $_REQUEST['item1Qty']);
        $clearItems -> bindValue(':no2', $_REQUEST['item2No']);
        $clearItems -> bindValue(':price2', $_REQUEST['item2Price']);
        $clearItems -> bindValue(':qty2', $_REQUEST['item2Qty']);
        $clearItems -> bindValue(':no3', $_REQUEST['item3No']);
        $clearItems -> bindValue(':price3', $_REQUEST['item3Price']);
        $clearItems -> bindValue(':qty3', $_REQUEST['item3Qty']);
        $clearItems -> execute();
        echo "true";
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>