<?php
// session_start();
// class rsp{
//     public $snackNo;
//     public $snackPic;
//     public $nation;
//     public $snackName;
//     public $rankHtml;
//     public $snackPrice;
//     public $Etimes;
//     public $avgG;
//     public $avgS;
//     public $avgT;
//     public $avgH;
// }
// $rsp =new rsp();
    $errMsg = "";
    try {
        require_once("connectcd105g2.php");
        //撈出商品資料
        switch($_REQUEST['rankGenre']){
            case 1:
            $rankGenre='綜合';
            break;
            case 2:
            $rankGenre='餅乾';
            break;
            case 3:
            $rankGenre='糖果';
            break;
            case 4:
            $rankGenre='巧克力';
            break;
            case 5:
            $rankGenre='洋芋片';
            break;

        }

        $sql = "SELECT snackNo FROM `rank` WHERE `rankGenre` LIKE '{$rankGenre}' ORDER BY ranking limit 0,6";
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