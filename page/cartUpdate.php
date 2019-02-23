<?php
session_start();

//接收來自按鈕傳的的信號決定要做什麼
//目前有 刪客製 / 刪單品 / 單品增加數量 / 單品減少數量
$updateType= $_REQUEST["updateType"];

//如果有傳snackNo過來，我就心懷感激地收下
if(isset($_REQUEST["snackNo"])){
    $snackNo=$_REQUEST["snackNo"];
}

if(isset($_REQUEST["snackQuan"])){
    $snackQuan=$_REQUEST["snackQuan"];
}

if(isset($_REQUEST["snackType"])){
    $snackType=$_REQUEST["snackType"];
}



switch ($updateType) {
    case 'cusDel': //如果是cusDel
        //把所有跟客製有關聯的session清空
        foreach((array)$_SESSION["snackQuan"][1] as $snackNo => $qty){
                unset($_SESSION["snackName"][1][$snackNo]);
                unset($_SESSION["snackPrice"][1][$snackNo]);
                unset($_SESSION["snackQuan"][1][$snackNo]);
                unset($_SESSION["snackPic"][1][$snackNo]);
                unset($_SESSION["note"][1][$snackNo]);
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
        unset($_SESSION["snackName"][$snackType][$snackNo]);
        unset($_SESSION["snackPrice"][$snackType][$snackNo]);
        unset($_SESSION["note"][$snackType][$snackNo]);
        unset($_SESSION["cusType"][$snackType][$snackNo]);
        unset($_SESSION["snackQuan"][$snackType][$snackNo]);
        unset($_SESSION["snackPic"][$snackType][$snackNo]);
        echo "Done normal clear ".$snackNo;
        //清掉收到的變數
        unset($snackNo);
        break;
    case 'numMinus': //如果是 numMinus
        $_SESSION["snackQuan"][$snackType][$snackNo]=$snackQuan;
        echo $_SESSION["snackQuan"][$snackType][$snackNo];
        unset($snackNo);
        break;
    case 'numPlus': //如果是 numPlus
        $_SESSION["snackQuan"][$snackType][$snackNo]=$snackQuan;
        echo $_SESSION["snackQuan"][$snackType][$snackNo];
        unset($snackNo);
        break;
    default:
        echo "something Wrong";
        break;
}

?>