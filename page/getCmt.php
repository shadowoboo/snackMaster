<?php
class rsp{
    public $pages;
    public $cmtArr;
}

$rsp =new rsp();
try{
require_once("connectcd105g2.php");
$page = isset($_REQUEST['page'])?$_REQUEST['page']:0;
$snackNo =$_REQUEST['snackNo'];

if($page==0){//第一次進來 要回傳第0~2的評價 以及要產生多少頁碼
    // $recPerPage = 3;//每次三則評價
    $sql="SELECT COUNT(`evaNo`) FROM `eva` WHERE `snackNo`={$snackNo}";
    $countSta = $pdo -> query($sql);//去算這個商品共有幾則評價
    $totalRec = ($countSta -> fetchColumn() );

    if($totalRec==0){//商品目前無評價
        $cmts=1;
    }else{
        $totalPage=ceil($totalRec/3);//總共要產生幾頁''
        
        $pageHTML=
        '<ul><li class="page-item"><a href="#" id="last" class="page-link"><i class="fas fa-chevron-left"></i></a></li>';
       for($i=1;$i<$totalPage+1;$i++){
        $pageHTML.='<li class="page-item"><a href="#" class="page-link ">'.$i.'</a></li>';
       }
            
        $pageHTML.='<li class="page-item"><a href="#" id="next" class="page-link"><i class="fas fa-chevron-right"></i></a></li>
        </ul>';
        $rsp->pages=$pageHTML;
        // <li class="page-item"><a href="#" class="page-link nowLoc">01</a></li>
        // <li class="page-item"><a href="#" class="page-link">02</a></li>
        // <li class="page-item"><a href="#" class="page-link">03</a></li>


        $sql="SELECT `evaNo`,`snackNo`,`evaCtx`,`evaDate`,`goodStar`,`memId`,`memPic`,`like` FROM `eva`,`member` WHERE eva.`snackNo`={$snackNo} AND eva.memNo=member.memNo ORDER BY eva.`evaDate` DESC limit 0,3";
        $feed=$pdo->query($sql);
        $cmtsHTML='';
        while($cmt=$feed->fetch()){
        $cmtsHTML.=
        '<div class="mem">
            <div class="memPic">
                <img src="'.$cmt["memPic"].'" alt="會員頭像" class="memImg">
            </div>
            <div class="memCol">
                <div class="memId">
                    <p>'.$cmt["memId"].'</p><button class="report">...</button>
                </div>
                <div class="star" grad="'.$cmt["goodStar"].'"><img src="../images/rankBoard/starMask.png" alt="星等"></div>
                <p class="commentCtx">
                '.$cmt["evaCtx"].'
                </p>
                <div class="commentBtns">
                    <button class="like"><i class="far fa-thumbs-up"></i>'.$cmt["like"].'</button>
                    <button class="share"><i class="fas fa-share"></i>分享</button>
                    <button class="btnMsg" evaNo='.$cmt["evaNo"].'><i class="fas fa-comment"></i>顯示留言</button>
                </div>

                <div class="msgBox">
                    <input type="text" class="msg" name="msg" placeholder="留言......">
                    <input type="submit" class="sendMsg" evaNo='.$cmt["evaNo"].' value="送出">
                </div>
                <div class="msgs" id="msgBox'.$cmt["evaNo"].'">
                </div>

            </div>
        </div>';
        }

        $rsp->cmtArr =$cmtsHTML;
    }


}else{//之後進來要某頁的評價 就回傳某個開始之後的3筆資料回去
    $start=($page-1)*3;
    $sql="SELECT `evaNo`,`snackNo`,`evaCtx`,`evaDate`,`goodStar`,`memId`,`memPic`,`like` FROM `eva`,`member` WHERE eva.`snackNo`={$snackNo} AND eva.memNo=member.memNo ORDER BY eva.`evaDate` DESC limit $start,3";
    $feed=$pdo->query($sql);
    $cmtsHTML='';
    while($cmt=$feed->fetch()){
    $cmtsHTML.=
    '<div class="mem">
        <div class="memPic">
            <img src="'.$cmt["memPic"].'" alt="會員頭像" class="memImg">
        </div>
        <div class="memCol">
            <div class="memId">
                <p>'.$cmt["memId"].'</p><button class="report">...</button>
            </div>
            <div class="star" grad="'.$cmt["goodStar"].'"><img src="../images/rankBoard/starMask.png" alt="星等"></div>
            <p class="commentCtx">
            '.$cmt["evaCtx"].'
            </p>
            <div class="commentBtns">
                <button class="like"><i class="far fa-thumbs-up"></i>'.$cmt["like"].'</button>
                <button class="share"><i class="fas fa-share"></i>分享</button>
                <button class="btnMsg" evaNo='.$cmt["evaNo"].'><i class="fas fa-comment"></i>顯示留言</button>
            </div>

            <div class="msgBox">
                <input type="text" class="msg" name="msg" placeholder="留言......">
                <input type="submit" class="sendMsg" evaNo='.$cmt["evaNo"].' value="送出">
            </div>
            <div class="msgs" id="msgBox'.$cmt["evaNo"].'">
            </div>
        </div>
    </div>';
    }

    $rsp->cmtArr =$cmtsHTML;
}



echo json_encode($rsp);

}catch(PDOException $e){
  echo $e->getMessage();
}
?>