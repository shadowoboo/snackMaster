<?php
$errMsg = "";
try {
    require_once("connectcd105g2.php");
    // $sql = "select * from snack";
    //  $snack = $pdo->query($sql);
    //  $snackRows = $snack -> fetchAll(PDO::FETCH_ASSOC);
    //  var_dump($snackRows);exit();
} catch (PDOException $e) {
    $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
    $errMsg .= "行號 : ".$e -> getLine()."<br>";
    exit($errMsg);
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
    <script src="../js/search.js"></script>
   <script src="../js/jquery-3.3.1.min.js"></script>
   <!-- <script src="../js/shadowLib.js"></script> -->
   <!-- 錄音外掛。我想我跳下去玩一定會來不及。謝謝你 9527 -->
   <!-- <script src="../js/recorder.js"></script> -->
   <script src="../js/common.js"></script>
   <script src="../js/findingIp.js"></script>
   <script src="../js/alert.js"></script>
   <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</head>

<body>


    <img class="coco01" src="../images/customized/coco01.png" alt="">
    <img class="coco02" src="../images/customized/coco02.png" alt="">
    <?php 
    require_once("header.php")
    ?>
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
                            <div class="circle" style="background:#aedcd3;" id="cartgogo"></div>
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
                            <!-- <label for="cutImg">
                                <div class="btn btn_front dimension"  id="btn_front">前
                                <input type="button" id="cutImg" style="display:none;">
                                </div>
                            </label> -->
                            <div class="btn btn_front dimension"  id="btn_front">前</div>
                            <div class="btn btn_back dimension"  id="btn_back">後</div>
                            <div class="btn btn_top dimension"  id="btn_top">上</div>
                            <div class="btn btn_left dimension"  id="btn_left">左</div>
                            <div class="btn btn_right dimension"  id="btn_right">右</div>
                            <div class="btn rotateX dimension"  id="rotateX">轉</div>
                              <!-- <div class="btn rotateY" id="rotateY">Y軸轉轉</div>-->
                            <!-- <div class="btn rotateZ dimension" id="rotateZ">轉</div>  -->
                        </div>
                        <div class="showBox">
                                <div class="camera">
                                    <div class="box boxBase" id="box_15">
                                        <div class="surface surface_top" id="cover_out_15">
                                          
                                        </div>
                                        <!-- <div class="surface surface_top_inner" id="cover_in_15">
                                        </div> -->
                                        <div class="surface surface_down" id="cover_down">
    
                                        </div>
                                        <div class="surface surface_back" id="cover_back"></div>
                                        <div class="surface surface_front" id="cover_front">
                                       
                                        </div>
                                        <div class="surface surface_left" id="cover_left">
                                       
                                        </div>
                                        <div class="surface surface_right" id="cover_right">
                                       
                                        </div>
                                    </div>
                                </div>
            
                                <div id="btns15">
                                    <div class="btn" id="btn_big"><img src="../images/customized/zoom_in.png" alt=""></div>
                                    <div class="btn" id="btn_small"><img src="../images/customized/zoom_out.png" alt=""></div>
                                    <div class="btn" id="btn_clk"><img src="../images/customized/rotate.png" alt=""></div>
                                    <div class="btn" id="btn_clk_r"><img src="../images/customized/rotate_r.png" alt=""></div>
                                    <div class="btn" id="btn_del"><i class="fa fa-trash"></i></div>
                                </div>                                                       
                        </div>
                    </div>  
                <div class="formBody">
                    <div class="form">
                        <ul class="tab-group-1">
                            <li class="tab-1 active"><a href="#colorBtn">顏色</a></li>
                            <li class="tab-1"><a href="#picBtn">圖片</a></li>
                        </ul>
                        <div class="tab-content-1">
                            <div id="colorBtn">   
                                <div class="top-row">
<?php
    $errMsg = "";
        try {
            require_once("connectcd105g2.php");
            $sql = "select * from material ORDER BY materialNo limit 10,17";
            $material = $pdo->query($sql);
        } catch (PDOException $e){
            $errMsg .= "錯誤 :".$e -> getMessage()."<br>";
            $errMsg .= "行號 :".$e -> getLine()."<br>";
        }
?>                            
 <div class="pickColor">
<?php
  while( $mateRow = $material -> fetch() ){
?>                                                                         
            <div class="colorBtn" style="background-color:<?php echo $mateRow['materialPath']?>;"></div>
<?php
    }
?>     
    </div>                               
        </div>
    </div>
                        
    <div id="picBtn">   
        <div class="pics" id="picsRegion">
<?php
    $errMsg = "";
        try {
            require_once("connectcd105g2.php");
            $sql = "select * from material ORDER BY materialNo limit 0,7";
            $material = $pdo->query($sql);
        } catch (PDOException $e){
            $errMsg .= "錯誤 :".$e -> getMessage()."<br>";
            $errMsg .= "行號 :".$e -> getLine()."<br>";
        }
?>                            
<?php
  while( $mateRow = $material -> fetch() ){
?>                                          
                                    <div class="pic">
                                        <img class="cusPic" src="<?php echo $mateRow['materialPath']?>" alt="">
                                    </div>

<?php
    }
?>
                                     <div class="pic">
                                        <img class="cusPic" id="image" style="width:53px;">
                                    </div>
                                    <div class="upfile">
                                        <span>上傳圖片:</span>
                                        <label for="theFile">
                                            <input type="file" id="theFile" style="display:none">                                             
                                            <p>選取檔案(png/jpg)</p>
                                            <!-- <p>8M內，jpg、png之圖檔。</p> -->
                                        </label>
                                    </div>
                                </div>                                                                                           
                                <p>
                                    <textarea id="fileInfo" rows="5" cols="70" style="display:none;"></textarea>
                                </p>
                            </div>
                        </div><!-- tab-content -->
                        <div class="btn show action" id="boxSureBtn" style="margin:47px auto 15px;line-height: 35px;">編輯完成</div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
      <!-- <script>
                var bbb = document.getElementClassName("bbb");
                for(var i = 0;i<bbb.length;i++){
                    doccument.getElementClassName("bbb")[i].addEventListener("click",bbb);
                    function bbb (e){
                        console.log(e.target);
                    }
                }
             </script>                    -->
      <div id="step2" class="step-content-body done">
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
 <?php
    $errMsg = "";
        try {
            require_once("connectcd105g2.php");
            $sql = "select * from material ORDER BY materialNo limit 18,19";
            $material = $pdo->query($sql);
        } catch (PDOException $e){
            $errMsg .= "錯誤 :".$e -> getMessage()."<br>";
            $errMsg .= "行號 :".$e -> getLine()."<br>";
        }
?>                            
<?php
  while( $mateRow = $material -> fetch() ){
?>                      
                <div class="section section_15" id="section_15" style="flex-wrap:wrap;">
                    <div class="lefCard" style="flex:2;">
                            <div class="cardBox">
                                    <img  id="large" src="<?php echo $mateRow['materialPath']?>" alt="">
                                </div>  
                            </div>
<?php
}
?>                            
                <div class="cardBody">
                    <div class="pickCard">
                            <ul class="tab-content-2">
                                <li class="tab yellow">文字</li>
                                <li class="tab">音效</li>
                            </ul>
                            <div class="content">
                                <div class="cardText"> 
                                    <div class="btn7 action" id="btn7_add" style="line-height:35px; margin:25px;">新增文字</div>                          
                                    <div id="btns7">
                                            <div class="btn7" id="btn7_big"><img src="../images/customized/zoom_in.png" alt=""></div>
                                            <div class="btn7" id="btn7_small"><img src="../images/customized/zoom_out.png" alt=""></div>
                                            <div class="btn7" id="btn7_clk"><img src="../images/customized/rotate.png" alt=""></div>
                                            <div class="btn7" id="btn7_unclk"><img src="../images/customized/rotate_r.png" alt=""></div>
                                            <div class="btn7" id="btn7_del"><i class="fa fa-trash"></i></div>
                                    </div>     
                                    <div class="showCard">
                                        <div class="section_7 sectionCard" id="section_7">
                                            <div class="cardCamera" id="cardCamera_7">
                                                <div class="cardBase" id="cardBase_7">
                                                    <div class="cardBaseContent" id="cardBaseConten">
                                                        <!-- <div class="cardSurfaceInner cardContentInner_7" id="cardContentInner_7"></div> -->
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
                            <div class="content" style=" align-items:flex-end;">
                                <div class="showMusic">
                                    <div id="birthdayParty">
                                        <img class="cooker" src="../images/Level/level2.png" alt="">
                                    </div>
                                    <div id="loveU">
                                        <img class="lover" src="../images/Level/level3.png" alt="">
                                    </div>
                                    <div id="eatMax">
                                        <img class="lover" src="../images/Level/level4.png" alt="">
                                    </div>
                                    <div id="snackmaster">
                                        <img class="lover" src="../images/Level/level6.png" alt="">
                                    </div>
                                </div>
                                <button class="next soundStepBtn" id="stopLeft"><i class="fas fa-angle-left"></i></button>
                                <div class="container">
                                    <div style="display: inline-block;">
                                        <p id="sound01">生日快樂</p>
                                    <audio loop controls preload="auto" id="01">
                                        <source src="../images/customized/sounds/01.mp3" type="audio/ogg">
                                    </audio>
                                    </div>
                                    <div>
                                        <p id="sound02">大零食家</p>
                                    <audio loop controls preload="auto" id="02">
                                        <source src="../images/customized/sounds/02.mp3" type="audio/ogg">
                                    </audio>
                                    </div>
                                    <div>
                                        <p id="sound03">大吃特吃</p>
                                    <audio loop controls preload="auto" id="03">
                                        <source src="../images/customized/sounds/03.mp3" type="audio/ogg">
                                    </audio>
                                    </div>
                                    <div>
                                    <p id="sound04">告白神曲</p>
                                    <audio loop controls preload="auto" id="04">
                                        
                                        <source src="../images/customized/sounds/04.mp3" type="audio/ogg">
                                    </audio>
                                    </div>
                                </div>
                                
                                <button class="prev soundStepBtn" id="stopRight"><i class="fas fa-angle-right"></i></button>
                                <button class="action soundAdd" id="soundAdd" style="margin-bottom:40px;">新增音效</button>
                        <!-- <div class="cardRecord">
                           撥放介面實體 
                            <div id="audioItem">
                                   一開始不給src，待錄音有值會自動增加
                                    <audio id="au_player"></audio>
                                    撥放控制按鈕們 
                                    <div class="au_btns" id="au_btns">
                                         撥放與暫停 
                                        <button class="au_btn" id="au_btn_play"><i class="fas fa-play"></i></button>
                                         停止 
                                        <button class="au_btn" id="au_btn_stop"><i class="fas fa-stop"></i></button>
                                        靜音與否 
                                        <button class="au_btn" id="au_btn_vol"><i class="fas fa-volume-up"></i></button>
                                        <! 音量bar >
                                        <div class="volBar" id="volBar">
                                            <! 會伸縮的bar >
                                            <div class="vol_proBar" id="vol_proBar"></div>
                                            <! 拉桿 >
                                            <div class="vol_barNote" id="vol_barNote"></div>
                                        </div>
                                        <! 刪除 >
                                        <button id="audioDel" class="au_btn trash"><i class="far fa-trash-alt"></i></button>
                                    </div>
                            
                                    <! 進度條與時間提示 >
                                    <div class="au_ctrl">
                                        <! 這是進度條 >
                                        <div class="defBar" id="defBar">
                                            <! 伸縮bar >
                                            <div class="proBar" id="proBar"></div>
                                            <! 拉桿 >
                                            <div class="barNote" id="barNote"></div>
                                        </div>
                                        <! 時間提示組 >
                                        <div class="au_time" id="au_time">
                                            <! 當前時間 >
                                            <span class="au_timeNow" id="au_timeNow">00:00</span>
                                            <span>/</span>
                                            <! 總長 >
                                            <span class="au_timeAll" id="au_timeAll">00:00</span>
                                        </div>
                                    </div>
                            
                                    <! 錄音操作鈕 >
                                    <! 一下錄，一下不錄 >
                                    <div id="recordBtn" class="recordBtn"><i class="fas fa-microphone"></i></div>
                                </div>
                            </div> -->
                        </div>                    
                    </div>            
                    <div class="btn show action" id="cardSureBtn" style="line-height: 35px;margin:39px auto">編輯完成 </div> 
                </div>
                  </div> 
             </div>
         </div>
      </div>
      <div id="step3" class="step-content-body done">
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
                <form id="snackForm">
                    <input id="snackDataName" type="hidden" name="snackDataName" value="">
                </form>                      
                <div class="section section_15" id="section_15">
                    <div class="shopping">
                        <div class="goodBox">
                                <ul class="tab-content-3">
                                    <!-- <li class="good yellow">購物車</li>
                                    <li class="good">收藏</li> -->
                                    <li class="good yellow">巧克力</li>
                                    <li class="good">洋芋片</li>
                                    <li class="good">餅乾</li>
                                    <li class="good">糖果</li>
                                </ul>                   
            <?php
                $cusSnack=array("巧克力","洋芋片","餅乾","糖果");
                $ln=count($cusSnack);
                $arr_row=array();

                $i=0;
                for ($i=0; $i<$ln; $i++) {
                    // $sql = "select snackNo,snackName,snackPic,snackPrice from snack WHERE snackGenre= ? ORDER BY snackNo in('1','8');";
                    $sql = "select snackNo,snackName,snackPic,snackPrice from snack WHERE snackGenre= ? ORDER BY snackNo limit 0,8;";
                    $prodRow = $pdo->prepare($sql); //執行上面的指令傳回陣列
                    $prodRow -> bindValue(1, $cusSnack[$i]);
                    $prodRow -> execute(); ?>
                    <div class="good-content">
                        <?php
                             while ($row = $prodRow->fetch()) {
                                 //array_push($arr_row,$row); ?>
                            <div class="item">
                                <div class="name">           
                                        <img src="<?php echo $row['snackPic']; ?>" alt="">                                    
                                        <div class="price">
                                        <p  class="snackNo" style="display:none;"><?php echo $row['snackNo']; ?></p>                   
                                            <p class="snackName"><?php echo $row['snackName']; ?></p>
                                            <span>$<?php echo $row['snackPrice']; ?></span>
                                            <button class="addCart sendSnack cart" id="<?php echo "{$row['snackNo']}|{$row['snackPrice']}|1" ?>" >放入零食箱</button>                        
                                        </div>
                                    </div>
                                    
                            </div>
                        <?php
                             } ?> 
                    </div>
            <?php
                }
            ?>       

                </div> 
                </div>
                </div>
      </div>
      
      <script>
        $(document).ready(function(){
            // $(".sendSnack").bind("click",sendSnack);
            
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
            alertBox("錯誤");
            }else{
            // alert(`xhr.responseText: ${xhr.responseText}`);
            }
        }
        xhr.open("Post", "sessionSnack.php", true);
        var snackForm = new FormData( $id("snackForm"));
        xhr.send( snackForm ); 
        }

        //===設定sendSnack.onclick 事件處理程序是 sendForm
        // $id('sendSnack').onclick = sendSnack;
    </script>     
      <!-- <div id="stepLast" class="step-content-body out">Completed</div> -->
    </div>
    
  </div>
  <?php
        $sql = "select * from snack";
        $prodRow = $pdo->prepare($sql); //執行上面的指令傳回陣列
        $prodRow -> execute();
        $arr_row = $prodRow->fetchAll()   //陣列
