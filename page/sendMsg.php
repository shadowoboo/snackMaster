<?php

session_start();
if($_REQUEST["msgText"]==''){

  echo 2;

}else{
  try{
    require_once("connectcd105g2.php");
     $sql="INSERT INTO `msg` (`msgNo`, `memNo`, `msgText`, `msgTime`, `evaNo`) 
           VALUES (NULL, :memNo, :msgText, CURRENT_TIMESTAMP, :evaNo)";
      $sendMsg = $pdo->prepare( $sql );
      $sendMsg -> bindParam( ":memNo", $_SESSION["memNo"]);
      $sendMsg -> bindParam( ":msgText",$_REQUEST["msgText"] );
      $sendMsg -> bindParam( ":evaNo", $_REQUEST["evaNo"] );
      $sendMsg -> execute();
    }catch(PDOException $e){
      echo $e->getMessage();
    }

}

?>