<?php

// $snackNo = $_GET["snackNo"];
    $errMsg = "";
    try {
        // require_once("blairConnect.php");
        require_once("connectcd105g2.php");
        if(isset($_GET["snackNo"]) == false){
            $snackNo=25;
        }else{
            $snackNo=$_GET["snackNo"];
        }
        $sql = "SELECT * FROM snack WHERE snackNo={$snackNo}";
        $feed=$pdo->query($sql);
        $snackRow=$feed->fetch();

        $sql ="SELECT 
                COUNT(snackNo) as Etimes,
                AVG(goodStar) as avgG,
                AVG(sourStar) as avgS,
                AVG(sweetStar) as avgT,
                AVG(spicyStar) as avgH  
                FROM `eva` WHERE `snackNo`={$snackNo}";
        $feed=$pdo->query($sql);
        $evaRow=$feed->fetch();
        $Etimes =$evaRow['Etimes'];
        $avgG =number_format($evaRow['avgG'],1);
        $avgS =number_format($evaRow['avgS'],1);
        $avgT =number_format($evaRow['avgT'],1);
        $avgH =number_format($evaRow['avgH'],1);

        // $sql =`SELECT * FROM rank WHERE snackNo={$snackNo}`;
        $sql="SELECT * FROM `rank` WHERE `snackNo`={$snackNo}";
        $Rankfeed=$pdo->query($sql);
        

    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg ;
        exit();
    }
?>




<!DOCTYPE html>
<html lang="zh_tw">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>大零食家 -<?php echo '['.$snackRow['nation'].']'.$snackRow['snackName']?></title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../css/showItem.css">
    <link rel="stylesheet" href="../css/nnnnn.css">
    <link rel="stylesheet" href="../css/header.css">
    
    <script src="../js/common.js"></script>
    <script src="../js/Chart.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/header.js" defer></script>
    <script src="../js/showMsg.js"></script>
    <script src="../js/showStar.js"></script>
</head>

