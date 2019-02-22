<?php
    ob_start();
    session_start();

    $errMsg = "";
    try {
        require_once("connectcd105g2.php");
        $sql = "select * from snack where boxDate = 20190101";
        $snacks = $pdo->query($sql); 
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>大零食家 - 預購商品頁</title>
    <link rel="stylesheet" href="../css/preOrder.css">
    <link rel="stylesheet" href="../css/nnnnn.css">
    <!-- <link rel="stylesheet" href="../css/header.css"> -->
    <?php
        require_once('header.php');
    ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
        crossorigin="anonymous">
    <script src="../js/preOrder.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/showStar.js"></script>
</head>
<body>
    <div class="preOrder">
        <div class="wrap">
            <div class="title">
                <h2>預購零食箱</h2>
            </div>
            <div class="steps">
                <div class="lineContainer" id="lineContainer1">
                    <img src="../images/blair/line.png" alt="">
                </div>
                <div class="lineContainer" id="lineContainer2">
                    <img src="../images/blair/line.png" alt="">
                </div>
                <div class="clearfix"></div>
                <div class="orderStep">
                    <img src="../images/blair/step1.png" alt="">
                    <img id="step1_2" src="../images/blair/step1_2.png" alt="">
                    <img id="step1_3" src="../images/blair/step1_3.png" alt="">
                    <img id="step1_4" src="../images/blair/step1_4.png" alt="">
                    <h3>Step <span>1</span> </h3>
                    <h4>選擇預購幾個月的方案</h4>
                </div>
                <div class="orderStep">
                    <img src="../images/blair/step2.png" alt="">
                    <img id="step2_2" src="../images/blair/step2_2.png" alt="">
                    <img id="step2_3" src="../images/blair/step2_3.png" alt="">
                    <h3>Step <span>2</span> </h3>
                    <h4>選擇喜歡的零食種類數量</h4>
                </div>
                <div class="orderStep">
                    <img src="../images/blair/step3.png" alt="">
                    <img id="step3_2" src="../images/blair/step3_2.png" alt="">
                    <img id="step3_3" src="../images/blair/step3_3.png" alt="">
                    <h3>Step <span>3</span> </h3>
                    <h4>盡情享受最新的異國零食！</h4>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="orderCards">
                <div class="orderCard" id="orderCard1">
                    <img src="../images/blair/card1.png" alt="">
                    <h4>預購零食箱</h4>
                    <p>每月得到6種不同的零食，比別人搶先一步體驗世界零食，收到超驚喜！</p>
                    <button class="step" id="buy1">立即預購</button>
                </div>
                <div class="orderCard" id="orderCard2">
                    <i id="card2_back" class="fas fa-arrow-left"></i>
                    <h4>一次預購，多箱享受！</h4>
                    <p>預購零食箱每月扣款，享受零食無負擔</p>
                    <div class="monthBox">
                        <div class="boxImgs">
                            <div class="boxImg boxImg1">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                            <div class="boxImg boxImg2">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                            <div class="boxImg boxImg3">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                        </div>
                        <h4>3個月</h4>
                        <p>共$900</p>
                    </div>
                    <div class="monthBox">
                        <div class="boxImgs">
                            <div class="boxImg boxImg1">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                            <div class="boxImg boxImg2">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                            <div class="boxImg boxImg3">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                        </div>
                        <div class="boxImgs boxImgs2">
                            <div class="boxImg boxImg1">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                            <div class="boxImg boxImg2">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                            <div class="boxImg boxImg3">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                        </div>
                        <h4>6個月</h4>
                        <p>共$1800</p>
                    </div>
                    <div class="monthBox">
                        <div class="boxImgs">
                            <div class="boxImg boxImg1">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                            <div class="boxImg boxImg2">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                            <div class="boxImg boxImg3">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                        </div>
                        <div class="boxImgs boxImgs2">
                            <div class="boxImg boxImg1">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                            <div class="boxImg boxImg2">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                            <div class="boxImg boxImg3">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                        </div>
                        <div class="boxImgs boxImgs3">
                            <div class="boxImg boxImg1">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                            <div class="boxImg boxImg2">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                            <div class="boxImg boxImg3">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                        </div>
                        <div class="boxImgs boxImgs4">
                            <div class="boxImg boxImg1">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                            <div class="boxImg boxImg2">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                            <div class="boxImg boxImg3">
                                <img src="../images/blair/box.png" alt="">
                            </div>
                        </div>
                        <h4>12個月</h4>
                        <p>共$3600</p>
                    </div>
                    <div class="clearfix"></div>
                    <button class="step" id="buy2">立即預購</button>
                </div>
                <div class="orderCard" id="orderCard3">
                    <i id="card3_back" class="fas fa-arrow-left"></i>
                    <h4>選擇屬於你的預購零食箱</h4>
                    <div id="card3_1">
                        <div class="card3_img">
                            <img src="../images/blair/card3.png" alt="">
                            <img id="box_bottom" src="../images/blair/card3_2.png" alt="">
                            <div class="card3_box"><div class="boxChild1"><img src="../images/blair/chocolate.png" alt=""></div><div class="boxChild2"><img src="../images/blair/cookie.png" alt=""></div><div class="boxChild3"><img src="../images/blair/candy.png" alt=""></div><div class="boxChild4"><img src="../images/blair/candy.png" alt=""></div><div class="boxChild5"><img src="../images/blair/chips.png" alt=""></div><div class="boxChild6"><img src="../images/blair/chocolate.png" alt=""></div></div>
                        </div>
                    </div>
                    <div id="card3_2">
                        <h4 id="h4_1">1. 選擇預購方案月份數</h4>
                        <form>
                            <label for="month_3">
                                <input type="radio" id="month_3" name="months">
                                <span>3個月/共$900</span>
                            </label>
                            <label for="month_6">
                                <input type="radio" id="month_6" name="months">
                                <span>6個月/共$1800</span>
                            </label>
                            <label for="month_12">
                                <input type="radio" id="month_12" name="months" checked>
                                <span>12個月/共$3600</span>
                            </label>
                        </form>
                        <h4 id="h4_2">2. 選擇想要的零食種類</h4>
                        <span>預購零食箱總共會有六款最新的異國零食，可以調整你想要收到的零食種類喔！
                        </span>
                        <div class="snackPanels">
                            <div class="panel">
                                <p>洋芋片</p>
                                <div class="grow"></div>
                                <div class="numInput">
                                    <span class="numMinus">-</span><input id="chips" type="number" value="1"><span class="numPlus">+</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel">
                                <p>糖果</p>
                                <div class="grow"></div>
                                <div class="numInput">
                                    <span class="numMinus">-</span><input id="candy" type="number" value="2"><span class="numPlus">+</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="panel">
                                <p>餅乾</p>
                                <div class="grow"></div>
                                <div class="numInput">
                                    <span class="numMinus">-</span><input id="cookie" type="number" value="1"><span class="numPlus">+</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel">
                                <p>巧克力</p>
                                <div class="grow"></div>
                                <div class="numInput">
                                    <span class="numMinus">-</span><input id="chocolate" type="number" value="2"><span class="numPlus">+</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>                    
                    <button class="cart">加入購物車</button>
                </div>
            </div>
        </div>
        <div class="wrap">
            <div class="title">
                <h2>過去零食箱</h2>
            </div>
            <div class="cards">
                <button class="month" style="color:#737374;background-color:#fbc84a;">2019<br>1月期</button>
                <button class="month">2019<br>2月期</button>
                <button class="month">2019<br>3月期</button>
                <div class="clearfix"></div>
                <div class="snackCard">
                    <div class="carousels">
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }	
	for($i = 1; $i < 7; $i++){
        $snackRow = $snacks -> fetch();
        $sql = "SELECT e.evaCtx, e.memNo, e.snackNo, e.goodStar, m.memPic FROM eva e join member m on e.memNo = m.memNo where snackNo = :snackNo order by goodStar DESC limit 1";
        $eva = $pdo -> prepare($sql);
        $eva -> bindValue(":snackNo", $snackRow['snackNo']);
        $eva -> execute();
        $evaRow  = $eva -> fetch();
?>
                        <div class="carousel item<?php echo $i?>">
                            <div class="cardImg">
                                <img src="<?php echo $snackRow['snackPic']?>" alt="snack">
                            </div>
                            <h4><?php echo '['.$snackRow['nation'].']'.$snackRow['snackName']?></h4>
                            <div class="review">
                                <div class="profile">
                                    <img src="<?php echo $evaRow['memPic'] ?>" alt="profile">
                                </div>
                                <div class="reviewLeft">
                                    <div class="star" grad="<?php 
                                            $good = round($snackRow['goodStars'] / $snackRow['goodTimes'], 1);
                                            echo $good;
                                        ?>">
                                        <img src="../images/rankBoard/starMask.png" alt="星等">
                                    </div>
                                    <p class="reviewWord">
                                        <?php echo $evaRow['evaCtx']?>
                                    </p>
                                </div>
                            </div>
                        </div>
<?php
	}
