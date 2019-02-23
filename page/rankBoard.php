<?php
session_start();
// $snackNo = $_GET["snackNo"];
    $errMsg = "";
    try {
        require_once("connectcd105g2.php");

        //撈出綜合前三資料
        $sql = "SELECT * FROM `snack`,`rank` WHERE `snack`.`snackNo`=`rank`.`snackNo` and `rank`.`rankGenre`='綜合' ORDER BY `ranking` limit 0,6";
        $feed=$pdo->query($sql);
        $snackAllRow=$feed->fetchAll();
        for($i=0;$i<3;$i++){
            $sql ="SELECT 
                COUNT(snackNo) as Etimes,
                AVG(goodStar) as avgG,
                AVG(sourStar) as avgS,
                AVG(sweetStar) as avgT,
                AVG(spicyStar) as avgH  
                FROM eva WHERE snackNo={$snackAllRow[$i]['snackNo']}";
            $feed=$pdo->query($sql);
            $evaRow=$feed->fetch();
            $Etimes[$i] =$evaRow['Etimes'];
            $avgG[$i] =number_format($evaRow['avgG'],1);
            $avgS[$i] =number_format($evaRow['avgS'],1);
            $avgT[$i] =number_format($evaRow['avgT'],1);
            $avgH[$i] =number_format($evaRow['avgH'],1);
        }

        $sql="SELECT * FROM `rank` WHERE `snackNo`={$snackAllRow[0]['snackNo']}";
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
    <title>大零食家 每月排行</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../css/rankBoard.css">
    <link rel="stylesheet" href="../css/nnnnn.css">        
    <link rel="stylesheet" href="../css/header.css">
    <script src="../js/common.js"></script>
    <script src="../js/Chart.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/header.js" defer></script>
    <!-- <script src="../js/showMsg.js"></script> -->
    <script src="../js/rankBoard.js"></script>
    <!-- <script src="../js/findingIp.js"></script> -->
    <!-- <script src="../js/showStar.js"></script> -->
    <script src="../js/showMsg.js"></script>
</head>
<body class="rankBoard">
    <?php
        require_once("header.php");
    ?>
    <section id='bgLayer'>
        <div class="rollingItem mNone" id="roll_4">
            <img src="../images/rankBoard/itemGnull.png">
        </div>
        <div class="rollingItem mNone" id="roll_1">
            <img src="../images/rankBoard/itemRnull.png">
        </div>
        <div class="rollingItem mNone" id="roll_2">
            <img src="../images/rankBoard/itemGnull.png">
        </div>
        <div class="rollingItem mNone" id="roll_5">
            <img src="../images/rankBoard/itemRnull.png">
        </div>
        <div class="rollingItem mNone" id="roll_3">
            <img src="../images/rankBoard/itemBnull.png">
        </div>
    </section>

    <section id="sec1"> 


        <!-- 阿就放標題的雲 -->
        <div class="title" id="titleAll">
            <h2>本月<br>綜合排行</h2>
        </div>

        <div class="itemWrap">
            <!-- 第一名的糖果這整個DIV一起漂浮 -->
            
            <div class="item" id="rank_1" >
            <a class="scrollDown">    
                <img class="itemBg" src="../images/rankBoard/rank1.png" alt="排名底圖">
                <img class="itemCountry" src="../images/blair/<?php echo $snackAllRow[0]['nation'] ?>.png" alt="國家">

                <div class="itemCtx">
                    <img  src="<?php echo $snackAllRow[0]['snackPic']?>" alt="產品圖">

                    <h4 class="itemName"><?php echo '['.$snackAllRow[0]['nation'].']'.$snackAllRow[0]['snackName']?></h4>
                    <div class="flexMid"><p class="score"><?php echo $avgG[0] ?><span class="total">/5</span></p></div>
                    <div class="star" grad="<?php echo $avgG[0] ?>"><img src="../images/rankBoard/starMask.png" alt="星等"></div>
                </div>
                
            </a>    
            </div>

            <!-- 第二名的糖果 -->
            <div class="item" id="rank_2">
                <a class="scrollDown">
                <img class="itemBg" src="../images/rankBoard/rank2.png" alt="排名底圖">
                <img class="itemCountry" src="../images/blair/<?php echo $snackAllRow[1]['nation'] ?>.png" alt="國家">

                <div class="itemCtx">
                    <img  src="<?php echo $snackAllRow[1]['snackPic']?>" alt="產品圖">
                    <h4 class="itemName"><?php echo '['.$snackAllRow[1]['nation'].']'.$snackAllRow[1]['snackName']?></h4>
                   
                     <div class="flexMid"><p class="score"><?php echo $avgG[1] ?><span class="total">/5</span></p></div>
                     <div class="star"  grad="<?php echo $avgG[1] ?>"><img src="../images/rankBoard/starMask.png" alt="星等"></div>
                </div>
            </a>        
            </div>

            <!-- 第三名的糖果 -->
            <div class="item" id="rank_3">
                <a class="scrollDown">  
                <img class="itemBg" src="../images/rankBoard/rank3.png" alt="排名底圖">
                <img class="itemCountry" src="../images/blair/<?php echo $snackAllRow[2]['nation'] ?>.png" alt="國家">

                <div class="itemCtx">
                    <img  src="<?php echo $snackAllRow[2]['snackPic']?>" alt="產品圖">
                    <h4 class="itemName"><?php echo '['.$snackAllRow[2]['nation'].']'.$snackAllRow[2]['snackName']?></h4>
                    <div class="flexMid"><p class="score"><?php echo $avgG[2] ?><span class="total">/5</span></p></div>
                    <div class="star" grad="<?php echo $avgG[2] ?>"><img src="../images/rankBoard/starMask.png" alt="星等"></div>
                </div>
                
            </a>        
            </div>
        </div>
    </section>

    <section id="sec2">
        <!-- 阿就標題的雲  Cat=category-->
        <div class="title" id="titleCat">
            <h2 id="titleCatCtx">本月<br>綜合排行</h2>
        </div>

        <div id="allPanel">
            <!-- 左側選種類的單 -->
            <aside >
                <div class="switch sw_class catLoc" id="sw_all" gNum='1'>綜合</div>
                <div class="switch sw_class" id="sw_cookie" gNum='2'>餅乾</div>
                <div class="switch sw_class" id="sw_candy" gNum='3'>糖果</div>
                <div class="switch sw_class" id="sw_choco" gNum='4'>巧克力</div>
                <div class="switch sw_class" id="sw_chip" gNum='5'>洋芋片</div>
            </aside>

            <!-- 中間的轉盤 -->
            <div id="rankPanel">
                <img class="mNone" id="panelRing"src="../images/rankBoard/rankPanel.png" alt="排行圓環">

                    <div class="switch sw_ring mNone" id="sw_ring"></div>


                <div id="ipIcon">
                    <img src="../images/rankBoard/ipCookie.png" alt="各類別圖片" id="ipImg">
                    <img src="../images/rankBoard/ipGlow.png" alt="背景光" id="C">
                </div>

                <div class="switch sw_rk mNone" snackNo="<?php echo $snackAllRow[0]['snackNo']?>" id="sw_1">1</div>
                <div class="switch sw_rk mNone" snackNo="<?php echo $snackAllRow[1]['snackNo']?>" id="sw_2">2</div>
                <div class="switch sw_rk mNone" snackNo="<?php echo $snackAllRow[2]['snackNo']?>" id="sw_3">3</div>
                <div class="switch sw_rk mNone" snackNo="<?php echo $snackAllRow[3]['snackNo']?>" id="sw_4">4</div>
                <div class="switch sw_rk mNone" snackNo="<?php echo $snackAllRow[4]['snackNo']?>" id="sw_5">5</div>
                <div class="switch sw_rk mNone" snackNo="<?php echo $snackAllRow[5]['snackNo']?>" id="sw_6">6</div>
            </div>

            <div class="itemDetail" id="item" snackNo="<?php echo $snackAllRow[0]['snackNo']?>">
                <div class="blank" id="rollCtx">

                    <img class="itemImg" id="itemImg" src="<?php echo $snackAllRow[0]['snackPic']?>" alt="商品圖">
                    <h2 id='nationName'><p>[<?php echo $snackAllRow[0]['nation']?>]</p>
                    <?php echo $snackAllRow[0]['snackName']?></h2>
                    <div id="rankWrap">
                        <?php
                            $i=1;
                            $month=Date("m")==1?12:Date("m")-1;
                            $year= Date("m")==1?Date("Y")-1:Date("Y");
                            ;
                                while($i<4){
                                    if($rankRow=$Rankfeed->fetch()){
                                        echo "<div class='rank' id='rank{$i}'>{$year}年{$month}月{$rankRow['rankGenre']}排行 第{$rankRow['ranking']}名</div>";   
                                    }else{
                                        if($i==1){
                                            echo "<div class='rank'  id='rank0'>本商品目前尚未上榜</div>";
                                        }else{
                                        echo "<div class='rank notRank'  id='rank{$i}'>本商品目前尚未上榜</div>";
                                        }
                                    }
                                    $i++;
                                }
                        ?>
                    </div>
                        
                    <div class="itemBtns">
                        <span id="price">$<?php echo $snackAllRow[0]['snackPrice']?></span>
                        <button class="detail"> <a id='snackLink' href="../page/showItem.php?snackNo=<?php echo $snackAllRow[0]['snackNo']?>">商品詳細</a></button>
                        <button class="cart" id="<?php echo " {$snackAllRow[0]['snackNo']}|{$snackAllRow[0]['snackPrice']}|0"?>">加入購物車</button>
                        <button class="heart" id=<?php echo $snackAllRow[0]['snackNo']?>><i class="far fa-heart"></i></button>
                    </div>

                    <hr>

                    <div class="eva">
                        <div class="score">
                            <p class="evaTimes" id='evaTimes'>共<?php echo $Etimes[0]?>次評價</p>
                            <p class="scoreAvg" id='scoAvg'><?php echo $avgG[0] ?><span class="total">/5</span></p>
                            <div class="star"id="detailAvgG" grad="<?php echo $avgG[0] ?>"><img src="../images/rankBoard/starMask.png" alt="星等"></div>
                        </div>
                        <div class="radar" s="<?php echo $avgS[0] ?>" t="<?php echo $avgT[0] ?>" h="<?php echo $avgH[0] ?>" >
                                <canvas class="radarCanvas"></canvas>
                        </div>
                    </div>

                    <div class="comments">
                        <h3>商品評價</h3>

                        <div class="comment" id="cmtDiv">

                        </div>
                    </div>
                    <div id="pagination">
                    </div>
                </div>

            </div>
            <div id="mRankPanel">
                <div class="switch sw_rk m_rk  catLoc" id="m_rk1" snackNo="<?php echo $snackAllRow[0]['snackNo']?>">1</div>
                <div class="switch sw_rk m_rk " snackNo="<?php echo $snackAllRow[1]['snackNo']?>">2</div>
                <div class="switch sw_rk m_rk " snackNo="<?php echo $snackAllRow[2]['snackNo']?>">3</div>
                <div class="switch sw_rk m_rk " snackNo="<?php echo $snackAllRow[3]['snackNo']?>">4</div>
                <div class="switch sw_rk m_rk " snackNo="<?php echo $snackAllRow[4]['snackNo']?>">5</div>
                <div class="switch sw_rk m_rk " snackNo="<?php echo $snackAllRow[5]['snackNo']?>">6</div>
            </div>
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

</html>