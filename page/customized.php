<?php
$errMsg = "";
try {
	require_once("connectcd105g2.php");
	$sql = "select * from snack";
     $snack = $pdo->query($sql); 
     $snackRows = $snack -> fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	$errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
	$errMsg .= "行號 : ".$e -> getLine()."<br>";
}
 
?> 
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customized</title>
  <link rel="stylesheet" href="../css/recordingModel_2.css">
  <link rel="stylesheet" href="../css/customized.css">
  <link rel="stylesheet" href="../css/nnnnn.css">
  <link rel="stylesheet" href="../css/header.css">
   <!-- 為了各種符號，掛載fontawesome -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
   crossorigin="anonymous">
   <script src="../js/jquery-3.3.1.min.js"></script>
   <script src="../js/shadowLib.js""></script>
   <!-- 錄音外掛。我想我跳下去玩一定會來不及。謝謝你 9527 -->
   <script src="../js/recorder.js"></script>
   <script src="../js/common.js"></script>
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

  <div class="card step-progress">
    <div class="step-slider">
      <div data-id="step1" class="step-slider-item"></div>
      <div data-id="step2" class="step-slider-item"></div>
      <div data-id="step3" class="step-slider-item"></div>
      <!-- <div data-id="step4" class="step-slider-item"></div> -->
    </div>
    <div class="step-content">
      <div id="step1" class="step-content-body">
        <div class="customized">
            <div class="snackHouse">
                <div class="roof">
                    <img src="../images/roof.svg" alt="">
                </div>
                <div class="makingStep">
                        <div class="cloudy step1">
                            <div class="circle" style="background:#aedcd3;"></div>
                        <p>設計箱子</p>
                        </div>    
                         <div class="cloudy step2">
                            <div class="circle"></div>
                            <p>設計卡片</p>
                        </div>    
                         <div class="cloudy step3">
                            <div class="circle"></div>
                            <p>選購零食</p>            
                        </div>    
                         <!-- <div class="cloudy step4">
                            <div class="circle"></div>
                            <p>客製完成</p>   
                        </div> -->
                </div>
                <div class="section section_15" id="section_15">
                    
                    <div class="leftBox">
                        <div id="ctrl_bar">
                            <div class="btn btn_front dimension" id="btn_front">前</div>
                            <div class="btn btn_back dimension" id="btn_back">後</div>
                            <div class="btn btn_top dimension" id="btn_top">上</div>
                            <div class="btn btn_left dimension" id="btn_left">左</div>
                            <div class="btn btn_right dimension" id="btn_right">右</div>
                            <div class="btn rotateX dimension" id="rotateX">轉</div>
                              <!-- <div class="btn rotateY" id="rotateY">Y軸轉轉</div>-->
                            <!-- <div class="btn rotateZ dimension" id="rotateZ">轉</div>  -->
                        </div>
                        <div class="showBox">
                                <div class="camera">
                                    <div class="box boxBase" id="box_15">
                                        <div class="surface surface_top" id="cover_out_15">
                                            <img src="ip2.png" id="a1" alt="">
                                        </div>
                                        <div class="surface surface_top_inner" id="cover_in_15">
                                    
                                        </div>
                                        <div class="surface surface_down"></div>
                                        <div class="surface surface_back"></div>
                                        <div class="surface surface_front"></div>
                                        <div class="surface surface_left"></div>
                                        <div class="surface surface_right"></div>
                                    </div>
                                </div>
                        
                                <div id="btns15">
                                    <div class="btn" id="btn_big"><img src="../images/customized/zoom_in.svg" alt=""></div>
                                    <div class="btn" id="btn_small"><img src="../images/customized/zoom_out.svg" alt=""></div>
                                    <div class="btn" id="btn_clk"><img src="../images/customized/rotate.svg" alt=""></div>
                                    <div class="btn" id="btn_clk_r"><img src="../images/customized/rotate.svg" alt="" style="transform: rotate(175deg);"></div>
                                    <div class="btn" id="btn_del"><i class="fa fa-trash"></i></div>
                                </div>                        
                                <!-- <div class="btn show action" id="show" style="line-height: 35px;margin:3px auto;">3D展示</div> -->
                        </div>
                    </div>  
                    <div class="form">
                        <ul class="tab-group-1">
                            <li class="tab-1 active"><a href="#signup">顏色</a></li>
                            <li class="tab-1"><a href="#login">圖片</a></li>
                        </ul>
                        <div class="tab-content-1">
                            <div id="signup">   
                            <div class="top-row">
                                <div class="pickColor">
                                    <div class="colorBtn color1"></div>
                                    <div class="colorBtn color2"></div>
                                    <div class="colorBtn color3"></div>
                                    <div class="colorBtn color4"></div>
                                    <div class="colorBtn color5"></div>
                                    <div class="colorBtn color6"></div>
                                    <div class="colorBtn color7"></div>
                                    <div class="colorBtn color8"></div>
                                </div>
                            </div>
                                </div>
                            <div id="login">   
                                <div class="pics">
                                    <div class="pic">
                                        <img src="../images/tina/LOGO1.png" alt="">
                                    </div>
                                    <div class="pic">
                                        <img src="../images/customized/chips.svg" alt="">
                                    </div>
                                    <div class="pic">
                                        <img src="../images/customized/cookies.svg" alt="">
                                    </div>
                                    <div class="pic">
                                        <img src="../images/customized/chocolate.svg" alt="">
                                    </div>
                                    <div class="pic">
                                        <img src="../images/customized/lollip.svg" alt="">
                                    </div>                                    
                                    <!-- <div class="pic">
                                        <img src="../images/customized/candy.svg" alt="">
                                    </div>                                     -->
                                    <div class="pic">
                                        <img src="../images/customized/machi.svg" alt="">
                                    </div>
                                    <div class="pic">
                                        <img id="image">
                                    </div>
                                </div>  
                                
                                <input type="file" id="theFile">
            <p>
                <textarea id="fileInfo" rows="5" cols="70" style="display:none;"></textarea>
            </p>
                            </div>
                        </div><!-- tab-content -->
                    </div>
            </div>
        </div>
    </div>
    </div>
   
      <div id="step2" class="step-content-body out">
        <div class="customized">
            <!-- <div class="priceSign">$150</div> -->
            <div class="snackHouse">
                <div class="roof">
                    <img src="../images/roof.svg" alt="">
                </div>
                <div class="makingStep">
                        <div class="cloudy step1">
                        <div class="circle"></div>
                            <p>設計箱子</p>
                        </div>    
                         <div class="cloudy step2">
                            <div class="circle" style="background:#aedcd3;"></div>
                            <p>設計卡片</p>
                        </div>    
                         <div class="cloudy step3">
                            <div class="circle"></div>
                            <p>選購零食</p>            
                        </div>    
                         <!-- <div class="cloudy step4">
                            <div class="circle"></div>
                            <p>客製完成</p>   
                        </div> -->
                    </div>
                <div class="section section_15" id="section_15">
                    <div class="lefCard" style="flex:2;">
                            <div class="cardBox">
                                    <img  id="large" src="../images/customized/card.png" alt="">
                                </div>
                    </div>
                    <div class="pickCard">
                            <ul class="tab-content-2">
                                <li class="tab yellow">樣式</li>
                                <li class="tab">文字</li>
                                <li class="tab">語音</li>
                            </ul>
                            <div class="content">
                                <div class="cardStyle">
                                    <img src="../images/customized/card.png" class="small" id="i_0">
                                    <!-- <img src="../images/small/card02.png" class="small" id="i_1">
                                    <img src="../images/small/card03.png" class="small" id="i_1">
                                    <img src="../images/small/card04.png" class="small" id="i_1">                           -->
                                </div>
                            </div>
                            <div class="content">
                                <div class="cardText"> 
                                    <div class="btn7 action" id="btn7_add" style="line-height:35px; margin:25px;">新增文字</div>                          
                                    <div id="btns7">
                                            <div class="btn7 dimension" id="btn7_big">大</div>
                                            <div class="btn7 dimension" id="btn7_small">小</div>
                                            <div class="btn7 dimension" id="btn7_clk">順</div>
                                            <div class="btn7 dimension" id="btn7_unclk">逆</div>
                                            <div class="btn7 dimension" id="btn7_del">刪</div>
                                    </div>     
                                    <div class="showCard">
                                        <div class="section_7 sectionCard" id="section_7">
                                            <div class="cardCamera" id="cardCamera_7">
                                                <div class="cardBase" id="cardBase_7">
                                                    <div class="cardBaseContent" id="cardBaseConten">
                                                        <div class="cardSurfaceInner cardContentInner_7" id="cardContentInner_7">封底</div>
                                                        <div class="cardSurface cardContent_7" id="cardContent_7">
                                                            <!-- <div class="textTeam">
                                                                <div class="ctrlPos">點擊拖曳</div>
                                                                <div class="textarea" contenteditable="true" placeholder="點擊輸入文字"></div>
                                                                <div class="textResize"></div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                    <!-- <div class="cardBaseCover" id="cardBaseCover">
                                                        <div class="cardSurfaceInner cardCoverInner_7" id="cardCoverInner_7">封面(裡)</div>
                                                        <div class="cardSurface cardCover_7" id="cardCover_7"></div>
                                                    </div> -->
                                                </div>
                                            </div>                                    
                                        </div>
                                    </div>                                                                       
                                    <!-- <span class="action" style="line-height: 35px; margin: auto;">新增</span> -->
                                </div>
                            </div>
                            <div class="content">
                                <div class="cardRecord">
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
                                        <button id="audioDel" class="au_btn trash"><i class="far fa-trash-alt"></i></button>
                                    </div>
                            
                                    <!-- 進度條與時間提示 -->
                                    <div class="au_ctrl">
                                        <!-- 這是進度條 -->
                                        <div class="defBar" id="defBar">
                                            <!-- 伸縮bar -->
                                            <div class="proBar" id="proBar"></div>
                                            <!-- 拉桿 -->
                                            <div class="barNote" id="barNote"></div>
                                        </div>
                                        <!-- 時間提示組 -->
                                        <div class="au_time" id="au_time">
                                            <!-- 當前時間 -->
                                            <span class="au_timeNow" id="au_timeNow">00:00</span>
                                            <span>/</span>
                                            <!-- 總長 -->
                                            <span class="au_timeAll" id="au_timeAll">00:00</span>
                                        </div>
                                    </div>
                            
                                    <!-- 錄音操作鈕 -->
                                    <!-- 一下錄，一下不錄 -->
                                    <div id="recordBtn" class="recordBtn"><i class="fas fa-microphone"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div> 
             </div>
         </div>
      </div>
      <div id="step3" class="step-content-body out">
        <div class="customized">
            <!-- <div class="priceSign">$150</div> -->
            <div class="snackHouse">
                <div class="roof">
                    <img src="../images/roof.svg" alt="">
                </div>
                <div class="makingStep">
                        <div class="cloudy step1">
                            <div class="circle"></div>
                            <p>設計箱子</p>
                        </div>    
                            <div class="cloudy step2">
                            <div class="circle"></div>
                            <p>設計卡片</p>
                        </div>    
                            <div class="cloudy step3">
                                <div class="circle" style="background:#aedcd3;"></div>
                            <p>選購零食</p>            
                        </div>    
                            <!-- <div class="cloudy step4">
                            <div class="circle"></div>
                            <p>客製完成</p>   
                        </div> -->
                    </div>
                <div class="section section_15" id="section_15">
                    <div class="shopping">
                        <div class="goodBox">
                                <ul class="tab-content-3">
                                    <li class="good yellow">購物車</li>
                                    <li class="good">收藏</li>
                                    <li class="good">巧克力</li>
                                    <li class="good">洋芋片</li>
                                    <li class="good">餅乾</li>
                                    <li class="good">糖果</li>
                                </ul>                    
                                <div class="good-content">
                        <?php
                            for($i=30; $i<37; $i++){
                        ?>
                            <div class="item">
                                <div class="name">           
                                        <img src="<?php echo $snackRows[$i]['snackPic']; ?>" alt="">                                    
                                        <div class="price">
                                        <p class="snackNo" style="display:none;"><?php echo $snackRows[$i]['snackNo']; ?></p>                   
                                            <p class="snackName"><?php echo $snackRows[$i]['snackName']; ?></p>
                                            <span>$<?php echo $snackRows[$i]['snackPrice']; ?></span>
                                            <button class="step addCart sendSnack" id="sendSnack" >放入零食車</button>                        
                                        </div>
                                    </div>
                                    
                            </div>
                        <?php
                            }
                        ?> 
                    </div>       
                    <div class="good-content">
                        <?php
                            for($i=20; $i<25; $i++){
                        ?>
                            <div class="item">
                                <div class="name">           
                                        <img src="<?php echo $snackRows[$i]['snackPic']; ?>" alt="">                                    
                                        <div class="price">
                                        <p class="snackNo" style="display:none;"><?php echo $snackRows[$i]['snackNo']; ?></p>                   
                                            <p class="snackName"><?php echo $snackRows[$i]['snackName']; ?></p>
                                            <span>$<?php echo $snackRows[$i]['snackPrice']; ?></span>
                                            <button class="step addCart sendSnack" id="sendSnack" >放入零食車</button>                        
                                        </div>
                                    </div>
                                    
                            </div>
                        <?php
                            }
                        ?> 
                    </div>       
                    
                <form id="snackForm">
                    <input id="snackDataName" type="hidden" name="snackDataName" value="">
                </form>                            
                    <div class="good-content">
                        <?php
                            for($i=0; $i<8; $i++){
                        ?>
                            <div class="item">
                                <div class="name">           
                                        <img src="<?php echo $snackRows[$i]['snackPic']; ?>" alt="">                                    
                                        <div class="price">
                                        <p class="snackNo" style="display:none;"><?php echo $snackRows[$i]['snackNo']; ?></p>                   
                                            <p class="snackName"><?php echo $snackRows[$i]['snackName']; ?></p>
                                            <span>$<?php echo $snackRows[$i]['snackPrice']; ?></span>
                                            <button class="step addCart sendSnack" id="sendSnack" >放入零食車</button>                        
                                        </div>
                                    </div>
                                    
                            </div>
                        <?php
                            }
                        ?> 
                    </div>                 
                     <div class="good-content">
                        <?php
                            for($i=13; $i<21; $i++){
                        ?>
                            <div class="item">
                                <div class="name">                                    
                                        <img src="<?php echo $snackRows[$i]['snackPic']; ?>" alt="">                                    
                                        <div class="price">
                                            <p class="snackNo" style="display:none;"><?php echo $snackRows[$i]['snackNo']; ?></p> 
                                            <p class="snackName"><?php echo $snackRows[$i]['snackName']; ?></p>
                                            <span>$<?php echo $snackRows[$i]['snackPrice']; ?></span>
                                            <button class="step addCart sendSnack" id="sendSnack">放入零食車</button>                        
                                        </div>
                                    </div>
                                    
                            </div>
                        <?php
                            }
                        ?> 
                    </div>  
                    <div class="good-content">
                        <?php
                            for($i=24; $i<32; $i++){
                        ?>
                            <div class="item">
                                <div class="name">          
                                        <img src="<?php echo $snackRows[$i]['snackPic']; ?>" alt="">                                    
                                        <div class="price">
                                            <p class="snackNo" style="display:none;"><?php echo $snackRows[$i]['snackNo']; ?></p> 
                                            <p class="snackName"><?php echo $snackRows[$i]['snackName']; ?></p>
                                            <span>$<?php echo $snackRows[$i]['snackPrice']; ?></span>
                                            <button class="step addCart sendSnack" id="sendSnack">放入零食車</button>                        
                                        </div>
                                    </div>
                                    
                            </div>
                        <?php
                            }
                        ?> 
                    </div> 
                    <div class="good-content">
                        <?php
                            for($i=37; $i<45; $i++){
                        ?>
                            <div class="item">
                                <div class="name">                                    
                                        <img src="<?php echo $snackRows[$i]['snackPic']; ?>" alt="">                                    
                                        <div class="price">
                                            <p class="snackNo" style="display:none;"><?php echo $snackRows[$i]['snackNo']; ?></p> 
                                            <p class="snackName"><?php echo $snackRows[$i]['snackName']; ?></p>
                                            <span>$<?php echo $snackRows[$i]['snackPrice']; ?></span>
                                            <button class="step addCart sendSnack" id="sendSnack">放入零食車</button>                        
                                        </div>
                                    </div>
                                    
                            </div>
                        <?php
                            }
                        ?> 
                    </div> 
                        </div>
                    </div>
                </div> 
                </div>
                </div>
      </div>
      <script>

        $(document).ready(function(){
            $(".sendSnack").bind("click",sendSnack);
            
        });


        function sendSnack(e){//----------------------------------
            //=====使用Ajax 回server端,取回資料, 放到頁面上 
            // var aa=document.getElementById("aa");
            var snackNo=$(this).parent().children("p")[0];
            // snackName=snackName.attr("data-snackNo");
            var snackDataName=document.getElementById("snackDataName");
            snackDataName.value=snackNo.innerText;
        var xhr = new XMLHttpRequest();
        xhr.onload = function(){
            if( xhr.responseText == "error"){
            alert("錯誤");
            }else{
            alert(`xhr.responseText: ${xhr.responseText}`);
            }
        }
        xhr.open("Post", "sessionSnack.php", true);
        var snackForm = new FormData( $id("snackForm"));
        xhr.send( snackForm ); 
        }

        //===設定sendSnack.onclick 事件處理程序是 sendForm
        // $id('sendSnack').onclick = sendSnack;
    </script>     
      <div id="stepLast" class="step-content-body out">Completed</div>
      <div class="step-content-foot">
        <button type="button" class="active" name="prev">上一步</button>
        <button type="button" class="active" name="next">下一步</button>
        <button type="button" class="active out" name="finish"><a href="#">加入購物車</a></button>
      </div>
    </div>
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
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="../js/customizedstep.js""></script>
  <script src="../js/header.js"></script>
    
  <!-- <script>
    const search_appear = document.getElementById("search_appear");
        const search = document.getElementById("searchBtn");
        const closex = document.getElementById("close");
        function init(e) {
            search.addEventListener("click", showSearch);
            closex.addEventListener("click", closeSearch);

        }
        function showSearch(e) {
            search_appear.classList.add("down");
        
        }
        function closeSearch(e) {
            console.log(`remove`);
            search_appear.classList.remove("down");
        }

        window.addEventListener("load",init);

  </script> -->
  <script>
    const boxBases = document.querySelectorAll(".boxBase");
    const btns = document.querySelectorAll(".btn");
    //拖曳測試
    const pics = document.querySelectorAll("pics");
    const pic_img = document.querySelectorAll(".pic img");
    const surface = document.querySelectorAll(".surface");
    var arrDropedImg = [];
    // //動態生成的元素會抓不到
    // // const droped_img = document.querySelectorAll(".droped_img");
    // const droped_img = document.querySelectorAll(".surface img");
    ///允許 drop 的按鈕
    const btnDropOn = ["btn_front",
        "btn_back",
        "btn_top",
        "btn_bottom",
        "btn_left",
        "btn_right",
        "btn_big",
        "btn_small",
        "btn_clk",        
        "btn_clk_r",
        "btn_unclk",
        "btn_del"];
    //工作姿態陣列 posture
    // 此陣列姿態，開啟 surface 的 drop 監聽，其餘時候不給降落
    const posture = ["rotateX(0deg) rotateY(0deg) rotateZ(0deg)",//前
        "rotateX(0deg) rotateY(180deg) rotateZ(0deg)",//後
        "rotateX(-90deg) rotateY(0deg) rotateZ(0deg)",//上
        "rotateX(90deg) rotateY(0deg) rotateZ(0deg)",//下
        "rotateX(0deg) rotateY(90deg) rotateZ(0deg)",//左
        "rotateX(0deg) rotateY(-90deg) rotateZ(0deg)"]//右
    //允許控制圖片的按鈕
    const dropedImgCtrl = ["btn_big", "btn_small", "btn_clk","btn_clk_r", "btn_unclk", "btn_del"];


    //給箱子姿態初始值
    boxBases.forEach(el => {
        el.style.transform = "rotateX(-30deg) rotateY(30deg) rotateZ(0deg)";
    })

                 //按鈕監聽事件
                 btns.forEach(elem => {
                        elem.addEventListener("click", boxRotate);
                        elem.addEventListener("click", dropedCtrl);
                        elem.addEventListener("click", surfaceDropSwitch);//判斷要不要開drop區監聽
                        elem.addEventListener("click", addSelect); // 指定面上色 --------------------------0128
                })
    

                    //上標籤
                    function addSelect(e) {
                        if (e.target.classList.contains("rotateZ") || e.target.classList.contains("rotateX") ||
                                e.target.classList.contains("rotateY")) return; //工程鈕跳過
                        btns.forEach(el => {
                                el.classList.remove("btnSelect");
                        })
                        e.target.classList.add("btnSelect");
                }



                //監聽顏色按鈕們
                // console.log(`$class("colorBtn"): ${$class("colorBtn")}`);
                const colorBtn = document.querySelectorAll(".colorBtn");
                colorBtn.forEach(el => {
                        el.addEventListener("click", surfaceColorChange);
                        // console.log("監聽顏色鈕");
                })
                //改指定表面顏色
                function surfaceColorChange(e) {
                        //取按鈕背景色
                        var tarColor = window.getComputedStyle(e.target, null).getPropertyValue("background-color");
                        // console.log(`tarColor: ${tarColor}`);
                        // console.log(`tarColor type: ${typeof (tarColor)}`);

                        //更換目標背景色
                        // console.log(`$class("btnSelect").classLis: ${$class("btnSelect").classLis}`);
                        btns.forEach(el => {
                                if (el.classList.contains("btnSelect")) {
                                        var target = el.id; //取出按鈕id當字串
                                        target = target.replace("btn", "surface"); //把字串改成對應的surface
                                        document.querySelector("." + target).style.background = tarColor; //變色
                                }
                        })
                }