?>
<?php
    //讓目標按鈕的 class 有 cart 使 js可以觸發後續動作
    //$arr_row[49] 代表 客製箱 (sql中第50個)
?>
  <div class="step-content-foot">
        <button type="button" class="stepC none" name="prev" id="btn1">上一步</button>
        <button type="button" class="stepC undo"  id="btn2" disabled="true">下一步</button>
        <button type="button" class="active none step cart" name="finish"  id="<?php echo "{$arr_row[49]['snackNo']}|{$arr_row[49]['snackPrice']}|1" ?>" data-cusBox="../images/blair/customized.png" data-cusCard="../images/customized/card.png" data-cusSound="test" >加入購物車</button>
  </div>

  <div class="img1"></div>
  <div class="img2"></div>
  <div class="img3"></div>
  <div class="img4"></div>
  <div class="img5"></div>
  <div class="img6"></div> 

  <form id="myForm">
    <input type="hidden" name="myImage" id="myImage">
    <input type="hidden" name="myCard" id="myCard">
  </form>  


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
  <!-- <script src="../js/customizedstep.js"></script> -->
  <script src="../js/header.js"></script>
   <!-- Draggable -->
  
   <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" defer></script>
   <script src="../js/jquery.ui.touch-punch.js"></script>

<script src="http://ajax.aspnetcdn.com/ajax/knockout/knockout-3.0.0.js "></script>
<script src="http://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<!-- <script src="../js/addCart.js" defer></script> -->
<script src="../js/cusAddCart.js" defer></script>
<script>
var steps = $(".step-content-body");

