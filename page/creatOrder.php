<?php
    session_start();
    $getterName = $_REQUEST["getterName"];
    $getterPhone = $_REQUEST["getterPhone"];
    $getterAddr = $_REQUEST["getterAddr"];
    $getterPayType = $_REQUEST["getterPayType"];
    try {
        // echo "error";
        echo $getterName."+".$getterPhone."+".$getterAddr."+".$getterPayType;
        //清除快取
        // session_destroy();
        //清除收件人姓名
        unset($_SESSION['getterName']);
        //清除收件人電話
        unset($_SESSION['getterPhone']);
        //清除收件人地址
        unset($_SESSION['getterAddr']);
        //清除收件人付款方式
        unset($_SESSION['getterPayType']);
        //清除購物車商品
        unset($_SESSION['snackNo']);


    } catch (\Throwable $th) {
        //throw $th;
    }

?>