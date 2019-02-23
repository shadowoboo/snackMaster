<?php
session_start();
class rsp{
    public $snackNo;
    public $snackPic;
    public $nation;
    public $snackName;
    public $rankHtml;
    public $snackPrice;
    public $Etimes;
    public $avgG;
    public $avgS;
    public $avgT;
    public $avgH;
}
$rsp =new rsp();
    $errMsg = "";
    try {
        require_once("connectcd105g2.php");
        //撈出商品資料
        $sql = "SELECT * FROM snack WHERE snackNo={$_REQUEST['snackNo']}";
        $feed=$pdo->query($sql);
        $snackRow=$feed->fetch();
        //撈出評價分數資料
        $sql ="SELECT 
                COUNT(snackNo) as Etimes,
                AVG(goodStar) as avgG,
                AVG(sourStar) as avgS,
                AVG(sweetStar) as avgT,
                AVG(spicyStar) as avgH  
                FROM `eva` WHERE `snackNo`={$_REQUEST['snackNo']}";
        $feed=$pdo->query($sql);
        $evaRow=$feed->fetch();
        $Etimes =$evaRow['Etimes'];
        $avgG =number_format($evaRow['avgG'],1);
        $avgS =number_format($evaRow['avgS'],1);
        $avgT =number_format($evaRow['avgT'],1);
        $avgH =number_format($evaRow['avgH'],1);

        //撈出排名資料
        $sql="SELECT * FROM `rank` WHERE `snackNo`={$_REQUEST['snackNo']}";
        $Rankfeed=$pdo->query($sql);
        $rankHtml='';
        $i=1;
        $month=Date("m")==1?12:Date("m")-1;
        $year= Date("m")==1?Date("Y")-1:Date("Y");
        while($i<4){
            if($rankRow=$Rankfeed->fetch()){
                $rankHtml.="<div class='rank' id='rank{$i}'>{$year}年{$month}月{$rankRow['rankGenre']}排行 第{$rankRow['ranking']}名</div>";         
            }else{
                if($i==1){
                    $rankHtml.="<div class='rank'  id='rank0'>本商品目前尚未上榜</div>";
                }else{
                    $rankHtml.="<div class='rank notRank'  id='rank{$i}'>本商品目前尚未上榜</div>";
                }
                
            }
            $i++;
        }

         $rsp->snackNo=$snackRow['snackNo'];
         $rsp->snackPic=$snackRow['snackPic'];
         $rsp->nation=$snackRow['nation'];
         $rsp->snackName=$snackRow['snackName'];
         $rsp->rankHtml=$rankHtml;
         $rsp->snackPrice=$snackRow['snackPrice'];
         $rsp->Etimes=$Etimes;
         $rsp->avgG=$avgG;
         $rsp->avgS=$avgS;
         $rsp->avgT=$avgT;
         $rsp->avgH=$avgH;

         echo json_encode($rsp) ;
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg ;
        exit();
    }
?>