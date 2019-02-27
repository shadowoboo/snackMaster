<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "select snackNo from snack where snackGenre = '巧克力' order by goodStars/goodTimes desc limit 6";
        $choco = $pdo -> query($sql);
        $i = 1;
        while($chocoRow = $choco -> fetch() ){
            $sql = "update rank set snackNo = :snackNo where rankGenre = '巧克力' and ranking = {$i}";
            $chocoRank = $pdo -> prepare($sql);
            $chocoRank -> bindValue(':snackNo', $chocoRow['snackNo']);
            $chocoRank -> execute();
            $i++;
        }
        
        $sql = "select snackNo from snack where snackGenre = '餅乾' order by goodStars/goodTimes desc limit 6";
        $cookie = $pdo -> query($sql);
        $i = 1;
        while($cookieRow = $cookie -> fetch() ){
            $sql = "update rank set snackNo = :snackNo where rankGenre = '餅乾' and ranking = {$i}";
            $cookieRank = $pdo -> prepare($sql);
            $cookieRank -> bindValue(':snackNo', $cookieRow['snackNo']);
            $cookieRank -> execute();
            $i++;
        }

        $sql = "select snackNo from snack where snackGenre = '糖果' order by goodStars/goodTimes desc limit 6";
        $candy = $pdo -> query($sql);
        $i = 1;
        while($candyRow = $candy -> fetch() ){
            $sql = "update rank set snackNo = :snackNo where rankGenre = '糖果' and ranking = {$i}";
            $candyRank = $pdo -> prepare($sql);
            $candyRank -> bindValue(':snackNo', $candyRow['snackNo']);
            $candyRank -> execute();
            $i++;
        }

        $sql = "select snackNo from snack where snackGenre = '洋芋片' order by goodStars/goodTimes desc limit 6";
        $chip = $pdo -> query($sql);
        $i = 1;
        while($chipRow = $chip -> fetch() ){
            $sql = "update rank set snackNo = :snackNo where rankGenre = '洋芋片' and ranking = {$i}";
            $chipRank = $pdo -> prepare($sql);
            $chipRank -> bindValue(':snackNo', $chipRow['snackNo']);
            $chipRank -> execute();
            $i++;
        }

        $sql = "select snackNo from snack order by goodStars/goodTimes desc limit 6";
        $all = $pdo -> query($sql);
        $i = 1;
        while($allRow = $all -> fetch() ){
            $sql = "update rank set snackNo = :snackNo where rankGenre = '綜合' and ranking = {$i}";
            $allRank = $pdo -> prepare($sql);
            $allRank -> bindValue(':snackNo', $allRow['snackNo']);
            $allRank -> execute();
            $i++;
        }
        echo "true";
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>