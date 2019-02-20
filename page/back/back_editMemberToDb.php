<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "update member set commentRight = :commentRight, reportTimes = 0 where memNo = :memNo";
        $member = $pdo -> prepare($sql);
        $member -> bindValue(':commentRight', $_REQUEST['commentRight']);
        $member -> bindValue(':memNo', $_REQUEST['memNo']);
        $member -> execute();
        echo "<script>alert('修改會員狀態成功！');location.href='back_member.php';</script>";
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>