//任意處點擊解除拖曳圖片的選取狀態
var section15 = document.querySelector("#section_15");
        section15.addEventListener("click", removeDropImgTag);
        function removeDropImgTag(e) {
                //btnSelect是個不好的判斷法，因為目前是泡泡傳到div裡的圖片上所以才會產生btnSelect
                //目前已知會造成每個圖片都被上class
                if ((e.target.classList.contains("droped_img")) == false && (e.target.classList.contains("btnSelect")) == false) {
                        arrDropedImg.forEach(el => {
                                el.classList.remove("select");
                        })
                }
        }

    //拖曳功能監聽事件
    /// 對應按鈕觸發時要添加監聽事件，其餘移除監聽
    function surfaceDropSwitch(e) {
        // console.log(`btn id is: ${this.id}`);
        if (btnDropOn.indexOf(this.id) == -1) { //如果不是工作面的按鈕
            surface.forEach(el => {
                console.log(`el: ${el}`);
                el.removeEventListener("drop", dropped);//移除drop監聽
            })
        } else {
            surface.forEach(el => {
                el.addEventListener("drop", dropped);
            })
        }
    }

    /// 盒子不在指定姿態時要移除監聽
    boxBases.forEach(elem => {
        let pos = elem.style.transform;
        console.log(`pos: ${pos}`);
        console.log(`posture.indexOf(pos): ${posture.indexOf(pos)}`);
        if (posture.indexOf(pos) == -1) {
            surface.forEach(el => {
                console.log(`el: ${el}`);
                el.removeEventListener("drop", dropped);
            })
        } else {
            surface.forEach(el => {
                el.addEventListener("drop", dropped);
            })
        }
    })
    //可放置區(就是箱子表面)的監聽事件
    surface.forEach(elem => {
        //允許拖到表面(開放領空~)
        elem.addEventListener("dragover", function drageOver(e) {
            e.preventDefault();
            //出現提示效果，透明度改變
            e.target.style.opacity = "0.8";
            //drop區內被碰到的圖片開啟穿透的狀態，才能重疊上去
            //新增加的元素可以直接被事件觸發，透過for迴圈去抓元素的方式不行
            if (e.target.classList.contains("droped_img") == true) {
                e.target.style.pointerEvents = "none";
            }
        });
        //允許丟到表面上(允許降落~)
        // elem.addEventListener("drop", dropped);
        //沒被觸發的drop區恢復正常透明度
        elem.addEventListener("dragleave", function dragLeave(e) {
            e.target.style.opacity = "1";
        })
    })

    //箱子表面監聽
    //動態新增的東西需要先監聽父層，子層新增的元素開監聽才有效
    surface.forEach(elem => {
        elem.addEventListener("mouseenter", function wakeup() {
            console.log("mouseEnter");

            //"箱子表面的圖片"的監聽事件
            arrDropedImg.forEach(elem => {
                elem.addEventListener("dragstart", function dragStart_2(e) {
                    console.log("這裡的圖片動起來!");
                    e.dataTransfer.setData("text", "onSurface");
                    e.dataTransfer.setData("offsetx", e.offsetX);
                    e.dataTransfer.setData("offsety", e.offsetY);
                    srcItem = this;
                    console.log(`THIS ${this.nodeName}`);

                    // e.dataTransfer.setData("srcItem", this);
                })
                elem.addEventListener("dragend", function dragEnd_2(e) {
                    surface.forEach(elem => {
                        elem.style.opacity = "1";
                    })
                    //操作預先存起來的新元素陣列
                    arrDropedImg.forEach(elem => {
                        elem.style.pointerEvents = "auto";
                    })
                })
                elem.addEventListener("click", function selectDropedImg(e) {
                    arrDropedImg.forEach(el => {
                        el.classList.remove("select");
                    })
                    e.target.classList.add("select");
                })
            })
        })
    })

    //給"遠方的客人"可拖曳物件初始狀態
    pic_img.forEach(elem => {
        elem.addEventListener("dragstart", function dragStart(e) {
            // e.preventDefault();
            console.log(`e.target.src: ${e.target.src}`);
            //設定要傳送到drop方的訊息
            e.dataTransfer.setData("image/jpeg", e.target.src);
            e.dataTransfer.setData("offsetx", e.offsetX);//拖曳開始時，滑鼠在圖片內的相對位置
            e.dataTransfer.setData("offsety", e.offsetY);//拖曳開始時，滑鼠在圖片內的相對位置
        })
        elem.addEventListener("dragend", function dragEnd(e) {
            surface.forEach(elem => {
                elem.style.opacity = "1";
            })

            //操作預先存起來的新元素陣列
            arrDropedImg.forEach(elem => {
                elem.style.pointerEvents = "auto";
            })
        })
    })
    //從圖片區降落到箱子區的drop事件
    //要分成 "遠方來的客人" 和 "在地旅行的人"
    //"遠方的客人"只要新生成一個child在這片土地
    //"在地旅行的人"只要移動它的位置
    var drop_count = 1;
    console.log(`drop_count: ${drop_count}`);
    function dropped(e) {
        e.preventDefault();
        drop_count = drop_count + 1;//每次觸發drop就增加一次，讓新觸發物件的z-index更高
        // console.log(`drop_count: ${drop_count}`);
        //如果是有在地人的 class name 就會有 droped_img，那就給移動方法
        if (e.dataTransfer.getData('text') == "onSurface") {
            console.log(`droped_img`);
            //接收來自dragstart的座標訊息
            let mouseOffset = { x: 0, y: 0 };
            mouseOffset.x = e.dataTransfer.getData("offsetx");
            mouseOffset.y = e.dataTransfer.getData("offsety");
            //因為使用穿透屬性，所以座標定位不用迴避圖片了
            mouseNow = { x: 0, y: 0 };
            mouseNow.x = e.offsetX;
            mouseNow.y = e.offsetY;
            //接收來自setData的資料，設定新座標
            // let srcItem= e.dataTransfer.getData("srcItem")
            srcItem.style.zIndex = drop_count + 1;
            srcItem.style.top = parseInt(mouseNow.y - mouseOffset.y) + "px";
            srcItem.style.left = parseInt(mouseNow.x - mouseOffset.x) + "px";
        } else {//如果是遠方的客人，就新生成一個子元素在目標區
            //接收來自dragstart的座標訊息
            let mouseOffset = { x: 0, y: 0 };
            mouseOffset.x = e.dataTransfer.getData("offsetx");
            mouseOffset.y = e.dataTransfer.getData("offsety");
            //因為使用穿透屬性，所以座標定位不用迴避圖片了
            mouseNow = { x: 0, y: 0 };
            mouseNow.x = e.offsetX;
            mouseNow.y = e.offsetY;
            //創造新元素
            var img = document.createElement('img');
            img.src = e.dataTransfer.getData('image/jpeg');
            img.style.width = '50px';
            img.style.position = "absolute";
            img.style.top = parseInt(mouseNow.y - mouseOffset.y) + "px";
            img.style.left = parseInt(mouseNow.x - mouseOffset.x) + "px";
            img.classList.add("droped_img");
            img.style.zIndex = drop_count;
            img.id = "a" + drop_count;
            // img.style.pointerEvents = "none"; //可以被穿透，讓後面的圖可以順利覆蓋
            img.style.transform = "translateX(0px) translateY(0px) rotate(0deg) scale(1)";
            console.log(`e.target.classList: ${e.target.classList}`);
            arrDropedImg.push(img);//做一個陣列把動態添加元素的資料先存起來，之後統一操作
            // console.log(`arrDropedImg[]: ${arrDropedImg}`);
            // console.log(`arrDropedImg.length: ${arrDropedImg.length}`);
            this.appendChild(img);
            //恢復透明度
            e.target.style.opacity = "1";
        }
    }


    //dropedImgCtrl
    function dropedCtrl(e) {
        switch (this.id) {
            case "btn_big":
                arrDropedImg.forEach(el => {
                    if (el.classList.contains("select")) {
                        console.log("to be bigger");
                        let arr = el.style.transform.split(" ");
                        //有小數點時記得使用parseFloat保留小數點!!!用parseInt會砍掉小數點!!
                        let newScale = parseFloat(arr[3].replace("scale(", "").replace(")", "")) + 0.5;
                        console.log("arr: " + arr);
                        console.log("arr[3]: " + arr[3]);
                        console.log(parseFloat(arr[3].replace("scale(", "").replace(")", "")));
                        console.log("newScale: " + newScale);
                        arr[3] = "scale(" + newScale + ")";
                        el.style.transform = `${arr[0]} ${arr[1]} ${arr[2]} ${arr[3]}`;
                    }
                })
                break;
            case "btn_small":
                arrDropedImg.forEach(el => {
                    if (el.classList.contains("select")) {
                        console.log("to be smaller");
                        let arr = el.style.transform.split(" ");
                        //有小數點時記得使用parseFloat保留小數點!!!用parseInt會砍掉小數點!!
                        let newScale = parseFloat(arr[3].replace("scale(", "").replace(")", "")) - 0.5;
                        if (newScale < 0.1) newScale = 0.1;
                        console.log("arr: " + arr);
                        console.log("arr[3]: " + arr[3]);
                        console.log(parseFloat(arr[3].replace("scale(", "").replace(")", "")));
                        console.log("newScale: " + newScale);
                        arr[3] = "scale(" + newScale + ")";
                        el.style.transform = `${arr[0]} ${arr[1]} ${arr[2]} ${arr[3]}`;
                    }
                })
                break;
            case "btn_clk":
                arrDropedImg.forEach(el => {
                    if (el.classList.contains("select")) {
                        console.log("clk rotate");
                        let arr = el.style.transform.split(" ");
                        //有小數點時記得使用parseFloat保留小數點!!!用parseInt會砍掉小數點!!
                        let newAngel = parseInt(arr[2].replace("rotate(", "").replace("deg)", "")) + 20;
                        console.log("arr: " + arr);
                        console.log("arr[3]: " + arr[2]);
                        console.log(parseInt(arr[2].replace("rotate(", "").replace("deg)", "")));
                        console.log("newAngel: " + newAngel);
                        arr[2] = "rotate(" + newAngel + "deg)";
                        el.style.transform = `${arr[0]} ${arr[1]} ${arr[2]} ${arr[3]}`;
                    }
                })
                break;
            case "btn_clk_r":
                arrDropedImg.forEach(el => {
                    if (el.classList.contains("select")) {
                        console.log("clk rotate");
                        let arr = el.style.transform.split(" ");
                        //有小數點時記得使用parseFloat保留小數點!!!用parseInt會砍掉小數點!!
                        let newAngel = parseInt(arr[2].replace("rotate(", "").replace("deg)", "")) - 20;
                        console.log("arr: " + arr);
                        console.log("arr[3]: " + arr[2]);
                        console.log(parseInt(arr[2].replace("rotate(", "").replace("deg)", "")));
                        console.log("newAngel: " + newAngel);
                        arr[2] = "rotate(" + newAngel + "deg)";
                        el.style.transform = `${arr[0]} ${arr[1]} ${arr[2]} ${arr[3]}`;
                    }
                })
                break;
            case "btn_unclk":
                arrDropedImg.forEach(el => {
                    if (el.classList.contains("select")) {
                        console.log("unclk rotate");
                        let arr = el.style.transform.split(" ");
                        //有小數點時記得使用parseFloat保留小數點!!!用parseInt會砍掉小數點!!
                        let newAngel = parseInt(arr[2].replace("rotate(", "").replace("deg)", "")) - 20;
                        console.log("arr: " + arr);
                        console.log("arr[2]: " + arr[2]);
                        console.log(parseInt(arr[2].replace("rotate(", "").replace("deg)", "")));
                        console.log("newAngel: " + newAngel);
                        arr[2] = "rotate(" + newAngel + "deg)";
                        el.style.transform = `${arr[0]} ${arr[1]} ${arr[2]} ${arr[3]}`;
                    }
                })
                break;
            case "btn_del":
                arrDropedImg.forEach(el => {
                    if (el.classList.contains("select")) {
                        // el.parent
                        console.log("刪除前 " + arrDropedImg);
                        console.log(`el.parent: ${el.parentNode}`);
                        el.parentNode.removeChild(el);
                        console.log("刪除後 " + arrDropedImg);
                        //陣列內東西還在，但html確實移除該元素
                    } else { }//沒事，不想讓瀏覽器跳錯誤而已
                })
                break;
        }
    }


    //轉轉箱子功能鈕
    //缺陷:style.transform是抓 css inline style的值，所以必須給箱子inline style的初始值 
    function boxRotate(e) {
        console.log(`this.id: ${this.id}`);
        switch (this.id) {
            case "btn_front":
                boxBases.forEach(element => {
                    element.style.transform = "rotateX(0deg) rotateY(0deg) rotateZ(0deg)";
                });
                break;
            case "btn_back":
                boxBases.forEach(element => {
                    element.style.transform = "rotateX(0deg) rotateY(180deg) rotateZ(0deg)";
                });
                break;
            case "btn_top":
                boxBases.forEach(element => {
                    element.style.transform = "rotateX(-90deg) rotateY(0deg) rotateZ(0deg)";
                });
                break;
            case "btn_bottom":
                boxBases.forEach(element => {
                    element.style.transform = "rotateX(90deg) rotateY(0deg) rotateZ(0deg)";
                });
                break;
            case "btn_left":
                boxBases.forEach(element => {
                    element.style.transform = "rotateX(0deg) rotateY(90deg) rotateZ(0deg)";
                });
                break;
            case "btn_right":
                boxBases.forEach(element => {
                    element.style.transform = "rotateX(0deg) rotateY(-90deg) rotateZ(0deg)";
                });
                break;
            case "rotateX":
                boxBases.forEach(element => {
                    console.log("element.style.transform:" + element.style.transform);
                    let arr = element.style.transform.split(" ");
                    console.log(`arr: ${arr}`);
                    let newAngelY = parseInt(arr[1].replace("rotateY(", "").replace("deg)", "")) +20;
                    arr[0] = "rotateX(" + "-30" + "deg)";
                    arr[1] = "rotateY(" + newAngelY + "deg)";                    
                    console.log(arr[1]);
                    element.style.transform = `${arr[0]} ${arr[1]} ${arr[2]}`;
                });
                break;
            case "rotateY":
                boxBases.forEach(element => {
                    // element.style.transform = "rotateX(0deg) rotateY(-90deg) rotateZ(0deg)";
                    console.log("element.style.transform:" + element.style.transform);
                    let arr = element.style.transform.split(" ");
                    console.log(`arr: ${arr}`);
                    let newAngelY = parseInt(arr[1].replace("rotateY(", "").replace("deg)", "")) + 10;
                    arr[1] = "rotateY(" + newAngelY + "deg)";
                    console.log(arr[1]);
                    element.style.transform = `${arr[0]} ${arr[1]} ${arr[2]}`;
                });
                break;
            case "rotateZ":
                boxBases.forEach(element => {
                    // element.style.transform = "rotateX(0deg) rotateY(-90deg) rotateZ(0deg)";
                    console.log("element.style.transform:" + element.style.transform);
                    let arr = element.style.transform.split(" ");
                    console.log(`arr: ${arr}`);
                    let newAngelZ = parseInt(arr[2].replace("rotateZ(", "").replace("deg)", "")) + 10;
                    arr[2] = "rotateZ(" + newAngelZ + "deg)";
                    console.log(arr[2]);
                    element.style.transform = `${arr[0]} ${arr[1]} ${arr[2]}`;
                });
                break;
            case "show":
                boxBases.forEach(element => {
                    element.style.transform = "rotateX(270deg) rotateY(180deg) rotateZ(0deg)";
                });
                
                break;
        }
    };
