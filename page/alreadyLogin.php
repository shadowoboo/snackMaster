<?php
    session_start();
    try{
        require_once("connectcd105g2.php");
        //檢查是否已登入
        if (isset($_SESSION["memId"]) === true ) {
            //檢查程式轉入頁
            $loginInfo = array(
            "memId"=>$_SESSION["memId"], 
            "memNo"=>$_SESSION["memNo"], 
            "grade"=>$_SESSION["grade"],
            "memPsw"=>$_SESSION["memPsw"],
            "email"=>$_SESSION["email"],
            "memPic"=>$_SESSION["memPic"],
            "memName"=>$_SESSION["memName"],
            "memPhone"=>$_SESSION["memPhone"],
            "memPoint"=>$_SESSION["memPoint"],
            "commentRight"=>$_SESSION["commentRight"],
            "reportTimes"=>$_SESSION["reportTimes"]
            
        );
            // $_SESSION["where"]=$_SERVER["PHP_SELEF"];
            //編碼成一串
            echo json_encode($loginInfo);

        }else{
            echo "找不到!!";
        }
        
    }catch(PDOException $e){
        echo "失敗",$e->getMessage();
        echo "行號",$e->getLine();

    }

?>