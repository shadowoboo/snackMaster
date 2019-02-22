<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "update coupon set imgSRC = :imgSRC where coupNo = :coupNo";
        $coupon = $pdo -> prepare($sql);
        $coupon -> bindValue(':imgSRC', $_REQUEST['imgSRC']);
        $coupon -> bindValue(':coupNo', $_REQUEST['coupNo']);
        $coupon -> execute();
        echo "<script>alert('修改優惠券成功！');location.href='back_coupon.php';</script>";
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>