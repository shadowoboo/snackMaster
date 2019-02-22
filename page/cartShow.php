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

    //檢查是否登入
    // require("CartStepLoginCheck.php");

    //ENG 工程用檔案
    // require("CartProdAdd_ENG.php");

    // //檢查有沒有商品在session
    // if(isset($_SESSION["snackNo"])){
    //     //檢查商品種類

    //     //如果有客製箱
    //     if(in_array("y",$_SESSION["cusType"])){
    //         //產生客製箱表格
            
    //     }
    //     if{//若不是客製箱
    //         //若是預購箱
    //         // if()

    //         //其餘單品

    //     }

    // }
?>



<!DOCTYPE html>
<html lang="zh_tw">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- 工程用清除快取!!!! -->
    <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
    <META HTTP-EQUIV="EXPIRES" CONTENT="0">
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <!-- 工程用清除快取!!!! -->


    <title>大零食家 > 購物車</title>
    <!-- ------------------css---------------- -->
    <!-- for cartShow   -->
    <link rel="stylesheet" href="../css/cartShow.css">
    <!-- for header -->
    <link rel="stylesheet" href="../css/header.css">
    <!-- for footer -->
    <link rel="stylesheet" href="../css/nnnnn.css">
    <!-- for cartShow ENG 放在CSS最後面做修正-->
    <link rel="stylesheet" href="../css/cartShowENG.css">
    <!-- ------------------css---------------- -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


    <!-- ------------------js------------ -->
    <!-- for header -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <!-- for header -->
    <script src="../js/header.js" defer></script>
    <!-- for common -->
    <script src="../js/common.js" defer></script>
    <!-- for shadowLib -->
    <script src="../js/shadowLib.js"></script>
    <!-- ------------------js-------------- -->
</head>

<body>


    <?php
        require_once("header.php");
    ?>

    <section class="cartShow">
        <div class="wrap">
            <div class="cartTop">
                <div class="title">
                    <h2>購物掐</h2>
                </div>
            </div>
            <div class="cartTh">
                <h4>商品</h4>
                <h4>品名</h4>
                <h4>價格</h4>
            </div>

            <div class="cartContent cartContent_none cartPageActive">
                <h4>購物車暫無商品！</h4>
                <a href="shopping.html"><button class="subscribe">繼續選GO</button></a>
            </div>
