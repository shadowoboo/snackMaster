<?php
    session_start();
    $errMsg="";
    try {
        //snackOrder 所需欄位
        $orderName = $_REQUEST["getterName"];
        $phone = $_REQUEST["getterPhone"];
        $address = $_REQUEST["getterAddr"];
        $payWay = $_REQUEST["getterPayType"];
        $memNo= $_SESSION["memNo"]; // No 才是唯一
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


        //連線
        require_once("connectcd105g2.php");
	    //啟動一個交易
        $pdo->beginTransaction();

    	//INSERT INTO `bookorder` (`orderNo`, `orderMemNo`, `orderTime`, `email`, `payStatus`) value (...........)
        $sql = "INSERT INTO snackorder (orderNo, memNo, planItemNo ,orderTime, orderStatus, payWay, orderTotal, orderName, `address`, phone, boxPic, cardPic, audioFile)
                                values ( null, :memNo, null        ,now()   , '運送中'    ,:payWay, :orderTotal,:orderName, :addr   , :phone, :boxPic, :cardPic, :audioFile)";
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
        foreach( $_SESSION["snackQuan"] as $snackNo => $qty){
            $orderitem->bindValue(":snackPrice", $_SESSION["snackPrice"][$snackNo]); //紀錄購入時價錢
            $orderitem->bindValue(":snackQuan", $qty);
            if($_SESSION["cusType"][$snackNo]="y"){ //如果是客製
                $orderitem->bindValue(":customBoxItem", 1); //是給1
            }else{
                $orderitem->bindValue(":customBoxItem", 0); //不是給0
            }
            $orderitem->bindValue(":snackNo", $snackNo); //若 session 錯誤則須補正
            $orderitem->execute();
        }


        //刪除即期品


        //刪除使用的優惠卷

        $pdo->commit();

        //清除快取
        // session_destroy();
        //清除購物清單所有價格
        unset($_SESSION['snackPrice']);
        //清除購物清單所有數量
        unset($_SESSION['snackQuan']);
        //清除購物清單所有類別
        unset($_SESSION['cusType']);


        // echo "error";
        echo "orderName:".$orderName." +phone: ".$phone." +address: ".$address."+payWay: ".$payWay;

    } catch (PDOException $e) {
        $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
        $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
        echo $errMsg;
        $pdo->rollBack();
    }

?>