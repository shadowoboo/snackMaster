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
            //刪除所有留言檢舉
            $sql = "delete from msgreport where msgNo = {$_REQUEST['msgNo']}";
            $pdo -> exec($sql);
            
            //會員被檢舉次數+1
            $sql = "select memNo from msg where msgNo = {$_REQUEST['msgNo']}";
            $member = $pdo -> query($sql);
            $memberNo = $member -> fetch();
            $sql = "update member set reportTimes = reportTimes + 1 where memNo = {$memberNo['memNo']}";
            $pdo -> exec($sql);
            //判斷是否禁言
            $sql = "select reportTimes from member where memNo = {$memberNo['memNo']}";
            $reportTimes = $pdo -> query($sql);
            $timesRow = $reportTimes -> fetch();
            if( $timesRow['reportTimes'] >= 3){
                $sql = "update member set commentRight = 0 where memNo = {$memberNo['memNo']}";
                $pdo -> exec($sql);
            }

            $sql = "delete from msg where msgNo = {$_REQUEST['msgNo']}";
            $pdo -> exec($sql);            
            echo 'true';
        }else{
            $sql = "update msgreport set msgCheck = 1 where msgReportNo = {$_REQUEST['msgReportNo']}";
            $pdo -> exec($sql);
            echo 'true';
        }


    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>