?>
                    </div>
                </div>
                <div class="arrow">
                    <i id="angle_left" class="fas fa-angle-left"></i>
                    <i id="angle_right" class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>
        <img id="bgChips" src="../images/blair/bgChips.png" alt="">
        <img src="../images/blair/5-1.png" alt="" id="bgChips1">
        <img src="../images/blair/5-2.png" alt="" id="bgChips2">
        <img src="../images/blair/5-3.png" alt="" id="bgChips3">
        <img src="../images/blair/5-4.png" alt="" id="bgChips4">
        <img src="../images/blair/5-5.png" alt="" id="bgChips5">
        <img src="../images/blair/5-6.png" alt="" id="bgChips6">
        <img src="../images/blair/5-1.png" alt="" id="bgChips7">
        <img src="../images/blair/5-2.png" alt="" id="bgChips8">
        <img src="../images/blair/5-3.png" alt="" id="bgChips9">
        <img src="../images/blair/5-4.png" alt="" id="bgChips10">
        <img src="../images/blair/bgChips2.png" alt="" id="bgChips_2">
        <img src="../images/blair/5-1.png" alt="" id="bgChips11">
        <img src="../images/blair/5-2.png" alt="" id="bgChips12">
        <img src="../images/blair/5-3.png" alt="" id="bgChips13">
        <img src="../images/blair/5-4.png" alt="" id="bgChips14">
        <img src="../images/blair/5-5.png" alt="" id="bgChips15">
        <img src="../images/blair/5-6.png" alt="" id="bgChips16">
        <img src="../images/blair/5-1.png" alt="" id="bgChips17">
        <img src="../images/blair/5-2.png" alt="" id="bgChips18">
        <img src="../images/blair/5-3.png" alt="" id="bgChips19">
        <img src="../images/blair/5-4.png" alt="" id="bgChips20">
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
    
    <script src="../js/header.js"></script>
</body>
</html>