var i = 0;

$("#btn2").click(function(){
    var instance = $(this);
  if(i < steps.length) {
    console.log("btn2 - "+i); steps.eq(i).removeClass('active').addClass('done').next().addClass('active')
    i++;
  }
  if(i+1 < steps.length) {
    $("#btn1").removeClass('none');
  }

  if( i+2<steps.length) {
    $('button[name="finish"]').removeClass('none');
    i++;
    
console.log(i)
  }


  if (i == (steps.length - 1)) {
      instance.addClass('none');
      instance.siblings('button[name="finish"]').removeClass('none');
    }
console.log(i)

if(i == 1 && $("#cardSureBtn").hasClass("btnSelect")==false){
    $("#btn2").addClass('undo').attr('disabled',true);
}   

});





$("#btn1").click(function(){
  
  if(i <= steps.length && i > 0) {
    
    console.log("btn1 - "+i); steps.eq(i).removeClass('active').prev().addClass('active');
    i--;
    
  }

  if(i == 1){
    $("#btn2").removeClass('none');
  }


  if(i == 0){
    $(this).addClass('none');
  }

 $('button[name="finish"]').addClass('none');

    console.log(i)

    if(i == 0 && $("#boxSureBtn").hasClass("btnSelect")){
        $("#btn2").removeClass('undo').attr('disabled',false);
    }   
});
</script>

