<?php
session_start();
// 編譯一個字串
$loginInfo = json_decode($_POST["loginInfo"]);
try{
  require_once("connectcd105g2.php");
  $sql = "select * from member where memId=:memId and memPsw = :memPsw";
  $member = $pdo->prepare( $sql );
  $member -> bindParam( ":memId", $loginInfo->memId);
  $member -> bindParam( ":memPsw", $loginInfo->memPsw);
  $member -> execute();


  if( $member->rowCount()==0){ //查無此人
	  echo 0;
  }else{ //登入成功
    //自資料庫中取回資料
  	$memRow = $member -> fetch(PDO::FETCH_ASSOC);

    //將登入者資料寫入session
    $_SESSION["g2memNo"] = $memRow["memNo"];
    $_SESSION["g2memId"] = $memRow["memId"];
    

    //送出登入者的姓名資料
    echo $memRow["memId"];
  }
}catch(PDOException $e){
  echo $e->getMessage();
}
?>