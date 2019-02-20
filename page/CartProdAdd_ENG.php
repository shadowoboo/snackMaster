<?php
    /////////模擬會員登入 與 商品清單 的行為//////////

    session_start();

    //撈出所有商品資料
    require_once("connectcd105g2.php");
    $sql = "select * from snack "; //''
	//$sql = "select * from member where memId='Sara' and memPsw='' or '1'";
	$prod = $pdo->prepare( $sql ); //先編譯好
    $prod->execute();//執行之
    $prodRow = $prod->fetchAll(PDO::FETCH_ASSOC);

    //會員登入模擬
    $_SESSION["memNo"]=1;
    // echo "memId: ".$_SESSION["memId"]." already loggin";

    //購物清單模擬
    // $_SESSION["snackNo"][0]=1;
    // echo "Done write ".'$_SESSION["snackNo"]'."=".$_SESSION["snackNo"];

    ////客製箱模擬
    //1. 當在客製步驟 "加入零食箱"
    //利用 snackNo創造二維陣列 by 董董
    // $_SESSION["snackName"][$snackNo]=$prodRow[$snackNo]["snackName"]; //零食名稱
    // $_SESSION["snackPrice"][$snackNo]=$prodRow[$snackNo]["snackPrice"]; //零食價格
    // $_SESSION["cusType"][$snackNo]="y"; //型態: y, 代表"與客製箱一組"
    // $_SESSION["snackQuan"][$snackNo]=1; //預設數量為1
    // $_SESSION["snackPic"][$snackNo]=$prodRow[$snackNo]["snackPic"]; //零食圖片
    //2. 當客製步驟 "加入購物車"
    //箱子利用複寫，不給重複添加
    // $_SESSION["cusBox"]="../images/customized/ip5.png"; //預計截圖之後(?)產生檔案，先導一張存在的圖擋一下
    // $_SESSION["cusCard"]="../images/customized/card.png"; //預計截圖(連文字)之後(?)產生檔案，先導一張圖撐一下
    // $_SESSION["cusSound"]="../codeTesting/Mozart1.mp3"; //預計錄音(?)產生檔案，先給莫札特秀一下
    // $_SESSION["snackName"][49]=$prodRow[49]["snackName"]; //寫死49，TABLE snack 裡的 49號 就是客製箱代號
    // $_SESSION["snackPrice"][49]=$prodRow[49]["snackPrice"]; //寫死49，TABLE snack 裡的 49號 就是客製箱代號
    // $_SESSION["cusType"][49]="y"; //寫死49，自己要支持自己是客製箱，選y
    // $_SESSION["snackQuan"][49]=1;　//就一個，不給改


    // //箱子利用複寫，不給重複添加
    $_SESSION["cusBox"]="../images/customized/ip5.png"; //預計截圖之後產生檔案
    $_SESSION["cusCard"]="../images/customized/card.png"; //預計截圖之後產生檔案
    $_SESSION["cusSound"]="../codeTesting/Mozart1.mp3"; //預計錄音產生檔案
    $_SESSION["snackName"][49]=$prodRow[49]["snackName"];
    $_SESSION["snackPrice"][49]=$prodRow[49]["snackPrice"];
    $_SESSION["cusType"][49]="y";
    $_SESSION["snackQuan"][49]=1;
    // // $_SESSION["snackPic"][49]=$prodRow[49]["snackPic"]; //客製箱只抓截圖檔，所以不撈此檔案
    // //跟客製有關聯的商品
    // $_SESSION["snackName"][0]=$prodRow[0]["snackName"];
    // $_SESSION["snackPrice"][0]=$prodRow[0]["snackPrice"];
    // $_SESSION["cusType"][0]="y";
    // $_SESSION["snackQuan"][0]=1;
    // $_SESSION["snackPic"][0]=$prodRow[0]["snackPic"];

    // $_SESSION["snackName"][1]=$prodRow[1]["snackName"];
    // $_SESSION["snackPrice"][1]=$prodRow[1]["snackPrice"];
    // $_SESSION["cusType"][1]="y";
    // $_SESSION["snackQuan"][1]=1;
    // $_SESSION["snackPic"][1]=$prodRow[1]["snackPic"];
    // $_SESSION["snackName"][2]=$prodRow[2]["snackName"];
    // $_SESSION["snackPrice"][2]=$prodRow[2]["snackPrice"];
    // $_SESSION["cusType"][2]="y";
    // $_SESSION["snackQuan"][2]=1;
    // $_SESSION["snackPic"][2]=$prodRow[2]["snackPic"];
    // $_SESSION["snackName"][3]=$prodRow[3]["snackName"];
    // $_SESSION["snackPrice"][3]=$prodRow[3]["snackPrice"];
    // $_SESSION["cusType"][3]="y";
    // $_SESSION["snackQuan"][3]=1;
    // $_SESSION["snackPic"][3]=$prodRow[3]["snackPic"];
    // $_SESSION["snackName"][4]=$prodRow[4]["snackName"];
    // $_SESSION["snackPrice"][4]=$prodRow[4]["snackPrice"];
    // $_SESSION["cusType"][4]="y";
    // $_SESSION["snackQuan"][4]=1;
    // $_SESSION["snackPic"][4]=$prodRow[4]["snackPic"];

    //即期品可能會產生 外來鍵問題 導致無法新增訂單明細
    
    // $_SESSION["snackName"][0]=$prodRow[0]["snackName"];
    // $_SESSION["snackPrice"][0]=$prodRow[0]["snackPrice"];
    // $_SESSION["cusType"][0]="n";
    // $_SESSION["snackQuan"][0]=1;
    // $_SESSION["snackPic"][0]=$prodRow[0]["snackPic"];

    // $_SESSION["snackName"][21]=$prodRow[21]["snackName"];
    // $_SESSION["snackPrice"][21]=$prodRow[21]["snackPrice"];
    // $_SESSION["cusType"][21]="n";
    // $_SESSION["snackQuan"][21]=1;
    // $_SESSION["snackPic"][21]=$prodRow[21]["snackPic"];
    
    // $_SESSION["snackName"][45]=$prodRow[45]["snackName"];
    // $_SESSION["snackPrice"][45]=$prodRow[45]["snackPrice"];
    // $_SESSION["cusType"][45]="n";
    // $_SESSION["snackQuan"][45]=1;
    // $_SESSION["snackPic"][45]=$prodRow[45]["snackPic"];

    //收藏 1 / 12 / 16 / 19 / 39
    // $_SESSION["snackName"][0]=$prodRow[0]["snackName"];
    // $_SESSION["snackPrice"][0]=$prodRow[0]["snackPrice"];
    // $_SESSION["cusType"][0]="n";
    // $_SESSION["snackQuan"][0]=0;
    // $_SESSION["snackPic"][0]=$prodRow[0]["snackPic"];

    // $_SESSION["snackName"][11]=$prodRow[11]["snackName"];
    // $_SESSION["snackPrice"][11]=$prodRow[11]["snackPrice"];
    // $_SESSION["cusType"][11]="n";
    // $_SESSION["snackQuan"][11]=1;
    // $_SESSION["snackPic"][11]=$prodRow[11]["snackPic"];

        // $_SESSION["snackName"][15]=$prodRow[15]["snackName"];
    // $_SESSION["snackPrice"][15]=$prodRow[15]["snackPrice"];
    // $_SESSION["cusType"][15]="n";
    // $_SESSION["snackQuan"][15]=1;
    // $_SESSION["snackPic"][15]=$prodRow[15]["snackPic"];

        // $_SESSION["snackName"][18]=$prodRow[18]["snackName"];
    // $_SESSION["snackPrice"][18]=$prodRow[18]["snackPrice"];
    // $_SESSION["cusType"][18]="n";
    // $_SESSION["snackQuan"][18]=1;
    // $_SESSION["snackPic"][18]=$prodRow[18]["snackPic"];

    $_SESSION["snackName"][38]=$prodRow[38]["snackName"];
    $_SESSION["snackPrice"][38]=$prodRow[38]["snackPrice"];
    $_SESSION["cusType"][38]="n";
    $_SESSION["snackQuan"][38]=1;
    $_SESSION["snackPic"][38]=$prodRow[38]["snackPic"];



    // // //單品
    // $_SESSION["snackName"][13]=$prodRow[13]["snackName"];
    // $_SESSION["snackPrice"][13]=$prodRow[13]["snackPrice"];
    // $_SESSION["cusType"][13]="n"; //單品:不跟客製化連結，故選 "n" (目前問題: 一個種類的商品只能選擇 客製 或 非客製)
    // $_SESSION["snackQuan"][13]=1; //加入購物車時預設數量為 1 ，商品數量在購物車調整
    // $_SESSION["snackPic"][13]=$prodRow[13]["snackPic"];
    // // // ////其中 [13] 是商品寫入 session時的 $snackNo
    // // // $_SESSION["snackName"][$snackNo]=$prodRow[$snackNo]["snackName"];
    // // // $_SESSION["snackPrice"][$snackNo]=$prodRow[$snackNo]["snackPrice"];
    // // // $_SESSION["cusType"][$snackNo]="n";
    // // // $_SESSION["snackQuan"][$snackNo]=1;
    // // // $_SESSION["snackPic"][$snackNo]=$prodRow[$snackNo]["snackPic"];


    // // //預購
    // // //尚未確認有無卡關問題
    // // $_SESSION["snackName"][$snackNo]=$prodRow[$snackNo]["snackName"];
    // // $_SESSION["snackPrice"][$snackNo]=$prodRow[$snackNo]["snackPrice"];
    // // $_SESSION["cusType"][$snackNo]="p"; //plan 預購
    // // $_SESSION["snackQuan"][$snackNo]=1; //雖然有但是應該在介面卡關，不給改
    // // $_SESSION["snackPic"][$snackNo]=$prodRow[$snackNo]["snackPic"];
    // // $_SESSION["planMonth"][$snackNo]=3/6/12; //月份
    // // $_SESSION["planCookie"][$snackNo]=數量; //餅乾
    // // $_SESSION["planChoco"][$snackNo]=數量; //巧克力
    // // $_SESSION["planCandy"][$snackNo]=數量; //糖果
    // // $_SESSION["planChip"][$snackNo]=數量; //洋芋片


    
    // $_SESSION["snackName"][14]=$prodRow[14]["snackName"];
    // $_SESSION["snackPrice"][14]=$prodRow[14]["snackPrice"];
    // $_SESSION["cusType"][14]="n";
    // $_SESSION["snackQuan"][14]=1;
    // $_SESSION["snackPic"][14]=$prodRow[14]["snackPic"];

    // $_SESSION["snackName"][25]=$prodRow[25]["snackName"];
    // $_SESSION["snackPrice"][25]=$prodRow[25]["snackPrice"];
    // $_SESSION["cusType"][25]="n";
    // $_SESSION["snackQuan"][25]=1;
    // $_SESSION["snackPic"][25]=$prodRow[25]["snackPic"];

    // $_SESSION["snackName"][24]=$prodRow[24]["snackName"];
    // $_SESSION["snackPrice"][24]=$prodRow[24]["snackPrice"];
    // $_SESSION["cusType"][24]="n";
    // $_SESSION["snackQuan"][24]=1;
    // $_SESSION["snackPic"][24]=$prodRow[24]["snackPic"];

    // $_SESSION["snackName"][23]=$prodRow[23]["snackName"];
    // $_SESSION["snackPrice"][23]=$prodRow[23]["snackPrice"];
    // $_SESSION["cusType"][23]="n";
    // $_SESSION["snackQuan"][23]=1;
    // $_SESSION["snackPic"][23]=$prodRow[23]["snackPic"];

    // $_SESSION["snackName"][15]=$prodRow[15]["snackName"];
    // $_SESSION["snackPrice"][15]=$prodRow[15]["snackPrice"];
    // $_SESSION["cusType"][15]="n";
    // $_SESSION["snackQuan"][15]=1;
    // $_SESSION["snackPic"][15]=$prodRow[15]["snackPic"];

    
?>