<script>
//前:50  後：49 上：48 左：51 右：52 
$( "#boxSureBtn" ).click(function() {
    $(this).css({"background-color":"rgb(204, 204, 204)","color": "rgb(170, 170, 170)"});
    $('#btn2').removeClass('undo').attr('disabled', false);
});    
$( "#cardSureBtn" ).click(function() {
    $(this).css({"background-color":"rgb(204, 204, 204)","color": "rgb(170, 170, 170)"});
    $('#btn2').removeClass('undo').attr('disabled', false);
});    



      $("#boxSureBtn").click(function() {
          alertBox('成功將客製箱加入囉～');
      html2canvas($(".leftBox")[0]).then(function(canvas) {
          var $div = $(".img1");
          $div.empty();
          $("<img />", { src: canvas.toDataURL("image/png") }).appendTo($div);
          //-------------------
            document.getElementById('myImage').value = canvas.toDataURL("image/png");
            var formData = new FormData(document.getElementById("myForm"));
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'canvas_load_save.php', true);
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                        if( xhr.status == 200 ){
                        // alert('Succesfully uploaded');
                            //把資料寫入data- 等待送出到購物車
                            var str=xhr.responseText;
                            console.log(`截圖成功回復: ${str}`);
                            var arr_str=str.split("//");
                            console.log(`截圖成功回復: ${arr_str}`);
                            //判斷回傳的是 有包含card還是box來決定是卡片還是盒子圖
                            //如果回傳的是盒子
                            if(arr_str.indexOf("box")!=-1){
                                console.log(`儲存的是box圖`);
                                console.log(`${str}`);
                                //寫入data-
                                let tar=$(".step-content-foot .step.cart");
                                tar.attr("data-cusbox", str);
                                $("#myImage").val("");
                            }
                        }else{
                        alertBox(xhr.status);
                        }
                }
            };
            formData.delete("myCard"); //銷毀其他欄位
            xhr.send(formData);  
          //-------------------
      });
    });


    $("#cardSureBtn").click(function() {
        alertBox('成功將客製卡片加入囉～');
        html2canvas($(".lefCard")[0]).then(function(canvas) {
            var $div = $(".img3");
            $div.empty();
            $("<img />", { src: canvas.toDataURL("image/png") }).appendTo($div);
            //-------------------
            document.getElementById('myCard').value = canvas.toDataURL("image/png");
            var formData = new FormData(document.getElementById("myForm")); //沒有同時送資料的話，用form會讓其他欄位多夾帶資料，記得銷毀
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'canvas_load_save.php', true);
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                        if( xhr.status == 200 ){
                        // alert('Succesfully uploaded'); 
                            //把資料寫入data- 等待送出到購物車
                            var str=xhr.responseText;
                            console.log(`截圖成功回復: ${str}`);
                            var arr_str=str.split("//");
                            console.log(`截圖成功回復: ${arr_str}`);
                            //如果回傳的是卡片
                            if(arr_str.indexOf("card")!=-1){
                                console.log(`儲存的是card圖`);
                                console.log(`${str}`);
                                //寫入data-
                                let tar=$(".step-content-foot .step.cart");
                                tar.attr("data-cuscard", str);
                                //銷毀
                                $("#myCard").val("");
                            }
                        }else{
                        alertBox(xhr.status);
                        }
                }
            };
            formData.delete("myImage");//銷毀其他欄位
            xhr.send(formData);  
          //-------------------
      });
    });
    

