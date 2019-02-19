<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "insert into snack(snackGenre, nation, snackName, snackStatus, snackWord, snackPic, snackPrice, snackIngre, snackVending, boxDate)
         values(:snackGenre, :nation, :snackName, :snackStatus, :snackWord, :snackPic, :snackPrice, :snackIngre, :snackVending, :boxDate)";
        $snack = $pdo -> prepare($sql); 
        $snack -> bindValue(':snackGenre', $_REQUEST['genre']);
        $snack -> bindValue(':nation', $_REQUEST['nation']);
        $snack -> bindValue(':snackName', $_REQUEST['snackName']);
        $snack -> bindValue(':snackStatus', $_REQUEST['snackStatus']);
        $snack -> bindValue(':snackWord', $_REQUEST['snackWord']);
        $snack -> bindValue(':snackPic', $_REQUEST['snackPic']);
        $snack -> bindValue(':snackPrice', $_REQUEST['snackPrice']);
        $snack -> bindValue(':snackIngre', $_REQUEST['snackIngre']);
        $snack -> bindValue(':snackVending', $_REQUEST['snackVending']);
        $boxDate = $_REQUEST['boxDate']."-01";
        $snack -> bindValue(':boxDate', $boxDate);
        $snack -> execute();
        echo "<script>alert('新增商品成功！');location.href='back_snack.php';</script>";
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>