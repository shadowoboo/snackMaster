<?php
// session_start();
    $errMsg = "";
    try {
        require_once("connectcd105g2.php");
        //撈出商品資料
        switch($_REQUEST['rankGenre']){
            case 1:
            $rankGenre='綜合';
            $sql = "SELECT * FROM `snack` ORDER by `goodStars`/`goodTimes` DESC,`goodTimes` DESC LIMIT 6";
            break;
            case 2:
            $rankGenre='餅乾';
            $sql = "SELECT * FROM `snack` WHERE `snackGenre`='餅乾' ORDER by `goodStars`/`goodTimes` DESC,`goodTimes` DESC LIMIT 6";
            break;
            case 3:
            $rankGenre='糖果';
            $sql = "SELECT * FROM `snack` WHERE `snackGenre`='糖果' ORDER by `goodStars`/`goodTimes` DESC,`goodTimes` DESC LIMIT 6";
            break;
            case 4:
            $rankGenre='巧克力';
            $sql = "SELECT * FROM `snack` WHERE `snackGenre`='巧克力' ORDER by `goodStars`/`goodTimes` DESC,`goodTimes` DESC LIMIT 6";
            break;
            case 5:
            $rankGenre='洋芋片';
            $sql = "SELECT * FROM `snack` WHERE `snackGenre`='洋芋片' ORDER by `goodStars`/`goodTimes` DESC,`goodTimes` DESC LIMIT 6";
            break;

        }

        $feed=$pdo->query($sql);
        $rsp=$feed->fetchAll();
         echo json_encode($rsp) ;
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg ;
        exit();
    }
?>