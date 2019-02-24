<?php 
    session_start();
    
    try{
        require_once("connectcd105g2.php");
        
        

    }catch(PDOException $e){
        echo "失敗",$e->getMessage();
        echo "行號",$e->getLine();
        // echo "QQ";

    }


?>