</script>
<script>
    $('.tab-1 a').on('click', function (e) {
    
    e.preventDefault();
    
    $(this).parent().addClass('active');
    $(this).parent().siblings().removeClass('active');
    
    target = $(this).attr('href');
    
    $('.tab-content-1 > div').not(target).hide();
    
    $(target).fadeIn(100);
    
    });
</script>
<script>
//卡片內分業選擇區
    $(document).ready(function () {
        $(".tab").click(function(e){
            e.preventDefault();   
    $(this).addClass("yellow");
    $(".tab").not(this).removeClass('yellow');	        
  });

    $('.content').hide().first(0).show().addClass('block');
    $('.tab-content-2 > li').click(function(e){
        var index = $(this).index(); 
        $('.content.block').removeClass('block').stop().fadeOut(function(){
            $('.content').eq(index).stop().fadeIn(100).addClass('block');
        });
    });
});
</script>
<!-- 卡片客製化 -->
<script>
        //商品區內分業選擇區
            $(document).ready(function () {
                $(".good").click(function(e){
                    e.preventDefault();   
            $(this).addClass("yellow");
            $(".good").not(this).removeClass('yellow');	        
          });
        
            $('.good-content').hide().first(0).show().addClass('active');
            $('.tab-content-3 > li').click(function(e){
                var index = $(this).index(); 
                $('.good-content.active').removeClass('active').stop().fadeOut(function(){
                    $('.good-content').eq(index).stop().fadeIn(100).addClass('active');
                });
            });
        });
        </script>
