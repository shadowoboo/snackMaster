<!DOCTYPE html>
<html lang="zh_tw">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <script src="../js/common.js"></script>
    <!-- ------------------js-------------- -->
</head>

<body>

    <header>
        <h1>大零食家</h1>
        <div class="cloud">
            <div class="doc doc--bg2">
                <canvas id="canvas"></canvas>
            </div>
            <nav>
                <label for="smlSearch" class="searchBtn" value="search">
                    <img src="../images/tina/search-icon.svg" alt="" id="searchBtn">
                </label>

                <div class="menu">
                    <!-------- -----手機漢堡----------- -->

                    <div id="ham">
                        <span class="btnTop"></span>
                        <span class="btnMid"></span>
                        <span class="btnBot"></span>
                    </div>
                    <!----    在手機上打開此logo;桌機上關掉此logo------ -->
                    <div class="logo">
                        <a href="index.html"><img src="../images/tina/LOGO2.png" alt="大零食家"></a>

                    </div>
                    <div id="list_appear">
                        <!-- ----------手機選單離開-------- -->
                        <div id="cros">
                            <span class="leave">X</span>
                        </div>
                        <ul class="list">
                            <li><a href="rankBoard.html">零食排行榜</a></li>
                            <li><a href="customized.html">客製零食箱</a> </li>
                            <!-- 在手機上要關掉這個li的logo -->
                            <li><a href="index.html"><img src="../images/tina/LOGO1.png" alt="大零食家"></a></li>
                            <li id="store"> 零食商店街
                                <ul id="Submenu" class="subMenu">
                                    <li id="snBox"><a href="preOrder.html">預購零食箱</a></li>
                                    <li><a href="shopping.html">零食列表</a></li>
                                </ul>
                            </li>
                            <li><a href="gsell.html">尋找販賣機</a> </li>
                        </ul>
                    </div>
                </div>

                <ul class="login">
                    <li><i class="fas fa-shopping-cart" id="shopCart"></i></li>
                    <li><i class="fas fa-user-circle" id="memLogin"></i></li>
                </ul>
            </nav>
            <div class="seachRegion" id="search_appear">
                <div class="search">
                    <img src="../images/blair/pocky.png" alt="">
                    <div class="selectbar">
                        <select name="country" id="country">
                            <option value="0">國家</option>
                            <option value="巴西">巴西</option>
                            <option value="日本">日本</option>
                            <option value="美國">美國</option>
                            <option value="英國">英國</option>
                            <option value="埃及">埃及</option>
                            <option value="德國">德國</option>
                            <option value="澳洲">澳洲</option>
                            <option value="韓國">韓國</option>
                        </select>
                        <select name="kind" id="kind">
                            <option value="0">種類</option>
                            <option value="巧克力">巧克力</option>
                            <option value="糖果">糖果</option>
                            <option value="餅乾">餅乾</option>
                            <option value="洋芋片">洋芋片</option>
                        </select>
                        <select name="flavor" id="flavor">
                            <option value="0">口味</option>
                            <option value="sour">酸</option>
                            <option value="sweet">甜</option>
                            <option value="spicy">辣</option>
                        </select>
                    </div>
                    <div class="inputbar">
                        <input type="text" id="searchName" placeholder="想找什麼零食呢？">
                        <i class="fas fa-search" id="searchClick"></i>
                    </div>
                </div>
                <div id="close">
                    <span class="close"><i class="fas fa-times"></i></span>
                </div>
            </div>
        </div>
    </header>

    <section class="cartShow">
        <div class="wrap">
            <div class="cartTop">
                <div class="title">
                    <h2>購物掐</h2>
                </div>
                <!-- <div class="cartFlow">
                    <div class="cartStep cartStep_select">
                        <div class="step__img">
                            <img src="https://fakeimg.pl/100x100/ccc">
                        </div>
                        <p>step <span>1</span></p>
                    </div>
                    <div class="cartStep">
                        <div class="step__img">
                            <img src="https://fakeimg.pl/100x100/ccc">
                        </div>
                        <p>step <span>2</span></p>
                    </div>
                    <div class="cartStep">
                        <div class="step__img">
                            <img src="https://fakeimg.pl/100x100/ccc">
                        </div>
                        <p>step <span>3</span></p>
                    </div>
                </div> -->
            </div>

            <div class="cartContent cartContent_none cartPageActive">
                <h3>你的購物掐掐內煤油桑品捏</h3>
                <a href="shopping.html"><button class="subscribe">繼續選GO</button></a>
            </div>

            <div class="cartContent cartContent_prod">

                <div class="prodCards" id="prodCards">
                    <div class="prodCard prodCard_Group">
                        <div class="prodCard prodCard_normal prodCard_Cus prodCard_CusBox">
                            <div class="prodImg">
                                <!-- <img src="../images/blair/item3.png"> -->
                                <img src="https://picsum.photos/100/100/?random=1">
                            </div>
                            <div class="prodInfo">
                                <div class="prodName">
                                    <h4>客製零食箱</h4>
                                </div>
                                <!-- <div class="prodPrice">
                                <div class="priceOrigin"><span>$400</span></div>
                                <div class="priceNow"><span>$100</span></div>
                            </div> -->
                            </div>
                            <div class="cardCtrl">
                                <div class="prodPriceSum">
                                    <p>
                                        小計:<span>$150</span>
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
                                <img src="https://picsum.photos/100/100/?random=2">
                            </div>
                            <div class="prodInfo">
                                <div class="prodName">
                                    <h4>客製卡片</h4>
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
                                    <audio id="au_player"></audio>
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
                        <div class="prodCard prodCard_normal">
                            <div class="prodImg">
                                <img src="../images/blair/item3.png">
                            </div>
                            <div class="prodInfo">
                                <div class="prodName">
                                    <h4>[日本]Pure 草莓優格軟糖</h4>
                                </div>
                                <div class="prodPrice">
                                    <div class="priceOrigin"><span>$400</span></div>
                                    <div class="priceNow"><span>$100</span></div>
                                </div>
                            </div>
                            <div class="cardCtrl">
                                <div class="prodPriceSum">
                                    <p>
                                        小計:<span>$200</span>
                                    </p>
                                </div>
                                <div class="prodQty">
                                    <div class="numInput">
                                        <span class="numMinus">-</span><input type="number" value="1"><span
                                            class="numPlus">+</span>
                                    </div>
                                </div>
                                <button class="trash"><i class="far fa-trash-alt"></i></button>
                            </div>
                        </div>
                        <div class="prodCard prodCard_normal">
                            <div class="prodImg">
                                <img src="../images/blair/item3.png">
                            </div>
                            <div class="prodInfo">
                                <div class="prodName">
                                    <h4>[日本]Pure 草莓優格軟糖</h4>
                                </div>
                                <div class="prodPrice">
                                    <div class="priceOrigin"><span>$400</span></div>
                                    <div class="priceNow"><span>$100</span></div>
                                </div>
                            </div>
                            <div class="cardCtrl">
                                <div class="prodPriceSum">
                                    <p>
                                        小計:<span>$200</span>
                                    </p>
                                </div>
                                <div class="prodQty">
                                    <div class="numInput">
                                        <span class="numMinus">-</span><input type="number" value="1"><span
                                            class="numPlus">+</span>
                                    </div>
                                </div>
                                <button class="trash"><i class="far fa-trash-alt"></i></button>
                            </div>
                        </div>
                        <div class="prodCard prodCard_Cus prodCard_CusPanel">
                            <div class="cusTotal">
                                <p>
                                    共計: <span>$600</span>
                                </p>
                            </div>
                            <div class="cusBtnDel">
                                <span>刪除客製零食箱</span>
                            </div>
                        </div>
                    </div>

                    <div class="prodCard prodCard_normal">
                        <div class="prodImg">
                            <img src="../images/blair/nuts.png">
                        </div>
                        <div class="prodInfo">
                            <div class="prodName">
                                <h4>[美國]Tuty BBQ花生粒</h4>
                            </div>
                            <div class="prodPrice">
                                <div class="priceOrigin"><span>$400</span></div>
                                <div class="priceNow"><span>$100</span></div>
                            </div>
                        </div>
                        <div class="cardCtrl">
                            <div class="prodPriceSum">
                                <p>
                                    小計: <span>$200</span>
                                </p>
                            </div>
                            <div class="prodQty">
                                <div class="numInput">
                                    <span class="numMinus">-</span><input type="number" value="1"><span
                                        class="numPlus">+</span>
                                </div>
                            </div>
                            <button class="trash"><i class="far fa-trash-alt"></i></button>
                        </div>
                    </div>

                    <div class="prodCard prodCard_normal">
                        <div class="prodImg">
                            <img src="../images/blair/item.png">
                        </div>
                        <div class="prodInfo">
                            <div class="prodName">
                                <h4>[日本]摩巴頂級巧克力軟餅</h4>
                            </div>
                            <div class="prodPrice">
                                <div class="priceOrigin"><span>$400</span></div>
                                <div class="priceNow"><span>$100</span></div>
                            </div>
                        </div>
                        <div class="cardCtrl">
                            <div class="prodPriceSum">
                                <p>
                                    小計: <span>$200</span>
                                </p>
                            </div>
                            <div class="prodQty">
                                <div class="numInput">
                                    <span class="numMinus">-</span><input type="number" value="1"><span
                                        class="numPlus">+</span>
                                </div>
                            </div>
                            <button class="trash"><i class="far fa-trash-alt"></i></button>
                        </div>
                    </div>

                    <div class="prodCard prodCard_normal">
                        <div class="prodImg">
                            <img src="../images/blair/item3.png">
                        </div>
                        <div class="prodInfo">
                            <div class="prodName">
                                <h4>[日本]Pure 草莓優格軟糖</h4>
                            </div>
                            <div class="prodPrice">
                                <div class="priceOrigin"><span>$400</span></div>
                                <div class="priceNow"><span>$100</span></div>
                            </div>
                        </div>
                        <div class="cardCtrl">
                            <div class="prodPriceSum">
                                <p>
                                    小計:<span>$200</span>
                                </p>
                            </div>
                            <div class="prodQty">
                                <div class="numInput">
                                    <span class="numMinus">-</span><input type="number" value="1"><span
                                        class="numPlus">+</span>
                                </div>
                            </div>
                            <button class="trash"><i class="far fa-trash-alt"></i></button>
                        </div>
                    </div>

                    <div class="prodCard prodCard_normal">
                        <div class="prodImg">
                            <img src="../images/blair/item2.png">
                        </div>
                        <div class="prodInfo">
                            <div class="prodName">
                                <h4>[台灣]情人節義理巧克力</h4>
                            </div>
                            <div class="prodPrice">
                                <div class="priceOrigin"><span>$400</span></div>
                                <div class="priceNow"><span>$100</span></div>
                            </div>
                        </div>
                        <div class="cardCtrl">
                            <div class="prodPriceSum">
                                <p>
                                    小計: <span>$200</span>
                                </p>
                            </div>
                            <div class="prodQty">
                                <div class="numInput">
                                    <span class="numMinus">-</span><input type="number" value="1"><span
                                        class="numPlus">+</span>
                                </div>
                            </div>
                            <button class="trash"><i class="far fa-trash-alt"></i></button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="cartContent cartFormZone " id="cartFormZone">
                <form id="cartForm">
                    <label for="getterName" class="cartFormCard">
                        <h4>收件人姓名:</h4>
                        <input type="text" id="getterName" name="getterName">
                    </label>
                    <label for="getterPhone" class="cartFormCard">
                        <h4>收件人電話:</h4>
                        <input type="text" id="getterPhone" name="getterPhone">
                    </label>
                    <label for="getterAddr" class="cartFormCard">
                        <h4>收件人地址:</h4>
                        <input type="text" id="getterAddr" name="getterAddr">
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
                            合計: <span>$600</span>
                        </p>
                    </div>
                    <div class="couponChoose">
                        <label for="couponItem">
                            <p>優惠劵: </p>
                            <form action="" method="post" id="couponList">
                                <select name="couponItem" id="couponItem">
                                    <option value="300">300</option>
                                    <option value="50">500</option>
                                    <option value="100">100</option>
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
        <div class="engBtn"></div>
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



    
    <script src="../js/cartShow.js"></script>
</body>

</html>