<?php
//檢查有沒有商品在session
if(isset($_SESSION["snackName"])){
?>
            <div class="cartContent cartContent_prod">
                <div class="prodCards" id="prodCards">
<?php
    //如果有客製箱
    if(isset($_SESSION["snackName"][1])){
?>

                    <div class="prodCard prodCard_Group">
                        <div class="prodCard prodCard_normal prodCard_Cus prodCard_CusBox">
                            <div class="prodImg">
                                <!-- <img src="../images/blair/item3.png"> -->
                                <img src="<?php echo $_SESSION["cusBox"] ?>" id="boxPic">
                            </div>
                            <div class="prodInfo">
                                <div class="prodName">
                                    <h5><?php echo $_SESSION["snackName"][1][50] ?></h5>
                                </div>
                                <!-- <div class="prodPrice">
                                <div class="priceOrigin"><span>$400</span></div>
                                <div class="priceNow"><span>$100</span></div>
                            </div> -->
                            </div>
                            <div class="cardCtrl">
                                <div class="prodPriceSum">
                                    <p>
                                        小計: <span class="priceSum"><?php echo $_SESSION["snackPrice"][1][50] ?></span>
                                    </p>
                                </div>
                                <!-- <div class="prodQty">
                                <div class="numInput">
                                    <span class="numMinus">-</span><input type="number" value="1"><span class="numPlus">+</span>
                                </div>
                            </div>
                            <button class="trash"><i class="far fa-trash-alt"></i></button> -->
                            </div>
                        </div>
                        <div class="prodCard prodCard_normal prodCard_Cus prodCard_CusCard">
                            <div class="prodImg">
                                <!-- <img src="../images/blair/item3.png"> -->
                                <img src="<?php echo $_SESSION["cusCard"]; ?>" id="cardPic">
                            </div>
                            <div class="prodInfo">
                                <div class="prodName">
                                    <h5>客製卡片</h5>
                                </div>
                                <!-- <div class="prodPrice">
                                <div class="priceOrigin"><span>$400</span></div>
                                <div class="priceNow"><span>$100</span></div>
                            </div> -->
                            </div>
                            <div class="cardCtrl">
                                <!-- 撥放介面實體 -->
                                <div id="audioItem">
                                    <!-- 一開始不給src，待錄音有值會自動增加 -->
                                    <audio id="au_player" src="<?php echo $_SESSION["cusSound"]; ?>"></audio>
                                    <!-- 撥放控制按鈕們 -->
                                    <div class="au_btns" id="au_btns">
                                        <!-- 撥放與暫停 -->
                                        <button class="au_btn" id="au_btn_play"><i class="fas fa-play"></i></button>
                                        <!-- 停止 -->
                                        <button class="au_btn" id="au_btn_stop"><i class="fas fa-stop"></i></button>
                                        <!-- 靜音與否 -->
                                        <button class="au_btn" id="au_btn_vol"><i class="fas fa-volume-up"></i></button>
                                        <!-- 音量bar -->
                                        <div class="volBar" id="volBar">
                                            <!-- 會伸縮的bar -->
                                            <div class="vol_proBar" id="vol_proBar"></div>
                                            <!-- 拉桿 -->
                                            <div class="vol_barNote" id="vol_barNote"></div>
                                        </div>
                                        <!-- 刪除 -->
                                        <!-- <button id="audioDel" class="au_btn trash"><i class="far fa-trash-alt"></i></button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
<?php
        //客製商品
        foreach ($_SESSION["snackName"][1] as $snackNo => $snackName) {
            if($snackNo!=50){ //箱子本身不要放在商品卡片迴圈
?>             
                        <div class="prodCard prodCard_normal">
                            <input id="<?php echo $snackNo;?>" type="hidden" name="snackNo" value="<?php echo $snackNo;?>">
                            <div class="prodImg">
                                <img src="<?php echo $_SESSION["snackPic"][1][$snackNo]; ?>">
                            </div>
                            <div class="prodInfo">
                                <div class="prodName">
                                    <h5><?php echo $_SESSION["snackName"][1][$snackNo]; ?></h5>
                                </div>
                                <div class="prodPrice">
                                    <div class="priceOrigin"><span><?php echo $_SESSION["snackPrice"][1][$snackNo]; ?></span></div>
                                    <div class="priceNow"><span><?php echo $_SESSION["snackPrice"][1][$snackNo]; ?></span></div>
                                </div>
                            </div>
                            <div class="cardCtrl">
                                <div class="prodPriceSum">
                                    <p>
                                        小計: <span class="priceSum"><?php echo  $_SESSION["snackPrice"][1][$snackNo]?></span>
                                    </p>
                                </div>
                                <div class="prodQty">
                                    <div class="numInput">
                                        <span class="numMinus" data-snackno="<?php echo $snackNo;?>" data-snackprice="<?php echo  $_SESSION["snackPrice"][1][$snackNo]?>">-</span><input class="snackQty" type="number" value="1" readonly><span
                                            class="numPlus" data-snackno="<?php echo $snackNo;?>" data-snackprice="<?php echo  $_SESSION["snackPrice"][1][$snackNo]?>">+</span>
                                    </div>
                                </div>
                                <!-- <button class="trash"><i class="far fa-trash-alt"></i></button> -->
                            </div>
                        </div>
                        
            
<?php            
            }
        }
?>
                        

                        <div class="prodCard prodCard_Cus prodCard_CusPanel">
                            <div class="cusTotal">
                                <p>
                                    共計: <span id="cusTotalContent">$0</span>
                                </p>
                            </div>
                            <div class="cusBtnDel">
                                <span>刪除客製零食箱</span>
                            </div>
                        </div>
                    </div>
<?php
    
    }
?>


<?php
    //如果是預購商品
    if(isset($_SESSION["snackName"][3])){
    //即期品喔即期品
        foreach ($_SESSION["snackName"][3] as $snackNo => $snackName) {
            // if($cusType=="n" || $cusType=="c" ){
?>
                    <div class="prodCard prodCard_normal prodCard_single">
                        <input type="hidden" name="snackNo" value="<?php echo $snackNo;?>">
                        <div class="prodImg">
                            <img src="<?php echo  $_SESSION["snackPic"][3][$snackNo]?>">
                        </div>
                        <div class="prodInfo">
                            <div class="prodName">
                                <h5><?php echo  $_SESSION["snackName"][3][$snackNo]?></h5>
                            </div>
                            <div class="prodPrice">
                                <div class="priceOrigin"><span><?php echo  $_SESSION["snackPrice"][3][$snackNo]?></span></div>
                                <div class="priceNow"><span><?php echo  $_SESSION["snackPrice"][3][$snackNo]?></span></div>
                            </div>
                            <div class="prodNote">
                                <p>
                                    <?php echo  $_SESSION["note"][3][$snackNo]?>
                                </p>
                            </div>
                        </div>
                        <div class="cardCtrl">
                            <div class="prodPriceSum">
                                <p>
                                    小計: <span class="priceSum" ><?php echo  $_SESSION["snackPrice"][3][$snackNo]?></span>
                                </p>
                            </div>
                            <div class="prodQty">
                                <div class="numInput">
                                    <span class="numMinus" data-snackno="<?php echo $snackNo;?>" data-snackprice="<?php echo  $_SESSION["snackPrice"][3][$snackNo]?>">-</span><input class="snackQty" data-snackno="<?php echo $snackNo;?>" type="number" value="1" readonly><span
                                        class="numPlus" data-snackno="<?php echo $snackNo;?>" data-snackprice="<?php echo  $_SESSION["snackPrice"][3][$snackNo]?>">+</span>
                                </div>
                            </div>
                            <button class="trash" data-snackno="<?php echo $snackNo;?>"><i class="far fa-trash-alt" data-snackno="<?php echo $snackNo;?>"></i></button>
                        </div>
                    </div>
<?php
            // }
        }       
    }
?>


<?php
    //如果是一般商品
    if(isset($_SESSION["snackName"][0])){
    //單品。非客製(且非預購?)
        foreach ($_SESSION["snackName"][0] as $snackNo => $snackName) {
            // if($cusType=="n" || $cusType=="c" ){
?>
                    <div class="prodCard prodCard_normal prodCard_single">
                        <input type="hidden" name="snackNo" value="<?php echo $snackNo;?>">
                        <div class="prodImg">
                            <img src="<?php echo  $_SESSION["snackPic"][0][$snackNo]?>">
                        </div>
                        <div class="prodInfo">
                            <div class="prodName">
                                <h5><?php echo  $_SESSION["snackName"][0][$snackNo]?></h5>
                            </div>
                            <div class="prodPrice">
                                <div class="priceOrigin"><span><?php echo  $_SESSION["snackPrice"][0][$snackNo]?></span></div>
                                <div class="priceNow"><span><?php echo  $_SESSION["snackPrice"][0][$snackNo]?></span></div>
                            </div>
                        </div>
                        <div class="cardCtrl">
                            <div class="prodPriceSum">
                                <p>
                                    小計: <span class="priceSum" ><?php echo  $_SESSION["snackPrice"][0][$snackNo]?></span>
                                </p>
                            </div>
                            <div class="prodQty">
                                <div class="numInput">
                                    <span class="numMinus" data-snackno="<?php echo $snackNo;?>" data-snackprice="<?php echo  $_SESSION["snackPrice"][0][$snackNo]?>">-</span><input class="snackQty" data-snackno="<?php echo $snackNo;?>" type="number" value="1" readonly><span
                                        class="numPlus" data-snackno="<?php echo $snackNo;?>" data-snackprice="<?php echo  $_SESSION["snackPrice"][0][$snackNo]?>">+</span>
                                </div>
                            </div>
                            <button class="trash" data-snackno="<?php echo $snackNo;?>"><i class="far fa-trash-alt" data-snackno="<?php echo $snackNo;?>"></i></button>
                        </div>
                    </div>
<?php
            // }
        }       
    }
?>

<?php
    //如果是即期商品
    if(isset($_SESSION["snackName"][2])){
    //即期品喔即期品
        foreach ($_SESSION["snackName"][2] as $snackNo => $snackName) {
            $str=$_SESSION["note"][2][$snackNo];
            $arr_str=explode("|",$str);
            //分割出字串
            $priceOrigin=$arr_str[0];
?>
                    <div class="prodCard prodCard_normal prodCard_single">
                        <input type="hidden" name="snackNo" value="<?php echo $snackNo;?>">
                        <div class="prodImg">
                            <img src="<?php echo  $_SESSION["snackPic"][2][$snackNo]?>">
                        </div>
                        <div class="prodInfo">
                            <div class="prodName">
                                <h5><?php echo  $_SESSION["snackName"][2][$snackNo]?></h5>
                            </div>
                            <div class="prodPrice">
                                <div class="priceOrigin"><span><?php echo  $priceOrigin?></span></div>
                                <div class="priceNow"><span><?php echo  $_SESSION["snackPrice"][2][$snackNo]?></span></div>
                            </div>
                        </div>
                        <div class="cardCtrl">
                            <div class="prodPriceSum">
                                <p>
                                    小計: <span class="priceSum" ><?php echo  $_SESSION["snackPrice"][2][$snackNo]?></span>
                                </p>
                            </div>
                            <div class="prodQty">
                                <div class="numInput">
                                    <span class="numMinus" data-snackno="<?php echo $snackNo;?>" data-snackprice="<?php echo  $_SESSION["snackPrice"][2][$snackNo]?>">-</span><input class="snackQty" data-snackno="<?php echo $snackNo;?>" type="number" value="1" readonly><span
                                        class="numPlus" data-snackno="<?php echo $snackNo;?>" data-snackprice="<?php echo  $_SESSION["snackPrice"][2][$snackNo]?>">+</span>
                                </div>
                            </div>
                            <button class="trash" data-snackno="<?php echo $snackNo;?>"><i class="far fa-trash-alt" data-snackno="<?php echo $snackNo;?>"></i></button>
                        </div>
                    </div>
<?php
        }       
    }
?>

        </div>
    </div>
<?php
}
?>

                        

