<?php
session_start();
// $snackNo = $_GET["snackNo"];
    $errMsg = "";
    try {
        // require_once("blairConnect.php");
        require_once("connectcd105g2.php");

        if(isset($_GET["snackNo"]) == false){
            //如果沒有給snackNo就跳轉回shopping.php
             header('Location:shopping.php');
             exit();
        }else{
            $snackNo=$_GET["snackNo"];
        }

        //撈出商品資料
        $sql = "SELECT * FROM snack WHERE snackNo={$snackNo}";
        $feed=$pdo->query($sql);
        $snackRow=$feed->fetch();
        //撈出評價分數資料
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

        //撈出排名資料
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
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/nnnnn.css">
    
    
    <script src="../js/common.js"></script>
    <script src="../js/Chart.js"></script>
    
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/header.js" defer></script>
    <script src="../js/findingIp.js"></script>
    <script src="../js/showMsg.js"></script>
    <script src="../js/addHeart.js"></script>
    <script src="../js/addcart.js"></script>
    
</head>

<body id="showItem">

    <?php
        require_once("header.php");
    ?>

    <ol aria-label="breadcrumb" class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html"> 首頁 / </a></li>
        <li class="breadcrumb-item"><a href="shopping.html"> 零食列表 / </a></li>
        <li class="breadcrumb-item active" aria-current="page"> <?php echo '['.$snackRow['nation'].']'.$snackRow['snackName']?></li>
    </ol>

    <section id='item' snackNo=<?php echo $snackRow['snackNo'] ?>>

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
                        <img class="crown"src="../images/rankBoard/crown<?php echo $crownNum?>.png" alt="皇冠">
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
                    <!-- <p>數量</p>
                    <div class="numInput">
                        <span class="numMinus">-</span><input type="number" value="1"><span class="numPlus">+</span>
                    </div> -->
                    <button class="cart" id="<?php echo "{$snackRow['snackNo']}|{$snackRow['snackPrice']}|0"?>">加入購物車</button>
                    <button class="heart"id="<?php echo $snackRow['snackNo']?>" ><i class="far fa-heart"></i></button>
                </div>
                <p>
                    成分
                    <span id="ingre"><?php echo $snackRow['snackIngre']?></span>
                </p>
            </div>
            <div class="map flexWrapR" >
                
            <p >附近有販售本商品的販賣機：</p>
                <div id="map" show="<?php echo $snackRow['snackVending']?>">
                        
                </div>
                

            </div>  



    </section>
    <section id="comment">
        <div class="comments">
            <h3>商品評價</h3>

            <div class="comment" id="cmtDiv">

            </div>
        </div>
        <div id="pagination">
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
<script src="../js/gsell.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtX5-RvBMYUEwZHD1e8xcMdpSbksS3lPQ&callback=initMap"
async defer></script>
<script src="../js/showItem.js"></script>

</html>