<script>
//卡片樣式的小圖換大圖
function showLarge(e){
  var small = e.target;
  var src = small.src.replace("small","big");
  document.getElementById("large").src = src;
}

function init(){
  //var imgs = document.querySelectorAll(".small");
  var imgs = document.getElementsByClassName("small");
  for( var i=0; i<imgs.length; i++){
  	imgs[i].onclick = showLarge;
  }
}

window.onload = init;
</script>
 <script>

        // window.event.cancelBubble=true;
        const btn7s = document.querySelectorAll(".btn7");
        const cardContent_7 = document.querySelector("#cardContent_7");

        //對按鈕們做監聽
        btn7s.forEach(elem => {
            elem.addEventListener("click", textCtrl);
        })

        //dragover解除初始設定
        cardContent_7.addEventListener("dragover", function cardDargOver(e) {
            e.preventDefault();
            //允許穿透
            $class("textTeam").forEach(el => {
                el.style.pointerEvents = "none";
            })
            $class("textResize").forEach(el => {
                el.style.pointerEvents = "none";
            })
            $class("ctrlPos").forEach(el => {
                el.style.pointerEvents = "none";
            })
            $class("textarea").forEach(el => {
                el.style.pointerEvents = "none";
            })
        })

        //監聽drop事件
        cardContent_7.addEventListener("drop", cardDropped);

        //對textTeam的dragStart抓取起始滑鼠相對物件的偏移量
        function cardDragStart(e) {
            e.dataTransfer.setData("offsetx", e.offsetX);
            e.dataTransfer.setData("offsety", e.offsetY);
            srcCard = this;

            console.log(`Drag Stat!!`);
            $class(".textTeam");
            console.log(`.textTeam.length: ${$class(".textTeam").length}`);

            //允許穿透
            $class(".textTeam").forEach(el => {
                el.style.pointerEvents = "none";
            })
            $class(".textResize").forEach(el => {
                el.style.pointerEvents = "none";
            })
            $class(".ctrlPos").forEach(el => {
                el.style.pointerEvents = "none";
            })
            $class(".textarea").forEach(el => {
                el.style.pointerEvents = "none";
            })
        }
        //對textTeam的dragend設定
        function cardDragEnd(e) {
            //允許穿透
            $class("textTeam").forEach(el => {
                el.style.pointerEvents = "auto";
            })
            $class("textResize").forEach(el => {
                el.style.pointerEvents = "auto";
            })
            $class("ctrlPos").forEach(el => {
                el.style.pointerEvents = "auto";
            })
            $class("textarea").forEach(el => {
                el.style.pointerEvents = "auto";
            })
        }



        //drop設定
        var CardDrop_count = 1;
        function cardDropped(e) {
            e.preventDefault();
            CardDrop_count += 1;
            //接收來自dragstart的座標訊息
            let mouseOffset = { x: 0, y: 0 };
            mouseOffset.x = e.dataTransfer.getData("offsetx");
            mouseOffset.y = e.dataTransfer.getData("offsety");
            //目的地位置偏移量
            mouseNow = { x: 0, y: 0 };
            mouseNow.x = e.offsetX;
            mouseNow.y = e.offsetY;
            //接收來自setData的資料，設定新座標
            srcCard.style.zIndex = CardDrop_count + 1;
            srcCard.style.top = parseInt(mouseNow.y - mouseOffset.y) + "px";
            srcCard.style.left = parseInt(mouseNow.x - mouseOffset.x) + "px";
        }

        function addDrag(e) {
            e.target.parentNode.setAttribute("draggable", true);
        }
        function removeDrag(e) {
            e.target.parentNode.setAttribute("draggable", false);
        }

        //textTeam監聽事件區
        function textTeamShow(e) {
            e.target.classList.add("show");
        }
        function textTeamHide(e) {
            e.target.classList.remove("show");
        }
        function textTeamSelect(e) {
            e.target.classList.add("select");
        }

        //textarea監聽事件區
        function textareaBlur(e) {

        }
        function textareaSelect(e) {
            $class("textTeam").forEach(el => {
                el.classList.remove("select");
            })
            $class("textarea").forEach(el => {
                el.classList.remove("select");
            })
            console.log(e.target.parentNode);
            e.target.parentNode.classList.add("select");
            e.target.classList.add("select");
        }


        function textCtrl(e) {
            switch (this.id) {
                case "btn7_add":
                    addTextTeam();
                    break;
                case "btn7_big":
                    // fontSizeBig();
                    $class("textarea").forEach(el=>{
                        if(el.classList.contains("select")){
                            console.log(el.style.fontSize);
                            let value= el.style.fontSize.replace("px","");
                            value= parseInt(value)+3;
                            if(value>60){value=60;}
                            console.log(value);
                            el.style.fontSize = value + "px";
                        }
                    })
                    break;
                case "btn7_small":
                    $class("textarea").forEach(el => {
                        if (el.classList.contains("select")) {
                            console.log(el.style.fontSize);
                            let value = el.style.fontSize.replace("px", "");
                            value = parseInt(value) - 3;
                            if(value<12){value=12;}
                            console.log(value);
                            el.style.fontSize = value + "px";
                        }
                    })
                    break;
                case "btn7_clk":
                    $class("textTeam").forEach(el => {
                        if (el.classList.contains("select")) {
                            console.log(el.style.transform);
                            let value = el.style.transform.replace("rotate(", "").replace("deg)","");
                            value = parseInt(value) + 10;
                            console.log(value);
                            el.style.transform = "rotate("+ value + "deg)";
                        }
                    })
                    break;
                case "btn7_unclk":
                    $class("textTeam").forEach(el => {
                        if (el.classList.contains("select")) {
                            console.log(el.style.transform);
                            let value = el.style.transform.replace("rotate(", "").replace("deg)", "");
                            value = parseInt(value) - 10;
                            console.log(value);
                            el.style.transform = "rotate(" + value + "deg)";
                        }
                    })
                    break;
                case "btn7_del":
                    console.log(`Del start`);
                    var textTeam = document.getElementsByClassName("textTeam");
                    var len = textTeam.length;
                    console.log(`len: ${len}`);
                    for (let i = 0; i < len; i++) {
                        if (textTeam[i].classList.contains("select")) {
                            console.log(`Del target is : ${textTeam[i]}`);
                            cardContent_7.removeChild(textTeam[i]);
                            console.log(`Del Done`);
                        } else { }
                    }
                    break;
            }
        }


        //建立文字框框一整組
        function addTextTeam() {
            //建立可以輸入文字的框框
            var textarea = document.createElement('div');
            // var textarea = document.createElement('textarea');
            textarea.classList.add("textarea");
            //設定這個div可以被輸入文字
            textarea.setAttribute("contenteditable", true);
            //設定placholder並利用css裡的偽元素brfore顯示內容
            textarea.setAttribute("placeholder", "點擊輸入文字");
            //關閉拼字檢查，避免瀏覽器一直檢查提醒錯誤，破壞卡片版面
            textarea.setAttribute("spellcheck", false);
            //新增監聽事件
            textarea.onblur = textareaBlur;//功能待確認
            textarea.onclick = textareaSelect;//當textarea被點擊，textTeam要被選擇。textarea也要被選擇，方便後續字體相關操作。
            ////當點擊area時textTeam要被選取
            ////當 "area不是focus" 且 "卡片或section被點擊時" 解除 textTeam.select
            //設定初始樣式
            textarea.style.fontSize = "20px";
            


            //建立可以被拖曳的區域
            var ctrlPos = document.createElement("div");
            ctrlPos.classList.add("ctrlPos");
            //新增監聽事件
            ctrlPos.onmouseover = addDrag; //當滑鼠在ctrlPos區域時，整個textteam允許被拖曳
            ctrlPos.onmouseleave = removeDrag; //當滑鼠離開ctrlPos區域時，整個textteam取消拖曳事件

            //建立用來遮醜的小標籤
            //不用偽元素是因為不知道怎麼動態生成偽元素
            //(也很難控制吧!!!)
            var textResize = document.createElement("div");
            textResize.classList.add("textResize");

            //建立一個打包的父層
            //也負責被縮放，resize已經寫在css裡-----resize先關閉功能
            var textTeam = document.createElement("div");
            textTeam.classList.add("textTeam");
            //新增監聽事件
            textTeam.ondragstart = cardDragStart; //允許時，拖曳事件造成位移效果
            textTeam.ondragend = cardDragEnd;

            //設定初始樣式
            textTeam.style.transform="rotate(0deg)"; //只先給旋轉....如果有樣式相關的功能新增，記得重寫 rotate 按鈕事件

            //塞小孩，依照結構塞好
            //不過ctrlPos 和 textResize 都有絕對定位一頭一尾
            //所以大概沒差吧
            textTeam.appendChild(ctrlPos);
            textTeam.appendChild(textarea);
            textTeam.appendChild(textResize);
            cardContent_7.appendChild(textTeam);
        }

        function $id(id) {//找id，動態
            return document.getElementById(id);
        }
        function $class(className) {//找className並轉成陣列，動態
            let classNames = document.getElementsByClassName(className);
            return Array.from(classNames);
        }
        function $qall(qall) {//query all，靜態
            let qalls = document.querySelectorAll(qall);
            return Array.from(qalls);
        }
        function $q(q) {//query，靜態
            return document.querySelector(q);
        }

        function windowClick(e) {
            window.addEventListener("click", function (e) {
                console.log(e.target);
                console.log(this);
                //console.log(`$(this): ${$(this)}`); //jq
            })
        }
    </script>
