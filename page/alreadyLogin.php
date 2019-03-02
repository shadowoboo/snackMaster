<?php
    session_start();
    try{
        require_once("connectcd105g2.php");
        //檢查是否已登入
        if (isset($_SESSION["g2memNo"])) {
            echo "doneLogin";
        }else{
            echo "notyetLogin";
        }
    }catch(PDOException $e){
        echo "失敗",$e->getMessage();
        echo "行號",$e->getLine();
    }
?>