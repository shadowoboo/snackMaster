<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "insert into coupon(discountPrice, imgSRC, getWay)
         values(:discountPrice, :imgSRC, :getWay)";
        $coupon = $pdo -> prepare($sql); 
        $coupon -> bindValue(':discountPrice', $_REQUEST['discountPrice']);
        $coupon -> bindValue(':imgSRC', $_REQUEST['imgSRC']);
        $coupon -> bindValue(':getWay', $_REQUEST['getWay']);
        $coupon -> execute();
        echo "true";
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>