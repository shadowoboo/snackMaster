<?php
    session_start();
    try{
        require_once("connectcd105g2.php");
        //檢查是否已登入
        if (isset($_SESSION["memId"]) === true ) {
            //檢查程式轉入頁
            
            $_SESSION["where"]=$_SERVER["PHP_SELEF"];
            echo json_decode($loginInfo);

        }else{
            echo "{}";
        }
        
    }catch(PDOException $e){
        echo "失敗",$e->getMessage();
        echo "行號",$e->getLine();

    }

?>