</script>


<script>
      var music01 = document.getElementById("01");
      var a1=false;
      var music02 = document.getElementById("02");
      var a2=false;
      var music03 = document.getElementById("03");
      var a3=false;
      var music04 = document.getElementById("04");
      var a4=false;
        
      var sound01  = document.getElementById("sound01");
      sound01.addEventListener("click",play01 );
      
      function play01(){
        if(a1){
            music01.pause()
        }else{
            music01.play()
        }
      }
        music01.onplaying = function() {
            a1 = true;
        };

        music01.onpause = function() {
            a1 = false;
        };

      var sound02  = document.getElementById("sound02");
      sound02.addEventListener("click",play02 );
     

      function play02(){
        if(a2){
            music02.pause()
        }else{
            music02.play()
        }
      }
        music02.onplaying = function() {
            a2 = true;
        };

        music02.onpause = function() {
            a2 = false;
        };



      var sound03  = document.getElementById("sound03");
      sound03.addEventListener("click",play03 );
        
      function play03(){
        if(a3){
            music03.pause()
        }else{
            music03.play()
        }
      }
        music03.onplaying = function() {
            a3 = true;
        };

        music03.onpause = function() {
            a3 = false;
        };

        
      var sound04  = document.getElementById("sound04");
      sound04.addEventListener("click",play04 );

            
      function play04(){
        if(a4){
            music04.pause()
        }else{
            music04.play()
        }
      }
        music04.onplaying = function() {
            a4 = true;
        };

        music04.onpause = function() {
            a4 = false;
        };
  
    
      btp=document.getElementById("birthdayParty")
      sound01.addEventListener("click",showMusic01 );
    function showMusic01(){
        btp.classList.toggle("showDisplay");
        snackmaster.classList.remove("showDisplay");
        eatMax.classList.remove("showDisplay");
        loveuu.classList.remove("showDisplay");
      }

 
     var loveuu=document.getElementById("loveU")
      sound04.addEventListener("click",showMusic04);
    function showMusic04(){
        loveuu.classList.toggle("showDisplay");
        snackmaster.classList.remove("showDisplay");
        eatMax.classList.remove("showDisplay");
        btp.classList.remove("showDisplay");
      }
      var eatMax=document.getElementById("eatMax")
      sound03.addEventListener("click",showMusic03);
    function showMusic03(){
        eatMax.classList.toggle("showDisplay");
        snackmaster.classList.remove("showDisplay");
        loveuu.classList.remove("showDisplay");
        btp.classList.remove("showDisplay");
      }
      var snackmaster=document.getElementById("snackmaster")
      sound02.addEventListener("click",showMusic02);
    function showMusic02(){
        snackmaster.classList.toggle("showDisplay");
        eatMax.classList.remove("showDisplay");
        loveuu.classList.remove("showDisplay");
        btp.classList.remove("showDisplay");
      }
    //   function showMusic01(){
    //     loveuu.classList.toogle("showDisplay");
    //   }



      

      
//leftBtn 左邊按鈕事件
      var stopMusicL = document.getElementById("stopLeft");
      stopMusicL.addEventListener("click",stopThis );
      function stopThis(e){
          console.log("123")
        music01.pause();
        music01.currentTime = 0; 
        music02.pause(); 
        music01.currentTime = 0; 
        music03.pause();
        music01.currentTime = 0;  
        music04.pause(); 
        music01.currentTime = 0; 
      }
      
      var stopMusicLeft = document.getElementById("stopLeft");
      stopMusicLeft.addEventListener("click",removeSM01 );
      function removeSM01(){
        snackmaster.classList.remove("showDisplay");
        eatMax.classList.remove("showDisplay");
        loveuu.classList.remove("showDisplay");
        btp.classList.remove("showDisplay");
      }



//leftBtn 左邊按鈕事件
      var stopMusicR = document.getElementById("stopRight");
      stopMusicR.addEventListener("click",stopThis );
      function stopThis(e){
          console.log("123")
        music01.pause();
        music01.currentTime = 0; 
        music02.pause(); 
        music01.currentTime = 0; 
        music03.pause();
        music01.currentTime = 0;  
        music04.pause(); 
        music01.currentTime = 0; 
      }
      var stopMusicRight = document.getElementById("stopRight");
      stopMusicRight.addEventListener("click",removeSM01 );
      function removeSM01(){
        snackmaster.classList.remove("showDisplay");
        eatMax.classList.remove("showDisplay");
        loveuu.classList.remove("showDisplay");
        btp.classList.remove("showDisplay");
      }

