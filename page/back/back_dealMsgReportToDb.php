<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        if( $_REQUEST['status'] == 'sustain' ){
            $sql = "delete from msgreport where msgReportNo = {$_REQUEST['msgReportNo']}";
            $msg = $pdo -> exec($sql);
            
            $sql = "select memNo from msg where msgNo = {$_REQUEST['msgNo']}";
            $member = $pdo -> query($sql);
            $memberNo = $member -> fetch();
            $sql = "update member set reportTimes = reportTimes +1 where memNo = {$memberNo['memNo']}";
            
            $sql = "delete from msg where msgNo = {$_REQUEST['msgNo']}";
            $msg = $pdo -> exec($sql);            
            echo 'true';
        }else{
            $sql = "update msgreport set msgCheck = 1 where msgReportNo = {$_REQUEST['msgReportNo']}";
            $overule = $pdo -> exec($sql);
            echo 'true';
        }


    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>