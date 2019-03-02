<?php
//////////////////////////////////////////////////////////////
// 0 一般
// 1 客製
// 2 即期
// 3 預購
//若要重複取得不同 type 的零食
//要考慮把零食型別(客製/一般/即期/預購)也寫進session裡
//ex: $_SESSION["snackName"][$snackType][$snackNo]
/////////////////////////////////////////////////////////////

    session_start();
    $errMsg="";
    try {
        //snackOrder 所需欄位
        $orderName = $_REQUEST["getterName"];
        $phone = $_REQUEST["getterPhone"];
        $address = $_REQUEST["getterAddr"];
        $payWay = $_REQUEST["getterPayType"];
        $memNo= $_SESSION["g2memNo"]; // No 才是唯一
        //no也不是唯一的呢呵呵呵呵呵呵
        $orderTotal= $_REQUEST["orderTotal"];//總額
        //客製箱內的箱子圖 / 卡片圖 / 卡片聲音 依照有無來決定內容
        (isset($_REQUEST["boxPic"]))?$boxPic=$_REQUEST["boxPic"]:$boxPic=null;
        (isset($_REQUEST["cardPic"]))?$cardPic=$_REQUEST["cardPic"]:$cardPic=null;
        (isset($_REQUEST["audioFile"]))?$audioFile=$_REQUEST["audioFile"]:$audioFile=null;
        

        //orderItem 所需欄位
        // $snackPrice= $_SESSION["snackPrice"];
        // $snackQuan=$_SESSION["snackQuan"];
        // $customBoxItem=$_SESSION["cusType"];//如果cusType為y則是客製
        //-----------------以上宣告會報錯，乖乖使用 $_SESSION[""][] 二維陣列
        //取優惠卷
        (isset($_REQUEST["couponboxNo"]))?$couponboxNo=$_REQUEST["couponboxNo"]:$couponboxNo=null;


        //連線
        require_once("connectcd105g2.php");
	    //啟動一個交易
        $pdo->beginTransaction();

    	//INSERT INTO `bookorder` (`orderNo`, `orderMemNo`, `orderTime`, `email`, `payStatus`) value (...........)
        $sql = "INSERT INTO snackorder (orderNo, memNo, planItemNo ,orderTime, orderStatus, payWay, orderTotal, orderName, `address`, phone, boxPic, cardPic, audioFile)
                                values ( null, :memNo, null        ,now()   , '已送達'    ,:payWay, :orderTotal,:orderName, :addr   , :phone, :boxPic, :cardPic, :audioFile)";
        $bookorder = $pdo->prepare( $sql );
        $bookorder->bindValue( ":memNo", $memNo);
        $bookorder->bindValue( ":payWay", $payWay);
        $bookorder->bindValue( ":orderTotal", $orderTotal);
        $bookorder->bindValue( ":orderName", $orderName);
        $bookorder->bindValue( ":addr", $address);
        $bookorder->bindValue( ":phone", $phone);
        $bookorder->bindValue( ":boxPic", $boxPic);
        $bookorder->bindValue( ":cardPic", $cardPic);
        $bookorder->bindValue( ":audioFile", $audioFile);
        $bookorder->execute();

        //取回orderNo , $pdo->lastInsertId();
        //PDO 取得上一筆新增的序號 lastInsertId()
        $orderNo = $pdo->lastInsertId();

        //產生訂單明細
		$sql = "INSERT INTO orderitem (orderItemNo, snackPrice, snackQuan, customBoxItem, snackNo, orderNo) 
                                    values( null , :snackPrice, :snackQuan, :customBoxItem, :snackNo, $orderNo)";
        $orderitem = $pdo->prepare($sql);
        // $snackQty=array();
        // $snackQty=$_SESSION["snackQuan"];
        // $qty=0;//初始化;
        foreach ((array)$_SESSION["snackQuan"] as $type => $snackType) {
            foreach( (array)$snackType as $snackNo => $qty){
            // foreach( $_SESSION["snackQuan"][$type] as $snackNo => $qty){
                $orderitem->bindValue(":snackPrice", $_SESSION["snackPrice"][$type][$snackNo]); //紀錄購入時價錢
                $orderitem->bindValue(":snackQuan", $qty);
                if($type==1){ //如果是客製
                    $orderitem->bindValue(":customBoxItem", 1); //是給1
                }else{
                    $orderitem->bindValue(":customBoxItem", 0); //不是給0
                }
                $orderitem->bindValue(":snackNo", $snackNo); //若 session 錯誤則須補正
                $orderitem->execute();
            }
        }
        


        //變更即期品數量
        if(isset($_SESSION["snackQuan"][2])){ //如果有即期品
            //找出對應的即期品並扣掉本次購買的數量
            $sql = "UPDATE clearanceitem SET`quantity`=`quantity`-:quantity WHERE clearanceNo=:clearanceNo and snackNo=:snackNo";
            $clearanceitem = $pdo->prepare($sql);
            // $snackType2=$_SESSION["snackQuan"][2];
                foreach( (array)$_SESSION["snackQuan"][2] as $snackNo => $qty){
                    //字串處理，把clearanceNo分割出來
                    $str=$_SESSION["note"][2][$snackNo];
                    $arr_str=explode("|",$str);
                    $clearanceNo=$arr_str[1];
                    //把數字塞進去
                    $clearanceitem->bindValue(":quantity",$qty);
                    $clearanceitem->bindValue(":clearanceNo",$clearanceNo);
                    $clearanceitem->bindValue(":snackNo",$snackNo);
                    $clearanceitem->execute();
                }
        }

        //變更優惠卷使用狀態
        if(isset($couponboxNo)){
            $sql = "UPDATE couponbox SET`status`=1 WHERE couponboxNo=:couponboxno";
            $coupbox = $pdo->prepare($sql);
            $coupbox->bindValue(":couponboxno",$couponboxNo);
            $coupbox->execute();
        }



        $pdo->commit();

        //清除快取
        // session_destroy();
        //清除所有零食名
        unset($_SESSION["snackName"]);
        //清除購物清單所有價格
        unset($_SESSION['snackPrice']);
        //清除購物清單所有數量
        unset($_SESSION['snackQuan']);
        //清除購物清單所有類別
        unset($_SESSION["note"]);
        //清除購物清單所有圖片
        unset($_SESSION["snackPic"]);
        //清除客製箱子圖
        unset($_SESSION["cusBox"]);
        //清除客製卡片圖
        unset($_SESSION["cusCard"]);
        //清除客製音檔
        unset($_SESSION["cusSound"]);



        // echo "error";
        echo "orderName:".$orderName." +phone: ".$phone." +address: ".$address."+payWay: ".$payWay;

    } catch (PDOException $e) {
        $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
        $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
        $errMsg .= '$_SESSION["snackQuan"]'.$_SESSION["snackQuan"]. "<br>";
        echo $errMsg;
        $pdo->rollBack();
    }

?>