<?php /////////////////////////// ?>




            <div class="cartContent cartFormZone " id="cartFormZone">
                <form id="cartForm">
                    <label for="getterName" class="cartFormCard">
                        <h4>收件人姓名:</h4>
                        <input type="text" id="getterName" name="getterName" maxlength="10">
                    </label>
                    <label for="getterPhone" class="cartFormCard">
                        <h4>收件人電話:</h4>
                        <input type="text" id="getterPhone" name="getterPhone" maxlength="10">
                    </label>
                    <label for="getterAddr" class="cartFormCard">
                        <h4>收件人地址:</h4>
                        <input type="text" id="getterAddr" name="getterAddr" >
                    </label>
                    <label class="cartFormCard">
                        <h4>付款方式:</h4>
                        <div class="payType">
                            <label for="payCard" class="payTypeItem checked"><input id="payCard" type="radio"
                                    name="getterPayType" value="信用卡" checked="true">
                                <p>信用卡</p>
                            </label>
                            <label for="payArrived" class="payTypeItem"><input id="payArrived" type="radio"
                                    name="getterPayType" value="貨到付款">
                                <p>貨到付款</p>
                            </label>
                        </div>
                    </label>
                </form>
            </div>

            <div class="cartContent cartFinishOrder ">
                <h3>您已經成功下單!!</h3>
                <a href="shopping.html"><button class="subscribe">繼續選GO</button></a>
            </div>

            <div class="cartPanel">
                <div class="totalAndCoupon">
                    <div class="priceTotal">
                        <p>
                            合計: $<span id="priceTotalContent">600</span>
                        </p>
                    </div>
                    <div class="couponChoose">
                        <label for="couponItem">
                            <p>優惠劵: </p>
                            <form action="" method="post" id="couponList">
                                <select name="couponItem" id="couponItem">
                                    <!-- <option value="300">300</option>
                                    <option value="50">500</option>
                                    <option value="100">100</option> -->
                                </select>
                            </form>
                        </label>
                    </div>
                </div>
                <div class="panelBtn">
                    <div class="btnBack btnBack_none"><span>上一步</span></div>
                    <div class="btnNext"><span>下一步</span></div>
                </div>
            </div>
        </div>
        <div class="lightBoxes" id="lightBoxes">
            <div class="lightBox lightBox_cusAlarm">
                <div class="lightBoxContent">
                    <h3>寄件提醒</h3>
                    <p>
                        感謝您選購<span>客製零食箱</span>，<br>
                        以上商品將寄送至<span>同一位收件人。</span><br>
                        如有分送需求，請分別下單，謝謝您的支持! <br>
                    </p>
                </div>
                <div class="lightBoxBtns">
                    <button class="step stepBack">取消</button>
                    <button class="step stepNext">繼續結帳</button>
                </div>
            </div>
        </div>
    </section>

    <div class="engBtnList">
        <div class="engBtn">prodCard_Group</div>
        <div class="engBtn">prodCard_normal</div>
        <div class="engBtn">prodCards</div>
        <div class="engBtn">cartContent_none</div>
        <div class="engBtn clearSession" id="clearSession">清除所有 php session</div>
    </div>

    <footer>
        <div class="footer_ip">
            <div class="ip_size">
                <img src="../images/nnnnn/ipc.png" alt="ipPicture" class="floating">
            </div>
            <div class="ip_size">
                <img src="../images/nnnnn/ipcho.png" alt="ipPicture" class="floatingReverse">
            </div>
            <div class="ip_size">
                <img src="../images/nnnnn/ipf.png" alt="ipPicture" class="floating">
            </div>
            <div class="ip_size">
                <img src="../images/nnnnn/ipcandy.png" alt="ipPicture" class="floatingReverse">
            </div>
            <div class="ip_size">
                <img src="../images/nnnnn/ipcho.png" alt="ipPicture" class="floating">
            </div>
            <div class="ip_size ip_hi">
                <img src="../images/nnnnn/ipf.png" alt="ipPicture" class="floatingReverse">
            </div>

        </div>
        <div class="floor">
            <img src="../images/nnnnn/floor.png" alt="floor">
            <p id="copy">Copyright©2019 Snack Master</p>
        </div>
    </footer>



    <script src="../js/search.js"></script>
    <script src="../js/cartShow.js"></script>
</body>

</html>