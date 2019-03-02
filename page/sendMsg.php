<?php

session_start();
if($_REQUEST["msgText"]==''){

  echo 2;

}else{
  try{
    require_once("connectcd105g2.php");
    $sql="SELECT `commentRight` FROM `member` WHERE `memNo`={$_SESSION["g2memNo"]}";
    $sendMsg = $pdo->query( $sql );
    $sendRight= $sendMsg->fetchColumn();

    if($sendRight==1){
      $sql="INSERT INTO `msg` (`msgNo`, `memNo`, `msgText`, `msgTime`, `evaNo`) 
            VALUES (NULL, :memNo, :msgText, CURRENT_TIMESTAMP, :evaNo)";
        $sendMsg = $pdo->prepare( $sql );
        $sendMsg -> bindParam( ":memNo", $_SESSION["g2memNo"]);
        $sendMsg -> bindParam( ":msgText",$_REQUEST["msgText"] );
        $sendMsg -> bindParam( ":evaNo", $_REQUEST["evaNo"] );
        $sendMsg -> execute();
    }else{
      echo 3;
    }

    }catch(PDOException $e){
      echo $e->getMessage();
    }

}

?>