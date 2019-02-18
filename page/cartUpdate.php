<?php
session_start();

//接收來自按鈕傳的的信號決定要做什麼
//目前有 刪客製 / 刪單品 / 單品增加數量 / 單品減少數量
$updateType= $_REQUEST["updateType"];

//如果有傳snackNo過來，我就心懷感激地收下
if(isset($_REQUEST["snackNo"])){
    $snackNo=$_REQUEST["snackNo"];
}

if(isset($_REQUEST["snackQty"])){
    $snackQty=$_REQUEST["snackQty"];
}



switch ($updateType) {
    case 'cusDel': //如果是cusDel
        //把所有跟客製有關聯($cusType=="y")的session清空
        foreach($_SESSION["cusType"] as $snackNo => $cusType){
            if($cusType=="y"){
                unset($_SESSION["snackName"][$snackNo]);
                unset($_SESSION["snackPrice"][$snackNo]);
                unset($_SESSION["cusType"][$snackNo]);
                unset($_SESSION["snackQty"][$snackNo]);
                unset($_SESSION["snackPic"][$snackNo]);
            }
        }
        //把客製箱圖片、客製卡片、聲音檔清掉
        unset($_SESSION["cusBox"]);
        unset($_SESSION["cusCard"]);
        unset($_SESSION["cusSound"]);
        echo "Done cus clear";
        unset($snackNo);
        break;
    case 'normalDel': //如果是 normalDel
        //清掉會寫入session的項目
        unset($_SESSION["snackName"][$snackNo]);
        unset($_SESSION["snackPrice"][$snackNo]);
        unset($_SESSION["cusType"][$snackNo]);
        unset($_SESSION["snackQty"][$snackNo]);
        unset($_SESSION["snackPic"][$snackNo]);
        echo "Done normal clear ".$snackNo;
        //清掉收到的變數
        unset($snackNo);
        break;
    case 'numMinus': //如果是 numMinus
        $_SESSION["snackQty"][$snackNo]=$snackQty;
        echo $_SESSION["snackQty"][$snackNo];
        unset($snackNo);

        break;
    case 'numPlus': //如果是 numPlus
        $_SESSION["snackQty"][$snackNo]=$snackQty;
        echo $_SESSION["snackQty"][$snackNo];
        unset($snackNo);
        break;
    default:
        echo "something Wrong";
        break;
}

?>