<?php
 session_start();
//  $regInfo = json_decode($_REQUEST["regInfo"]);

//  $signUpMemId = $_REQUEST["signUpMemId"];
//  $signUpMemPsw = $_REQUEST["signUpMemPsw"];
//  $signUpMemEmail = $_REQUEST["signUpMemEmail"];
// echo "已有人使用";
 try{
     require_once("connectcd105g2.php");
     //先檢查帳號是否存在
     
     $sql ="select * from member where memId= :memId";
     
     $member = $pdo->prepare($sql);
     $member->bindValue(":memId",$_REQUEST["account"] );
     $member->execute();
     //帳號存在
        if ($member->rowCount()!=0) {
            //註冊成功判斷
            echo "1";//帳號已有人使用
        }
        else{
            // echo "帳號可使用";
            $sql_insert = "insert into member (memId, memPsw, email) values (:memId, :memPsw, :email) ";
            $stmt = $pdo->prepare($sql_insert);
            $stmt-> bindValue(":memId",$_REQUEST["account"]);
            $stmt-> bindValue(":memPsw",$_REQUEST["password"]);
            $stmt-> bindValue(":email",$_REQUEST["email"]);
            $stmt-> execute();
            echo "註冊成功";
            // $sql_insert = "insert into member (memId, memPsw, email) values (?, ?, ?) ";
            // $stmt = $pdo->prepare($sql_insert);
            // $stmt-> bindValue(":memId",$regInfo->memId);
            // $stmt-> bindValue(":memPsw",$regInfo->memPsw);
            // $stmt-> bindValue(":email",$regInfo->email);
            // $stmt-> execute();
            // header("Location: member.html");

            // echo json_encode($regInfo);

         }

     
 } catch(PDOException $e){
        echo "失敗",$e->getMessage();
        echo "行號",$e->getLine();

 }




?>