</script>
<script>
    var currentIndex = 0,
    items = $('.container div'),
    itemAmt = items.length;

    function cycleItems() {
    var item = $('.container div').eq(currentIndex);
    items.hide();
    item.css('display','inline-block');
    }

    var autoSlide = setInterval(function() {
    // currentIndex += 1;
    // if (currentIndex > itemAmt - 1) {
    //   currentIndex = 0;
    // }
    cycleItems();
    }, 3000);

    $('.next').click(function() {
    clearInterval(autoSlide);
    currentIndex += 1;
    if (currentIndex > itemAmt - 1) {
        currentIndex = 0;
    }
    cycleItems();
    });

    $('.prev').click(function() {
    clearInterval(autoSlide);
    currentIndex -= 1;
    if (currentIndex < 0) {
        currentIndex = itemAmt - 1;
    }
    cycleItems();
    });
</script>


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
                        // console.log("add btnSelect!!!");
                        btns.forEach(el => {
                                el.classList.remove("btnSelect");
                                console.log(el.id + "remove .btnSelect")
                        })
                        if (e.target.classList.contains("rotateZ") || e.target.classList.contains("rotateX") ||
                        e.target.classList.contains("rotateY")) return; //工程鈕跳過
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
                        //調暗
                        var edit = tarColor.replace("rgb","").replace("(","").replace(")","");
                        var newArr=[];
                        var per=0.6; //趴數，越小越暗
                        edit=edit.split(", ");
                        // console.log(`edit: ${edit}`);
                        edit.forEach(el => {
                            el=parseInt(el*per);
                            // console.log(`el= ${el}`);
                            newArr.push(el);
                        });
                        // console.log(`edit: ${edit}`);
                        // console.log(`newArr: ${newArr}`);
                        tarColor=`rgb(${newArr[0]},${newArr[1]},${newArr[2]})`;
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

    /// 盒子不在指定姿態時要移除監聽,雙重保險盒子姿勢
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
            if (e.target.classList.contains("droped_img") == true) {//contains一個droped_img使
                e.target.style.pointerEvents = "none";//pointerEvents穿透屬性 none指不到
            }//使用 classList 屬性是取得元素 Class 的一種便利方式
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
            console.log("mouseEnter");//監聽事件 滑鼠進來了選取圖片區

            //"箱子表面的圖片"的監聽事件
            arrDropedImg.forEach(elem => {
                elem.addEventListener("dragstart", function dragStart_2(e) {//拉動起始
                    e.target.classList.add("select");
                    console.log("這裡的圖片動起來!");
                    e.dataTransfer.setData("text", "onSurface");//dataTransfer.setData傳現在的座標
                    e.dataTransfer.setData("offsetx", e.offsetX);
                    e.dataTransfer.setData("offsety", e.offsetY);
                    srcItem = this;//沒有加var 是全域變數 任何時候都可以載他
                    console.log(`THIS ${this.nodeName}`);

                    // e.dataTransfer.setData("srcItem", this);
                })
                elem.addEventListener("dragend", function dragEnd_2(e) {
                    surface.forEach(elem => {
                        elem.style.opacity = "1";
                    })
                    //操作預先存起來的新元素陣列
                    arrDropedImg.forEach(elem => {
                        elem.style.pointerEvents = "auto";//取消穿透
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
            e.dataTransfer.setData("image/jpeg", e.target.src);//offste相對視窗定位
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
    drop_count = 1; //設為全域，讓手機板JQ可以使用
    console.log(`drop_count: ${drop_count}`);//drop_count計數處法第幾次drop事件 一觸發+1
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
            srcItem.classList.remove("select");
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
            var img = document.createElement('img');//塞圖片後給他初始值
            img.src = e.dataTransfer.getData('image/jpeg');
            img.style.width = '50px';
            img.style.position = "absolute";
            img.style.top = parseInt(mouseNow.y - mouseOffset.y) + "px";
            img.style.left = parseInt(mouseNow.x - mouseOffset.x) + "px";
            img.classList.add("droped_img");//添加droped_img 為了好控制 使用 classList 屬性是取得元素 Class 的一種便利方式
            img.style.zIndex = drop_count;//z-index會一直變大
            img.id = "a" + drop_count;//多個id名稱a1 a3 a5..

            // img.style.pointerEvents = "none"; //可以被穿透，讓後面的圖可以順利覆蓋
            img.style.transform = "translateX(0px) translateY(0px) rotate(0deg) scale(1)";
            console.log(`e.target.classList: ${e.target.classList}`);
            arrDropedImg.push(img);//做一個陣列把動態添加元素的資料先存起來，之後統一操作
            // console.log(`arrDropedImg[]: ${arrDropedImg}`);
            // console.log(`arrDropedImg.length: ${arrDropedImg.length}`);
            this.appendChild(img);//把圖片塞進去
            //恢復透明度
            e.target.style.opacity = "1";
        }
    }

    //JQ板拖曳事件 客製箱子與圖片 (含手機)
    $(function(){
        //點擊新增圖片到箱子表面
        $(".cusPic").off("click").on("click",copyToSurface);
        //新增工作面控制
        $("#section_15 #ctrl_bar .btn").on("click",function(e){
                $("#section_15 #ctrl_bar .btn").removeClass("working");
                if (e.target.id=="rotateX") {return;}
                $(e.target).addClass("working");
        })
        ////點擊空白處取消 drop_img 的 select
        $(".customized").on("click",function (e) {
            var elem = e.target;
            while (elem) { //循環判斷到節點，防止點到子元素   
                if (elem.classList && (elem.classList.contains("droped_img")||elem.classList.contains("btn"))) { //如果該元素有class且有某某class的話就不動作
                    return; //我就跳出
                }
                elem = elem.parentNode; //往上找找到最大的"不作用"的層
            }
            $('.droped_img').removeClass("select"); //沒被跳出就會走到這裡，可以隱藏跳窗
        })
        //點擊空白處取消 drop_img 的 select
        // let droped_img=document
        // $(".customized").not(".droped_img").on("click",function(e){
        //     $(".droped_img").removeClass("select");
        // })
        //點擊droped_img觸發的事情，委託給父元素
        // $(".surface").on("click",".droped_img",function(e){
        //         //如果拖曳中，不做事
        //         if ( $(this).is('.ui-draggable-dragging') ) {
        //             return;
        //         }
        //         //新增個class="seclect"
        //         $(e.target).addClass("select");
        // })
        function copyToSurface(e){
            // 如果不在工作面，就跳出，不做啦!!!!
            if($("#section_15 .btn.working").length<=0){
                return;
            }
            //抓現在是哪一面，工作面才工作

            var tarSurfaceId = $("#section_15 .btn.working").attr("id");
            tarSurfaceClass = tarSurfaceId.replace("btn","surface");

            //複製圖片,更新屬性,塞進目標父層
            var tarCusPic=$(e.target).clone();
            console.log(tarCusPic);
            tarCusPic.css({
                "width":"50px",
                "position":"absolute",
                "zIndex":drop_count,
                "transform":"translateX(0px) translateY(0px) rotate(0deg) scale(1)",
            });
            tarCusPic.attr("class","droped_img");
            tarCusPic.attr("id","a"+drop_count);
            //jq抓到的元素都是神奇陣列，補0避免意外
            arrDropedImg.push(tarCusPic[0]);//做一個陣列把動態添加元素的資料先存起來，之後統一操作
            console.log(arrDropedImg);
            //塞入指定父層
            $("."+tarSurfaceClass).append($(tarCusPic));
            //設定JQ拖曳事件
            tarCusPic.draggable({
                start: function(e) {
                    //拖曳開始時，zIndex等級++，確保在最上層
                    drop_count++;
                    $(e.target).css("zIndex",drop_count);
                    $(".droped_img").removeClass("select");
                    $(e.target).addClass("select"); //增加class，有被選到的感覺
                },
                drag: function(e) {
                },
                stop: function(e) { //結束拖曳
                    $(e.target).removeClass("select"); //移除class
                }
            })
            .on("touchend",function(e){ //手機touch事件轉變成click事件
                if ( $(this).is('.ui-draggable-dragging') ) {
                    return;
                }
                if(getIsTouch()){ //如果滑動距離太短，視為click。(針對安卓)
                    $(".droped_img").removeClass("select");
                    $(e.target).addClass("select");
                }
            })
            .on("click tap",function(e){ //串點擊事件
                //如果拖曳中，不做事
                if ( $(this).is('.ui-draggable-dragging') ) {
                    return;
                }
                $(".droped_img").removeClass("select");
                //新增個class="seclect"
                $(e.target).addClass("select");
            });
            
        }
    })
    //android在JQ dragable之後click失效的問題
    //JQ android touch太過靈敏蓋掉click的解決方案
    //偵測滑動距離，太短的不滑，讓他觸發click。
    var touchValue = {x:5,y:5,sx:0,sy:0,ex:0,ey:0}; //initialize the touch values
    window.addEventListener("touchstart",function(){
        var event=event || window.event;
        touchValue.sx = event.targetTouches[0].pageX;
        touchValue.sy = event.targetTouches[0].pageY;
        touchValue.ex = touchValue.sx;
        touchValue.ey = touchValue.sy;
    });
    window.addEventListener("touchmove", function(event){
        var event=event || window.event;
        event.preventDefault();
        touchValue.ex = event.targetTouches[0].pageX;
        touchValue.ey = event.targetTouches[0].pageY;
    });
    window.addEventListener("touchend", function(event){
        var event=event || window.event;
        var changeX = touchValue.ex - touchValue.sx;
        var changeY = touchValue.ey - touchValue.sy;
        //console.log("X:"+changeX+" Y:"+changeY);
        window.getSelection ? window.getSelection().removeAllRanges() : document.selection.empty(); 
    });
    function getIsTouch(){
        var changeX = touchValue.ex - touchValue.sx;
        var changeY = touchValue.ey - touchValue.sy;
        if(Math.abs(changeX)<=touchValue.x&&Math.abs(changeY)<=touchValue.y){
            return true
        }else return false
    }

    //dropedImgCtrl
    function dropedCtrl(e) {
        switch (this.id) {
            case "btn_big":
                //桌機板
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
                // //手機板
                // // document.getElementsByClassName("tip")[0]
                // var tarPic=document.getElementsByClassName(".droped_img.select");
                // console.log(`tarPic: ${tarPic}`);
                // console.log(tarPic);
                
                // let arr = tarPic.style.transform.split(" ");
                // let newScale = parseFloat(arr[3].replace("scale(", "").replace(")", "")) + 0.5;
                // arr[3] = "scale(" + newScale + ")";
                // tarPic.style.transform = `${arr[0]} ${arr[1]} ${arr[2]} ${arr[3]}`;
            
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
// if($(window).width() > 767){
    
// //任意處點擊解除拖曳圖片的選取狀態
// var section15 = document.querySelector("#section_15");
//         section15.addEventListener("click", removeDropImgTag);
//         function removeDropImgTag(e) {
//                 //btnSelect是個不好的判斷法，因為目前是泡泡傳到div裡的圖片上所以才會產生btnSelect
//                 //目前已知會造成每個圖片都被上class
//                 if ((e.target.classList.contains("droped_img")) == false && (e.target.classList.contains("btnSelect")) == false) {
//                         arrDropedImg.forEach(el => {
//                                 el.classList.remove("select");
//                         })
//                 }
//         }
// }else{
//     //丟圖片進去
//     // var dropPic_top = document.querySelector('#cusImg_top');
//     //      var img = document.querySelectorAll('.cusPic');
//     //      for (var i = 0; i < img.length; i++){
//     //          img[i].addEventListener('click', function (e) {
//     //          var imgSrc = e.target.src;
//     //          dropPic_top.setAttribute("src", imgSrc)             
//     //          dropPic_top.style.display = 'block';
             
             

//     //          },false);
//     //      }

//     //      $( "#cusImg_top" ).draggable();





//          var dropPic_left = document.querySelector('#cusImg_left');
//          var img = document.querySelectorAll('.cusPic');
//          for (var i = 0; i < img.length; i++){
//              img[i].addEventListener('click', function (e) {
//              var imgSrc = e.target.src;
//              dropPic_left.setAttribute("src", imgSrc)             
//              dropPic_left.style.display = 'block';
             
             

//              },false);
//          }
          
//          $( "#cusImg_left" ).draggable();

//         //  var dropPic_right = document.querySelector('#cusImg_right');
//         //  var img = document.querySelectorAll('.cusPic');
//         //  for (var i = 0; i < img.length; i++){
//         //      img[i].addEventListener('click', function (e) {
//         //      var imgSrc = e.target.src;
//         //      dropPic_right.setAttribute("src", imgSrc)             
//         //      dropPic_right.style.display = 'block';
             
             

//         //      },false);
//         //  }
          
//         //  $( "#cusImg_right" ).draggable();
         
//         //  var dropPic_front = document.querySelector('#cusImg_front');
//         //  var img = document.querySelectorAll('.cusPic');
//         //  for (var i = 0; i < img.length; i++){
//         //      img[i].addEventListener('click', function (e) {
//         //      var imgSrc = e.target.src;
//         //      dropPic_front.setAttribute("src", imgSrc)             
//         //      dropPic_front.style.display = 'block';
             
             

//         //      },false);
//         //  }
          
//         //  $( "#cusImg_front" ).draggable();
                  
//         //  var dropPic_down = document.querySelector('#cusImg_down');
//         //  var img = document.querySelectorAll('.cusPic');
//         //  for (var i = 0; i < img.length; i++){
//         //      img[i].addEventListener('click', function (e) {
//         //      var imgSrc = e.target.src;
//         //      dropPic_down.setAttribute("src", imgSrc)             
//         //      dropPic_down.style.display = 'block';
             
             

//         //      },false);
//         //  }
          
//         //  $( "#cusImg_down").draggable();



//          //放大縮小旋轉刪除

//          function doFirst(){
//             document.getElementById('btn_big').addEventListener('click',bigger);
//             document.getElementById('btn_small').addEventListener('click',smaller);
//             document.getElementById('btn_clk').addEventListener('click',rotateLeft);
//             document.getElementById('btn_clk_r').addEventListener('click',rotateRight);
//             document.getElementById('btn_del').addEventListener('click',clear);
//         }


//         function bigger(){
//             var image = document.getElementById('cusImg_left');
//                 image.width = image.width * 1.05;
//                 image.height = image.height * 1.05;

//         }


//         function smaller(){
//             var image= document.getElementById('cusImg_left');
// 		image.width = image.width * 0.95;
// 		image.height = image.height * 0.95;
// 		console.log(image.width); 
//         }

//         var deg = 0;
//         function rotateLeft(){
//             var image = document.getElementById('cusImg_left');
//             deg += 15;
//             image.style.transform = "rotate(" + deg + "deg)";
//         }

//         var deg = 0;
//         function rotateRight(){
//             var image = document.getElementById('cusImg_left');
//             deg -= 15;
//             image.style.transform = "rotate(" + deg + "deg)";
//         }

//         function clear(){
//             var imgClear = document.getElementById('cusImg_left');
// 	        imgClear.remove(image);
//         }
//         window.addEventListener('load', doFirst);

//         }

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
<!-- 卡片音效 src 傳到data-cussound鈕 -->
    <script>
    $(function () {
        $("#soundAdd").on("click",addSound);
        function addSound(e){
            alertBox('音效已加入卡片囉~');
            //選取目標聲音的路徑
            let src=$("#soundAdd").closest(".content").children(".container").children("div:visible").find("source").attr("src");
            console.log(src);
            //加入按鈕"加入購物車"的data屬性
            let tar=$(".step-content-foot .step.cart");
            console.log("before:"+tar.data("cussound"));
            // $.data(tar,"cussound",src);
            // tar[0].dataset.cussound=src;
            tar.attr("data-cussound",src);
            console.log("after:"+tar.data("cussound"));
        }
    })
    
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