<!-- record -->
<script>
        //ipad mini，chrome沒支援，還不說沒支援!!!等等。可能是getUserMedia過了但是後面有地方掛掉...
        //可以操作，但是沒有反應。照理講...手機沒過localhost應該不能動啊，問號!!!

        //確認瀏覽器有沒有支援影音功能
        //聲音容器
        window.AudioContext = window.AudioContext || window.webkitAudioContext;
        //影音介面(?)應該是這種感覺
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia;
        //navigator.getUserMedia(constraints, successCallback, errorCallback);
        //constraints 可以設定 audio 或 video 的 true 或 false，聲音/影像各自的 開/關
        //successCallback代表getUserMedia成功時，要做的事情
        //errorCallback代表getUserMedia失敗時，要做的事情

        //使用recorder.js(使用此套件解決好像很多麻煩的事情)
        //建立錄音器
        var recorder;
        //抓存放播放條 跟 下載連結的容器
        var audioItems = document.getElementById("audioItems");
        //錄音按鈕
        var recordBtn = document.getElementById("recordBtn");
        //計時器
        var timer;
        //Web Audio API起手式：建一個聲音容器的物件
        var context = new AudioContext();
        //偷看一下設備能取得的採樣率
        console.log(context.sampleRate)
        // navigator.getUserMedia({ audio: true }, function (stream) {
        //據說是比樓上更新版的介面，注意是用.then().catch()串接
        navigator.mediaDevices.getUserMedia({ audio: true }).then(function (stream) {
            //建一個麥克風變數，代表我要接收的姻緣(X)因緣(X)...音源(O)
            var mic = context.createMediaStreamSource(stream);

            //按鈕觸發。
            //若沒標籤，則添加標籤，開始錄音
            //若有標籤，則移除標籤，停止錄音
            recordBtn.onclick = function (e) {
                if (e.target.classList.contains("recording") == true || e.target.parentNode.classList.contains("recording") == true) {
                    clearTimeout(timer);
                    //按鈕變身，變樣式
                    if (e.target.id != "recordBtn") {
                        e.target.parentNode.classList.remove("recording");
                    } else {
                        e.target.classList.remove("recording");
                    }
                    //停止錄音
                    recorder.stop();
                    //建立可被下載的物件
                    createDownloadLink();
                    //清空錄音器
                    recorder.clean;
                } else {
                    //建立錄音物件，把mic串進來
                    recorder = new Recorder(mic);
                    //利用recorder.js開始錄音
                    recorder.record();
                    //按鈕變身，變樣式
                    if (e.target.id != "recordBtn") {
                        e.target.parentNode.classList.add("recording");
                    } else {
                        e.target.classList.add("recording");
                    }

                    //恢復正常效果
                    $id("au_btns").style.opacity = 1;
                    $id("defBar").style.opacity = 1;
                    $id("au_time").style.opacity = 1;

                    //播放器應該不可以撥放
                    auStop();
                }
            }

            //建立可以被下載的連結，之後要做上傳 
            function createDownloadLink() {
                recorder.exportWAV(function (blob) {
                    //建立一個可以被下載(上傳?)的物件包，之後觀察看要怎麼上傳
                    var url = URL.createObjectURL(blob);

                    //改audio撥放器的src路徑，audio會活過來然後可以撥放
                    $id("au_player").src = url;

                });
            }
        }).catch(function (error) {
            //抓不到錄音裝置、不給權限、http檔下來等等，心好累
            //我就大喊是你的問題(絕對不可以啊!!!我們要好好幫客戶解決問題!!!)
            //◢▆▅▄▃ 崩╰(〒皿〒)╯潰 ▃▄▅▆◣
            console.log('error:' + error);
            audioMsg.innerText = "你的裝置不支援錄音呦 Q口Q";
        });


        function auPlayAndPause(e) {
            if (!$id("au_player").paused && !$id("au_player").ended) {
                //撥放中被觸發
                //暫停撥放
                $id("au_player").pause();
                //刪個狀態，改變color
                $id("au_btn_play").classList.remove("select");
                //切換icon成撥放符號
                $id("au_btn_play").innerHTML = "<i class='fas fa-play'></i>";
            } else {
                //停止或暫停時被觸發
                $id("au_player").play();
                //加個狀態，改變color
                $id("au_btn_play").classList.add("select");
                //切換icon成暫停符號
                $id("au_btn_play").innerHTML = "<i class='fas fa-pause'></i>";
                //持續作用直到撥放結束
                setInterval(() => {
                    if (!$id("au_player").ended) {
                        //撥放中
                        //換算進度條應該要佔多少
                        barSize = parseInt(window.getComputedStyle($id("defBar")).width);
                        var size = barSize / $id("au_player").duration * $id("au_player").currentTime;
                        //設定bar跟拉桿的位置
                        $id("proBar").style.width = size + 'px';
                        $id("barNote").style.left = size + "px";
                    } else {
                        //播到結束的瞬間
                        //bar、拉桿及撥放時序歸零
                        $id("proBar").style.width = '0px';
                        $id("barNote").style.left = "0px";
                        $id("au_player").currentTime = 0;
                        $id("au_btn_play").classList.remove("select");
                        //換回撥放鈕
                        $id("au_btn_play").innerHTML = "<i class='fas fa-play'></i>";
                    }
                }, 100);
            }
        }

        //停止撥放
        function auStop(e) {
            //暫停
            $id("au_player").pause();
            // $id("au_btn_play").innerText = "播";
            $id("au_btn_play").classList.remove("select");
            ////bar、拉桿及撥放時序歸零
            $id("proBar").style.width = '0px';
            $id("barNote").style.left = "0%";
            $id("au_player").currentTime = 0;
            //換回撥放鈕
            $id("au_btn_play").innerHTML = "<i class='fas fa-play'></i>";
        }

        //靜音鈕
        function auMute(e) {
            //如果是靜音
            if ($id("au_player").muted == true) {
                // 那我就不靜音
                $id("au_player").muted = false;
                $id("au_btn_vol").innerHTML = "<i class='fas fa-volume-up'></i>";
            } else {
                //如果不是靜音
                //那我就靜音
                $id("au_player").muted = true;
                $id("au_btn_vol").innerHTML = "<i class='fas fa-volume-mute'></i>";
            }
        }

        //音量點擊控制
        function auVol(e) {
            var mouseX = e.clientX - $id("volBar").offsetLeft;
            $id("vol_proBar").style.width = mouseX + "px";
            $id("vol_barNote").style.left = mouseX + "px";

            barSize = parseInt(window.getComputedStyle($id("volBar")).width);
            var newVol = mouseX / barSize;
            console.log(`newVol: ${newVol}`);
            $id("au_player").volume = newVol;
        }

        //進度條點擊控制
        function auJumpTo(e) {
            var mouseX = e.clientX - $id("defBar").offsetLeft;
            $id("proBar").style.width = mouseX + "px";
            $id("barNote").style.left = mouseX + "px";

            barSize = parseInt(window.getComputedStyle($id("defBar")).width);
            var newTime = mouseX / (barSize / $id("au_player").duration);
            $id("au_player").currentTime = newTime;
        }

        //讀完檔案把總長度塞進標籤裡
        function auUpdateTimeAll(e) {
            // console.log($id("au_player").duration);
            $id("au_timeAll").innerText = formatTime($id("au_player").duration);
        }

        //把正在撥放的時間更新到標籤裡
        function auUpdateTimeNow(e) {
            console.log($id("au_player").currentTime);
            $id("au_timeNow").innerText = formatTime($id("au_player").currentTime);
        }



        //刪除錄音....的src，這樣使用者就失去檔案惹
        function removeAudioSrc(e) {
            $id("au_player").src = "";
            //上個半透效果`,表示沒作用
            $id("au_btns").style.opacity = 0.5;
            $id("defBar").style.opacity = 0.5;
            $id("au_time").style.opacity = 0.5;
        }

        //移除事件監聽時傳入的參數 要等於 添加事件監聽時傳入的參數
        //不然mousemove會一直跑!!!!!
        function dragStartBarNote(e) {
            //避免拖曳途中選到東西然後莫名無法 mouseup
            var body = document.getElementsByTagName("body");
            console.log(body[0]);
            body[0].style.userSelect = "none";
            //----------------------必定要確認mouseup後還原此屬性

            console.log(e.target);
            //滑鼠滑動的時候分三個部分討論：
            //1. 超過進度條的最左側: 那就進度條歸零 //鄧不利少
            //2. 超過進度條的最右側: 那就進度條百分百 //鄧不利多
            //3. 在進度條中間: 依照滑鼠的x位置決定進度條的長度 //鄧不利剛剛好
            window.addEventListener("mousemove", dragBarNote);

            //左鍵放開時，恢復body可選狀態，解除mousemove監聽，解除mouseup監聽
            window.addEventListener("mouseup", dragEndBarNote);
        }

        function dragStartVolBarNote(e) {
            //避免拖曳途中選到東西然後莫名無法 mouseup
            var body = document.getElementsByTagName("body");
            console.log(body[0]);
            body[0].style.userSelect = "none";
            //----------------------必定要確認mouseup後還原此屬性

            console.log(e.target);
            //滑鼠滑動的時候分三個部分討論：
            //1. 超過進度條的最左側: 那就音量條歸零 //鄧不利少
            //2. 超過進度條的最右側: 那就音量條百分百 //鄧不利多
            //3. 在進度條中間: 依照滑鼠的x位置決定音量條的長度 //鄧不利剛剛好
            window.addEventListener("mousemove", dragVolBarNote);

            //左鍵放開時，恢復body可選狀態，解除mousemove監聽，解除mouseup監聽
            window.addEventListener("mouseup", dragEndVolBarNote);
        }


        //進度條拖曳--------------------------------------開始
        function dragEndBarNote(e) {
            var body = document.getElementsByTagName("body");
            body[0].style.userSelect = "auto";
            console.log("mouse UP UP UP");
            window.removeEventListener("mousemove", dragBarNote);
            console.log("remove EVENT mouse move !!");
            //結束後聲音恢復
            $id("au_player").muted = false;
            window.removeEventListener("mouseup", dragEndBarNote);
        }

        function dragBarNote(e2) {
            //拖曳時聲音mute掉
            $id("au_player").muted = true;
            //抓進度條長度
            var barSize = parseInt(window.getComputedStyle($id("defBar")).width);
            var minX = $id("defBar").offsetLeft; //進度條最左側離視窗距離
            console.log(`minX: ${minX}`);
            var maxX = minX + barSize; //進度條最右側離視窗距離
            console.log(`maxX: ${maxX}`);
            console.log(e2.target);
            console.log("moving~~");
            var x2 = e2.clientX; //移動中的x
            var y2 = e2.clientY; //移動中的y
            if (x2 <= minX) {//1. 超過進度條的最左側: 那就進度條歸零 //鄧不利少
                //記得要把x2=minX的情況考慮進去
                console.log("太小啦!!!");
                $id("proBar").style.width = '0px';
                $id("barNote").style.left = "0%";
                $id("au_player").currentTime = 0;
            } else if (x2 >= maxX) {//2. 超過進度條的最右側: 那就進度條百分百 //鄧不利多
                //記得要把x2=maxX的情況考慮進去
                console.log("太大啦!!!!!!");
                $id("proBar").style.width = barSize + "px";
                $id("barNote").style.left = barSize + "px";
                $id("au_player").currentTime = $id("au_player").duration;
            } else {//3. 在進度條中間: 依照滑鼠的x位置決定進度條的長度 //鄧不利剛剛好
                console.log("剛剛好!!!!");
                var mouseX = x2 - $id("defBar").offsetLeft;
                $id("proBar").style.width = mouseX + "px";
                $id("barNote").style.left = mouseX + "px";

                barSize = parseInt(window.getComputedStyle($id("defBar")).width);
                var newTime = mouseX / (barSize / $id("au_player").duration);
                $id("au_player").currentTime = newTime;
            }
        }
        //進度條拖曳--------------------------------------結束





        //音量拖曳---------------------------------開始
        function dragEndVolBarNote(e) {
            //還原body跟所有子元素下可選狀態
            var body = document.getElementsByTagName("body");
            body[0].style.userSelect = "auto";
            console.log("mouse UP UP UP");
            window.removeEventListener("mousemove", dragVolBarNote);
            console.log("remove EVENT mouse move !!");
            window.removeEventListener("mouseup", dragEndVolBarNote);
        }

        function dragVolBarNote(e2) {
            var barSize = parseInt(window.getComputedStyle($id("volBar")).width);
            var minX = $id("volBar").offsetLeft; //音量條最左側離視窗距離
            console.log(`minX: ${minX}`);
            var maxX = minX + barSize; //音量條最右側離視窗距離
            console.log(`maxX: ${maxX}`);
            console.log(e2.target);
            console.log("moving~~");
            var x2 = e2.clientX; //移動中的x
            var y2 = e2.clientY; //移動中的y
            if (x2 <= minX) {//1. 超過音量條的最左側: 那就音量條歸零 //鄧不利少
                //記得要把x2=minX的情況考慮進去
                console.log("太小啦!!!");
                $id("vol_proBar").style.width = '0px';
                $id("vol_barNote").style.left = "0%";
                $id("au_player").volume = 0;
            } else if (x2 >= maxX) {//2. 超過音量條的最右側: 那就音量條百分百 //鄧不利多
                //記得要把x2=maxX的情況考慮進去
                console.log("太大啦!!!!!!");
                $id("vol_proBar").style.width = barSize + "px";
                $id("vol_barNote").style.left = barSize + "px";
                $id("au_player").volume = 1;
            } else {//3. 在進度條中間: 依照滑鼠的x位置決定音量條的長度 //鄧不利剛剛好
                console.log("剛剛好!!!!");
                var mouseX = x2 - $id("volBar").offsetLeft;
                $id("vol_proBar").style.width = mouseX + "px";
                $id("vol_barNote").style.left = mouseX + "px";

                barSize = parseInt(window.getComputedStyle($id("volBar")).width);
                var newVol = mouseX / barSize;
                $id("au_player").volume = newVol;
            }
        }
        //音量拖曳---------------------------------結束

        // console.log(`$id("au_player").src: ${$id("au_player").src}`);

        // 撥放/暫停
        $id("au_btn_play").addEventListener("click", auPlayAndPause);
        // 停止
        $id("au_btn_stop").addEventListener("click", auStop);
        // 靜音
        $id("au_btn_vol").addEventListener("click", auMute);
        // 進度條點擊跳轉
        $id("defBar").addEventListener("click", auJumpTo);
        // 音量點擊跳轉
        $id("volBar").addEventListener("click", auVol);
        // 撥放結束相關事宜
        $id("au_player").addEventListener("ended", auStop);
        // 緩衝完成可以撥放時相關事宜, ex:提供總長度等數據
        $id("au_player").addEventListener("canplaythrough", auUpdateTimeAll);
        // 更新當前秒數
        $id("au_player").addEventListener("timeupdate", auUpdateTimeNow);
        //拖曳進度條拉桿
        $id("barNote").addEventListener("mousedown", dragStartBarNote);
        //拖曳音量拉桿
        $id("vol_barNote").addEventListener("mousedown", dragStartVolBarNote);
        //移除音源
        $id("audioDel").addEventListener("click", removeAudioSrc);

        //load進來第一次讀值沒東西就提示使用者無法操作那些功能
        if (($id("au_player").src == "") || ($id("au_player").id == undefined) || ($id("au_player").id == null)) {
            //上個半透效果,表示沒作用
            $id("au_btns").style.opacity = 0.5;
            $id("defBar").style.opacity = 0.5;
            $id("au_time").style.opacity = 0.5;
        }
    </script>
    <script>
function doFirst(){
	document.getElementById('theFile').onchange = fileChange;
}
function fileChange(){
	var file = document.getElementById('theFile').files[0];
	var message = '';

	message += 'File Name: '+file.name+'\n';
	message += 'File Type: '+file.type+'\n';
	message += 'File Size: '+file.size+' byte(s)\n';
	message += 'Last Modified: '+file.lastModifiedDate+'\n';

	document.getElementById('fileInfo').value = message;
//===================

	var readFile = new FileReader();
	readFile.readAsDataURL(file);
	readFile.addEventListener('load',function(){
		var image = document.getElementById('image');
		image.src = readFile.result;
		image.style.maxWidth = '400px';
		image.style.maxHeight = '300px';
	});

}
window.addEventListener('load',doFirst);

</script>
</body>
</html>