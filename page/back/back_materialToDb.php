<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "insert into material(materialGenre, materialName, materialPath)
         values(:materialGenre, :materialName, :materialPath)";
        $material = $pdo -> prepare($sql); 
        $material -> bindValue(':materialGenre', $_REQUEST['materialGenre']);
        $material -> bindValue(':materialName', $_REQUEST['materialName']);
        $material -> bindValue(':materialPath', $_REQUEST['materialPath']);
        $material -> execute();
        echo "<script>alert('新增素材成功！');location.href='back_material.php';</script>";
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>