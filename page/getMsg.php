<?php
class rsp{
    public $memPic;
    public $memId;
    public $msgCtx;
}

$rspArr =[];
$evaNo=$_REQUEST['evaNo'];
try{
require_once("connectcd105g2.php");
 $sql="SELECT `msgText`,`memPic`,`memId`,`msgTime` FROM `msg`,`member` WHERE msg.`evaNo`={$evaNo} AND msg.`memNo`=member.`memNo` ORDER by `msgTime` ASC";

 $feed=$pdo->query($sql);
  while($msgCtx=$feed->fetch()){
    $rsp =new rsp();

    $rsp->memPic=$msgCtx['memPic'];
    $rsp->memId=$msgCtx['memId'];
    $rsp->msgText=$msgCtx['msgText'];
    $rspArr[]=$rsp;
  }  



echo json_encode($rspArr);

}catch(PDOException $e){
  echo $e->getMessage();
}
?>