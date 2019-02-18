<?php
    session_start();

    //撈出所有商品資料
    require_once("connectcd105g2.php");
    $sql = "select * from snack "; //''
	//$sql = "select * from member where memId='Sara' and memPsw='' or '1'";
	$prod = $pdo->prepare( $sql ); //先編譯好
    $prod->execute();//執行之
    $prodRow = $prod->fetchAll(PDO::FETCH_ASSOC);

    //會員登入模擬
    $_SESSION["memId"]=1;
    // echo "memId: ".$_SESSION["memId"]." already loggin";

    //購物清單模擬
    // $_SESSION["snackNo"][0]=1;
    // echo "Done write ".'$_SESSION["snackNo"]'."=".$_SESSION["snackNo"];

    ////客製箱模擬
    //箱子利用複寫，不給重複添加
    $_SESSION["cusBox"]="../images/customized/ip5.png"; //預計截圖之後產生檔案
    $_SESSION["cusCard"]="../images/customized/card.png"; //預計截圖之後產生檔案
    $_SESSION["cusSound"]="../codeTesting/Mozart1.mp3"; //預計錄音產生檔案
    $_SESSION["snackName"][49]=$prodRow[49]["snackName"];
    $_SESSION["snackPrice"][49]=$prodRow[49]["snackPrice"];
    $_SESSION["cusType"][49]="y";
    $_SESSION["snackQty"][49]=1;
    // $_SESSION["snackPic"][49]=$prodRow[49]["snackPic"];
    //跟客製有關聯的商品
    $_SESSION["snackName"][0]=$prodRow[0]["snackName"];
    $_SESSION["snackPrice"][0]=$prodRow[0]["snackPrice"];
    $_SESSION["cusType"][0]="y";
    $_SESSION["snackQty"][0]=1;
    $_SESSION["snackPic"][0]=$prodRow[0]["snackPic"];

    $_SESSION["snackName"][1]=$prodRow[1]["snackName"];
    $_SESSION["snackPrice"][1]=$prodRow[1]["snackPrice"];
    $_SESSION["cusType"][1]="y";
    $_SESSION["snackQty"][1]=1;
    $_SESSION["snackPic"][1]=$prodRow[1]["snackPic"];
    $_SESSION["snackName"][2]=$prodRow[2]["snackName"];
    $_SESSION["snackPrice"][2]=$prodRow[2]["snackPrice"];
    $_SESSION["cusType"][2]="y";
    $_SESSION["snackQty"][2]=1;
    $_SESSION["snackPic"][2]=$prodRow[2]["snackPic"];
    $_SESSION["snackName"][3]=$prodRow[3]["snackName"];
    $_SESSION["snackPrice"][3]=$prodRow[3]["snackPrice"];
    $_SESSION["cusType"][3]="y";
    $_SESSION["snackQty"][3]=1;
    $_SESSION["snackPic"][3]=$prodRow[3]["snackPic"];
    $_SESSION["snackName"][4]=$prodRow[4]["snackName"];
    $_SESSION["snackPrice"][4]=$prodRow[4]["snackPrice"];
    $_SESSION["cusType"][4]="y";
    $_SESSION["snackQty"][4]=1;
    $_SESSION["snackPic"][4]=$prodRow[4]["snackPic"];


    //單品
    $_SESSION["snackName"][13]=$prodRow[13]["snackName"];
    $_SESSION["snackPrice"][13]=$prodRow[13]["snackPrice"];
    $_SESSION["cusType"][13]="n";
    $_SESSION["snackQty"][13]=1;
    $_SESSION["snackPic"][13]=$prodRow[13]["snackPic"];
    
    $_SESSION["snackName"][14]=$prodRow[14]["snackName"];
    $_SESSION["snackPrice"][14]=$prodRow[14]["snackPrice"];
    $_SESSION["cusType"][14]="n";
    $_SESSION["snackQty"][14]=1;
    $_SESSION["snackPic"][14]=$prodRow[14]["snackPic"];

    $_SESSION["snackName"][25]=$prodRow[25]["snackName"];
    $_SESSION["snackPrice"][25]=$prodRow[25]["snackPrice"];
    $_SESSION["cusType"][25]="n";
    $_SESSION["snackQty"][25]=1;
    $_SESSION["snackPic"][25]=$prodRow[25]["snackPic"];

    $_SESSION["snackName"][24]=$prodRow[24]["snackName"];
    $_SESSION["snackPrice"][24]=$prodRow[24]["snackPrice"];
    $_SESSION["cusType"][24]="n";
    $_SESSION["snackQty"][24]=1;
    $_SESSION["snackPic"][24]=$prodRow[24]["snackPic"];

    $_SESSION["snackName"][23]=$prodRow[23]["snackName"];
    $_SESSION["snackPrice"][23]=$prodRow[23]["snackPrice"];
    $_SESSION["cusType"][23]="n";
    $_SESSION["snackQty"][23]=1;
    $_SESSION["snackPic"][23]=$prodRow[23]["snackPic"];

    $_SESSION["snackName"][15]=$prodRow[15]["snackName"];
    $_SESSION["snackPrice"][15]=$prodRow[15]["snackPrice"];
    $_SESSION["cusType"][15]="n";
    $_SESSION["snackQty"][15]=1;
    $_SESSION["snackPic"][15]=$prodRow[15]["snackPic"];

    
?>