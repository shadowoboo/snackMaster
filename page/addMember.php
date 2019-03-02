<?php
 session_start();
 try{
    require_once("connectcd105g2.php");
    //先檢查帳號是否存在
    
    $sql ="select * from member where memId= :memId";
    
    $member = $pdo->prepare($sql);
    $member->bindValue(":memId",$_REQUEST["account"] );
    $member->execute();
    //帳號存在
       if ($member->rowCount()!=0) {
             echo "1";//帳號已有人使用
       }
       else{
           // echo "帳號可使用";
           $sql_insert = "insert into member (memId, memPsw, email, memPic) values (:memId, :memPsw, :email, '../images/Level/level0.png') ";
           $stmt = $pdo->prepare($sql_insert);
           $stmt-> bindValue(":memId",$_REQUEST["account"]);
           $stmt-> bindValue(":memPsw",$_REQUEST["password"]);
           $stmt-> bindValue(":email",$_REQUEST["email"]);
           $stmt-> execute();
           echo "註冊成功";
           $_SESSION["g2memNo"] = $pdo -> lastInsertId();
           $_SESSION["g2memId"] = $_REQUEST["account"];
        }    
} catch(PDOException $e){
       echo "失敗",$e->getMessage();
       echo "行號",$e->getLine();
}
?>