<body id="showItem">

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
                                            <li ><a href="shopping.html">零食列表</a></li>
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
                                <option value="">國家</option>
                                <option value="">英國</option>
                                <option value="">美國</option>
                                <option value="">日本</option>
                                <option value="">泰國</option>
                            </select>
                            <select name="kind" id="kind">
                                <option value="">種類</option>
                                <option value="">巧克力</option>
                                <option value="">糖果</option>
                                <option value="">餅乾</option>
                                <option value="">洋芋片</option>
                            </select>
                            <select name="flavor" id="flavor">
                                <option value="">口味</option>
                                <option value="">酸</option>
                                <option value="">甜</option>
                                <option value="">辣</option>
                            </select>                            
                        </div>
                        <div class="inputbar">
                            <input type="text" placeholder="想找什麼零食呢？">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                        <div id="close">
                            <span class="close">X</span>
                        </div>
            </div>
            </header>

    <ol aria-label="breadcrumb" class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html"> 首頁 / </a></li>
        <li class="breadcrumb-item"><a href="shopping.html"> 零食列表 / </a></li>
        <li class="breadcrumb-item active" aria-current="page"> <?php echo '['.$snackRow['nation'].']'.$snackRow['snackName']?></li>
    </ol>

    <section id='item'>

            <div class="flexWrap itemImgWrap">
                <img class="itemImg" src="<?php echo $snackRow['snackPic']?>" alt="商品圖">
            </div>
            <div class="flexWrap rankWrap">
            <?php
                $i=1;
                $month=Date("m")==1?12:Date("m")-1;
                $year= Date("m")==1?Date("Y")-1:Date("Y");
                ;
                    while($i<4){
                        if($rankRow=$Rankfeed->fetch()){
                            echo "<div class='rank' id='rank{$i}'>{$year}年{$month}月{$rankRow['rankGenre']}排行 第{$rankRow['ranking']}名</div>";   
                            if($i==1){$crownNum=$rankRow['ranking'];}
                            
                        }else{
                            if($i==1){
                                echo "<div class='rank'  id='rank0'>本商品目前尚未上榜</div>";
                                $crownNum=0;
                            }else{
                            echo "<div class='rank notRank'  id='rank{$i}'>本商品目前尚未上榜</div>";
                            }
                           
                        }
                        $i++;
                    }
            ?>
            </div>
            <div class="flexWrap" id="rankGrid">
                    <div class="col colCrown">
                        <?php
                            switch($crownNum){
                                case "1":$crownPic=""; break;
                                case "2":$crownPic=""; break;
                                case "3":$crownPic=""; break;
                                case "4":$crownPic=""; break;
                                case "5":$crownPic=""; break;
                                case "6":$crownPic=""; break;  
                                case "0":$crownPic=""; break;                                
                            }
                        ?>
                        <img class="crown"src="../images/rankBoard/crown.png" alt="皇冠">
                    </div>

                    <div class="col radar">
                        <canvas class="radarCanvas"></canvas>
                    </div>
                    <div class="col score">
                                <p id="rate">好評度</p>
                                <p class="scoreAvg"><?php echo $avgG ?><span class="total">/5</span></p>
                                <div class="star"id="avgG" grad="<?php echo $avgG ?>"><img src="../images/rankBoard/starMask.png" alt="星等"></div>
                                <p class="evaTimes">共<?php echo $Etimes ?>次評價</p>
                    </div>
                    <div class="col stars">
                        <p>甜<span id="sweet" class="star" grad="<?php echo $avgT ?>"><img src="../images/rankBoard/starMask.png" alt="星等"></span><span id="avgT"><?php echo $avgT ?></span></p>
                        <p>酸<span id="sour" class="star" grad="<?php echo $avgS ?>"><img src="../images/rankBoard/starMask.png" alt="星等"></span><span id="avgS"><?php echo $avgS ?></span></p>
                        <p>辣<span id="spicy" class="star " grad="<?php echo $avgH ?>" ><img src="../images/rankBoard/starMask.png" alt="星等"></span><span id="avgH"><?php echo $avgH ?></span></p>
                    </div>
            </div>
        


            <div class="flexWrapR titleWrap">
                <h2><p>[<?php echo $snackRow['nation']?>]</p><?php echo $snackRow['snackName']?></h2>
            </div>
            <p class="flexWrapR" id="itemDsc">
            <?php echo $snackRow['snackWord']?>
            </p>
            <div class="flexWrapR ctxWrap" >
                <p id="price">價格<span>$<?php echo $snackRow['snackPrice']?></span></p>
                <div id="itemNum">
                    <p>數量</p>
                    <div class="numInput">
                        <span class="numMinus">-</span><input type="number" value="1"><span class="numPlus">+</span>
                    </div>
                    <button class="cart">加入購物車</button>
                    <button class="heart"><i class="far fa-heart"></i></button>
                </div>
                <p>
                    成分
                    <span id="ingre"><?php echo $snackRow['snackIngre']?></span>
                </p>
            </div>
            <div class="map flexWrapR">
                
            <p>最近的販賣機</p>
                <?php if($snackRow['snackVending']){
                    echo '<img src="../images/rankBoard/map.png" alt="地圖">';
                }else{
                    echo '<p>本商品目前未上架於販賣機</p>';
                }?>
                
                
            </div>  



    </section>
    <section id="comment">
        <div class="comments">
            <h3>商品評價</h3>

            <div class="comment">

                <div class="mem">
                    <div class="memPic">
                        <img src="../images/rankBoard/memPic.png" alt="會員頭像" class="memImg">
                    </div>

                    <div class="memCol">
                        <div class="memId">
                            <p>Apple12345678</p><button class="report">...</button>
                        </div>
                        <div class="star"><img src="../images/rankBoard/starMask.png" alt="星等"></div>
                        <p class="commentCtx">
                            真是台美味了，要是在也吃不到要怎麼辦啊啊啊啊啊。價格實惠又好吃!!!!!!!真是台美味了，要是在也吃不到要怎麼辦啊啊啊啊啊。價格實惠又好吃!!!!!!!真是台美味了，要是在也吃不到要怎麼辦啊啊啊啊啊。價格實惠又好吃!!!!!!!
                        </p>

                        <div class="commentBtns">
                            <button class="like"><i class="far fa-thumbs-up"></i>0</button>
                            <button class="share"><i class="fas fa-share"></i>分享</button>
                            <button class="btnMsg"><i class="fas fa-comment"></i>顯示留言</button>
                        </div>

                        <div class="msgBox">
                            <!-- <textarea class="msg" name="msg"  placeholder="留言......"></textarea> -->
                            <input type="text" class="msg" name="msg" placeholder="留言......">
                            <input type="submit" class="sendMsg" value="送出">
                        </div>

                        <div class="msgs">
                            <div class="msg_num msg_1">
                                <div class="memPic">
                                    <img src="../images/rankBoard/memPic.png" alt="會員頭像" class="memImg">
                                </div>
                                <div class="msgCol">
                                    <div class="memId">
                                        <p>Apple12345678</p><button class="report">...</button>
                                    </div>
                                    <p class="msgCtx">太啦!</p>
                                </div>
                            </div>
                            <div class="msg_num msg_2">
                                <div class="memPic">
                                    <img src="../images/rankBoard/memPic.png" alt="會員頭像" class="memImg">
                                </div>
                                <div class="msgCol">
                                    <div class="memId">
                                        <p>Apple12345678</p><button class="report">...</button>
                                    </div>
                                    <p class="msgCtx">再啦!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mem">
                    <div class="memPic">
                        <img src="../images/rankBoard/memPic.png" alt="會員頭像" class="memImg">
                    </div>

                    <div class="memCol">
                        <div class="memId">
                            <p>Apple12345678</p><button class="report">...</button>
                        </div>
                        <div class="star"><img src="../images/rankBoard/starMask.png" alt="星等"></div>
                        <p class="commentCtx">
                            真是台美味了，要是在也吃不到要怎麼辦啊啊啊啊啊。價格實惠又好吃!!!!!!!真是台美味了，要是在也吃不到要怎麼辦啊啊啊啊啊。價格實惠又好吃!!!!!!!真是台美味了，要是在也吃不到要怎麼辦啊啊啊啊啊。價格實惠又好吃!!!!!!!
                        </p>

                        <div class="commentBtns">
                            <button class="like"><i class="far fa-thumbs-up"></i>0</button>
                            <button class="share"><i class="fas fa-share"></i>分享</button>
                            <button class="btnMsg"><i class="fas fa-comment"></i>顯示留言</button>
                        </div>

                        <div class="msgBox">
                            <input type="text" class="msg" name="msg" placeholder="留言......">
                            <input type="submit" class="sendMsg" value="送出">
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div id="pagination">
            <ul>
                <li class="page-item"><a href="#" id="last" class="page-link"><i class="fas fa-chevron-left"></i></a></li>
                <li class="page-item"><a href="#"  class="page-link nowLoc">01</a></li>
                <li class="page-item"><a href="#"  class="page-link">02</a></li>
                <li class="page-item"><a href="#" class="page-link">03</a></li>
                <li class="page-item"><a href="#" id="next" class="page-link"><i class="fas fa-chevron-right"></i></a></li>
            </ul>
        </div>
    </section>

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
</body>
<script src="../js/showItem.js"></script>
</html>