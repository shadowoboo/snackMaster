<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "update snack set snackGenre = :snackGenre, snackName = :snackName, snackPrice = :snackPrice, nation = :nation, snackPic = :snackPic, snackStatus = :snackStatus, snackVending = :snackVending, boxDate = :boxDate, snackWord = :snackWord, snackIngre = :snackIngre where snackNo = :snackNo";
        $snack = $pdo -> prepare($sql); 
        $snack -> bindValue(':snackNo', $_REQUEST['snackNo']);
        $snack -> bindValue(':snackGenre', $_REQUEST['snackGenre']);
        $snack -> bindValue(':nation', $_REQUEST['nation']);
        $snack -> bindValue(':snackName', $_REQUEST['snackName']);
        $snack -> bindValue(':snackStatus', $_REQUEST['snackStatus']);
        $snack -> bindValue(':snackWord', $_REQUEST['snackWord']);
        $snack -> bindValue(':snackPic', $_REQUEST['snackPic']);
        $snack -> bindValue(':snackPrice', $_REQUEST['snackPrice']);
        $snack -> bindValue(':snackIngre', $_REQUEST['snackIngre']);
        $snack -> bindValue(':snackVending', $_REQUEST['snackVending']);
        $boxDate = $boxDate == ''? null:$_REQUEST['boxDate']."-01";
        $snack -> bindValue(':boxDate', $boxDate);
        $snack -> execute();
        echo "<script>alert('修改商品成功！');location.href='back_snack.php';</script>";
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>