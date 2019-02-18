<?php
    session_start();
    try{
        require_once("connectcd105g2.php");
        //檢查是否已登入
        if (isset($_SESSION["memId"]) === true ) {
            //檢查程式轉入頁
            $_SESSION["where"]=$_SERVER["PHP_SELEF"];

        }else{
            $errMsg = "<script>window.alert('您不是會員，請登入');</script>";
        }
        
    }catch(PDOException $e){
        echo "失敗",$e->getMessage();
        echo "行號",$e->getLine();

    }
    

?>