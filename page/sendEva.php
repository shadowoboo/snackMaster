<?php

session_start();

try{
require_once("connectcd105g2.php");
 $sql="INSERT INTO `eva` (`evaNo`, `memNo`, `snackNo`, `evaCtx`, `evaPic`, `evaDate`, `like`, `goodStar`, `sourStar`, `sweetStar`, `spicyStar`) 
       VALUES (NULL, :memNo, :snackNo, :evaCtx, NULL, CURRENT_TIMESTAMP, '0', :goodStar, :sourStar, :sweetStar, :spicyStar)";
  $sendEva = $pdo->prepare( $sql );
  $sendEva -> bindParam( ":memNo", $_SESSION["memNo"]);
  $sendEva -> bindParam( ":snackNo",$_REQUEST["snackNo"] );
  $sendEva -> bindParam( ":evaCtx", $_REQUEST["evaCtx"] );
  $sendEva -> bindParam( ":goodStar", $_REQUEST["goodStar"] );
  $sendEva -> bindParam( ":sourStar", $_REQUEST["sourStar"] );
  $sendEva -> bindParam( ":sweetStar", $_REQUEST["sweetStar"] );
  $sendEva -> bindParam( ":spicyStar", $_REQUEST["spicyStar"] );
  $sendEva -> execute();

$point_sql = "update member set memPoint = memPoint + 100 where memNo =:memNo";
$point = $pdo->prepare( $point_sql );
$point -> bindParam( ":memNo", $_SESSION["memNo"]);
$point -> execute();
  

}catch(PDOException $e){
  echo $e->getMessage();
}
?>