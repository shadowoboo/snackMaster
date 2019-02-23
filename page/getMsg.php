<?php
class rsp{
    public $memPic;
    public $memId;
    public $msgCtx;
    public $msgTime;
    public $msgNo;
}

$rspArr =[];
$evaNo=$_REQUEST['evaNo'];
try{
require_once("connectcd105g2.php");
 $sql="SELECT `msgText`,`memPic`,`memId`,`msgTime`,`msgNo` FROM `msg`,`member` WHERE msg.`evaNo`={$evaNo} AND msg.`memNo`=member.`memNo` ORDER by `msgTime` DESC";

 $feed=$pdo->query($sql);
  while($msgCtx=$feed->fetch()){
    $rsp =new rsp();

    $rsp->memPic=$msgCtx['memPic'];
    $rsp->memId=$msgCtx['memId'];
    $rsp->msgText=$msgCtx['msgText'];
    $rsp->msgTime=$msgCtx['msgTime'];
    $rsp->msgNo=$msgCtx['msgNo'];
    $rspArr[]=$rsp;
  }  



echo json_encode($rspArr);

}catch(PDOException $e){
  echo $e->getMessage();
}
?>