<?php
session_start();
// $forgetPsw = json_decode($_REQUEST["forgetPsw"]);
$id=$_REQUEST["memId"];
$email=$_REQUEST["memEmail"];

 
try {
    require_once("connectcd105g2.php");

    
        $sql ="select memId, email from member where memId=:memId and email=:email";
        $forget = $pdo->prepare($sql);
        $forget ->bindValue(":memId",$id);
        $forget ->bindValue(":email",$email);
        $forget -> execute();
        //先判斷帳號是否存在
        if($forget->rowCount()==0){
            echo "0";//帳號不存在
        }else{
            //帳號存在
            echo "1";//寄出信
        
        
        
    }
    

}catch(PDOException $e){
    echo "失敗",$e->getMessage();
    echo "行號",$e->getLine();

}


?>