<?php

session_start();

try{
require_once("connectcd105g2.php");
$sql="SELECT * FROM `couponbox` WHERE `memNo`=:memNo AND `status`=0  AND`coupNo`=:coupNo";
$cehckCp= $pdo->prepare($sql);
$cehckCp -> bindParam( ":memNo", $_SESSION["memNo"]);
$cehckCp -> bindParam( ":coupNo",$_REQUEST["coupNo"] );
$cehckCp->execute();
if( $cehckCp->rowCount()==0){
    $sql="INSERT INTO `couponbox` (`memNo`, `coupNo`, `startDate`, `endDate`, `status`)
    VALUES (:memNo, :coupNo, CURRENT_TIMESTAMP, ADDDATE(CURDATE(),INTERVAL 1 MONTH ), '0');";
    $sendMsg = $pdo->prepare( $sql );
    $sendMsg -> bindParam( ":memNo", $_SESSION["memNo"]);
    $sendMsg -> bindParam( ":coupNo",$_REQUEST["coupNo"] );
    $sendMsg -> execute();
    echo 1;

}else{

    echo 0;
}



}catch(PDOException $e){
  echo $e->getMessage();
}
?>