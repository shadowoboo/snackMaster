<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $evaNo = $_REQUEST['evaNo'];
        $evaRepNo = $_REQUEST['evaRepNo'];
        if( $_REQUEST['status'] == 'sustain' ){
            $sql = "select * from msg where evaNo = {$evaNo}";
            $msg = $pdo -> query($sql);
            
            while( $msgRow = $msg -> fetch() ){
                //刪除留言檢舉
                $sql = "delete from msgreport where msgNo = {$msgRow['msgNo']}";
                // $msgReport = $pdo -> exec($sql);
                $pdo -> exec($sql);
                //刪除留言
                $sql = "delete from msg where msgNo = {$msgRow['msgNo']}";
                // $msgs = $pdo -> exec($sql);
                $pdo -> exec($sql);
            };

            //更新商品星等跟次數            
            $sql = "select * from eva where evaNo = {$evaNo}";
            $evas = $pdo -> query($sql);   
            $eva = $evas -> fetch();
            $good = $eva['goodStar'];
            $sour = $eva['sourStar'];
            $sweet = $eva['sweetStar'];
            $spicy = $eva['spicyStar'];
            $snack = $eva['snackNo'];
            $memNo = $eva['memNo'];
            $like = $eva['like'];
            $sql = "update snack set goodTimes = goodTimes - 1, goodStars = goodStars - {$good}, sourTimes = sourTimes - 1, sourStars = sourStars - {$sour}, sweetTimes = sweetTimes - 1, sweetStars = sweetStars - {$sweet}, spicyTimes = spicyTimes - 1, spicyStars = spicyStars - {$spicy} where snackNo = {$snack}";
            $pdo -> exec($sql);

            //會員扣評價跟按讚積分，被檢舉次數+1
            $sql = "update member set memPoint = memPoint - 100 - {$like}, reportTimes = reportTimes + 1 where memNo = {$memNo}";
            $pdo -> exec($sql);

            //判斷是否禁言
            $sql = "select reportTimes from member where memNo = {$memNo}";
            $reportTimes = $pdo -> query($sql);
            $timesRow = $reportTimes -> fetch();
            if( $timesRow['reportTimes'] >= 3){
                $sql = "update member set commentRight = 0 where memNo = {$memNo}";
                $pdo -> exec($sql);
            }

            //刪除檢舉
            $sql = "delete from evareport where evaNo = {$evaNo}";
            $pdo -> exec($sql);

            //刪除評價    
            $sql = "delete from eva where evaNo = {$evaNo}";
            $pdo -> exec($sql);

            echo 'true';
        }else{
            $sql = "update evareport set evaCheck = 1 where evaRepNo = {$_REQUEST['evaRepNo']}";
            $overule = $pdo -> exec($sql);
            echo 'true';
        }
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>