<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "insert into masell(maPic, maLnge, maLat, maArea, maAdd)
         values(:maPic, :maLnge, :maLat, :maArea, :maAdd)";
        $vending = $pdo -> prepare($sql); 
        $vending -> bindValue(':maPic', $_REQUEST['maPic']);
        $vending -> bindValue(':maLnge', $_REQUEST['maLnge']);
        $vending -> bindValue(':maLat', $_REQUEST['maLat']);
        $vending -> bindValue(':maArea', $_REQUEST['maArea']);
        $vending -> bindValue(':maAdd', $_REQUEST['maAdd']);
        $vending -> execute();
        echo "<script>alert('新增販賣機成功！');location.href='back_vending.php';</script>";
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>