<?php
    session_start();
    $errorMsg="";
    try {
        if(isset($_SESSION["snackNo"])){ //檢查有沒有 snackNo 存在於 session 之中
            //知之為知之
            echo "prodExist";
        }else{
            //一言不合就error
            echo "error";
        }
    } catch (\Throwable $th) {
        //throw $th;
    }