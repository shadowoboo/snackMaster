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
    
        $Etimes =$snackRow['goodTimes'];
        $avgG =number_format($snackRow['goodStars']/$snackRow['goodTimes'],1);
        $avgS =number_format($snackRow['sourStars']/$snackRow['goodTimes'],1);
        $avgT =number_format($snackRow['sweetStars']/$snackRow['goodTimes'],1);
        $avgH =number_format($snackRow['spicyStars']/$snackRow['goodTimes'],1);

        //撈出排名資料
        if(isset($_SESSION['allRank'])){
            if(in_array($_REQUEST['snackNo'],$_SESSION['allRank'])){

                $allRankName=array_search($_REQUEST['snackNo'],$_SESSION['allRank'])+1;
                // echo 'line37'.$allRankName;
            }else{
                $allRankName=0;
            }
        }else{
            $sql = "SELECT * FROM `snack` ORDER by `goodStars`/`goodTimes` DESC LIMIT 6";
            $allRank=$pdo->query($sql);
            while($feed=$allRank->fetchColumn()){
                $_SESSION['allRank'][]=$feed;
            }
            if(in_array($_REQUEST['snackNo'],$_SESSION['allRank'])){

                $allRankName=array_search($_REQUEST['snackNo'],$_SESSION['allRank'])+1;
                // echo 'line50'.$allRankName;
            }else{
                $allRankName=0;
            }
        }

        if(isset($_SESSION[$snackRow['snackGenre']])){
            //先看有沒有把資料存在Session
            if(in_array($_REQUEST['snackNo'],$_SESSION[$snackRow['snackGenre']])){
                //目前這個商品在前六名之中
                //就等於他的
                $catRankName=array_search($_REQUEST['snackNo'],$_SESSION[$snackRow['snackGenre']])+1;
                // echo 'line62'.$catRankName;
            }else{
                $catRankName=0;
            }
        }else{
            $sql = "SELECT * FROM `snack`  WHERE `snackGenre`='{$snackRow['snackGenre']}'  ORDER by `goodStars`/`goodTimes` DESC LIMIT 6";
            $allRank=$pdo->query($sql);
            while($feed=$allRank->fetchColumn()){
                $_SESSION[$snackRow['snackGenre']][]=$feed;
            }
            if(in_array($_REQUEST['snackNo'],$_SESSION[$snackRow['snackGenre']])){
                $catRankName=array_search($_REQUEST['snackNo'],$_SESSION[$snackRow['snackGenre']])+1;
                // echo 'line74'.$catRankName;
            }else{
                $catRankName=0;
            }
        }        

        $rankHtml='';
        $month=Date("m")==1?12:Date("m")-1;
        $year= Date("m")==1?Date("Y")-1:Date("Y");

            if($allRankName>0 && $catRankName>0){
                //雙冠
                $rankHtml.="<div class='rank' id='rank1'>{$year}年{$month}月綜合排行 第{$allRankName}名</div>";
                $rankHtml.="<div class='rank' id='rank2'>{$year}年{$month}月{$snackRow['snackGenre']}排行 第{$catRankName}名</div>";
            }else if($allRankName==0 && $catRankName>0){
                //單冠
                $rankHtml.="<div class='rank' id='rank2'>{$year}年{$month}月{$snackRow['snackGenre']}排行 第{$catRankName}名</div>";
            }else{
                $rankHtml.="<div class='rank'  id='rank0'>本商品目前尚未上榜</div>";
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