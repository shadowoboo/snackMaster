<?php 
    ob_start();
    session_start();
    //未登入直接跳轉到首頁
    // if( isset($_SESSION['memId']) == false ){
    //     header('location:homePage.php');
    // }
    //點擊登出，會員資料要清空
    //跳轉回首頁
    if (isset($_REQUEST["btnloglout"]) && ($_REQUEST["btnloglout"]=="true")) {
        //登出資料要清空
        unset ($_SESSION["memNo"]);
        unset ($_SESSION["grade"]);
        unset ($_SESSION["memId"]);
        unset ($_SESSION["email"]);
        unset ($_SESSION["memPic"]);
        unset ($_SESSION["memPhone"]);
        unset ($_SESSION["commentRight"]);
        unset ($_SESSION["reportTimes"]);
        unset ($_SESSION["memName"]);
        //跳轉回首頁
        header("Location: homePage.php");
      
    }
    
    $errMsg = "";
    try{
        require_once('connectcd105g2.php');
        //會員基本資料
        //用No找到該筆會員資料
        $memNo =$_SESSION["memNo"];
        //從會員裡的會員編號找出其他相關欄位
        $sql = "select * from member where memNo=:memNo";        
        $members = $pdo->prepare($sql);
        $members ->bindValue(":memNo", $memNo);
        // $members ->bindValue(":grade", $grade);
        // $members ->bindValue(":memId", $memId);
        // $members ->bindValue(":memPsw", $memPsw);
        // $members ->bindValue(":email", $email);
        // $members ->bindValue(":memPic", $memPic);
        // $members ->bindValue(":memPhone", $memPhone);
        // $members ->bindValue(":memPoint", $memPoint);
        // $members ->bindValue(":memName", $memName);
        $members->execute();
        //抓出一筆資料(1行)
        $memRow = $members->fetch(PDO::FETCH_ASSOC);          
        //判斷會員權利
        //0->禁言，1->沒事
        if($memRow["commentRight"]==0){
            $commentRight= "禁言中";
        }else{
            $commentRight= "";
        }
        //---------預設大頭貼-------------
        //---------成就等級---------------
        // $grade_sql = "select mem.grade,lev.grade,lev.gradeName,lev.gradePoint from member mem JOIN masterlevel lev on mem.grade = lev.grade";
        // $grade_sql=" SELECT * FROM `member` JOIN masterlevel on member.grade = masterlevel.grade " ;
        $sql = "select gradePic,gradeName from masterlevel where grade ={$memRow["grade"]}";
        $levels = $pdo->query($sql);
        $levRow = $levels->fetch(PDO::FETCH_ASSOC);

        
    

    }catch(PDOException $e){
        echo "失敗",$e->getMessage();
        echo "行號",$e->getLine();

    }
    
    
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/nnnnn.css">
    <link rel="stylesheet" href="../css/member.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/header.css">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/header.js" defer></script>
    <script src="../js/member.js" defer></script>

    <title>會員專區</title>

</head>

<body>
    <?php
    require_once("header.php");
?>


    <section class="memWrap">

        <form action="memUpdate.php" method="post" enctype="multipart/form-data" id="memInfo">
            <table class="col-12 col-1">
                <tr>
                    <td>
                        <div>
                            <img id="headPic"
                                src="../images/<?php 
                                if(isset($_SESSION["memPic"])==true){
                                    // echo "no picture";
                                    echo $_SESSION["memPic"];
                                }else {
                                    echo $memRow["memPic"];
                                }

                             ?>">
                        </div>

                        <label class="memPic" for="upFile">
                            <p>上傳大頭貼<img src="../images/tina/pen.png" alt="編輯"></p>

                            <input type="file" name="upFile" id="upFile">

                        </label>



                    </td>
                </tr>

            </table>
            <table class="col-12 col-2">
                <tr>
                    <td>
                        <input type="hidden" name="memNo" value="<?php echo $memRow["memNo"];?>">
                        <p>
                            會員編號：<span><?php echo $memRow["memNo"];?></span>
                            <!-- <input type="text" name="nickName" value="我是帥帥" maxlength="15">
                            <img src="../images/tina/pen.png" alt="編輯"> -->
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            帳號：
                            <input type="text" name="memId" value="<?php echo $memRow["memId"];?>" maxlength="15"
                                id="memId">
                            <img src="../images/tina/pen.png" alt="編輯">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            密碼：
                            <input type="password" name="memPsw" value="<?php echo $memRow["memPsw"];?>" maxlength="15"
                                autofocus id="memPsw">
                            <img src="../images/tina/pen.png" alt="編輯">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            姓名：
                            <input type="text" name="memName" value="<?php echo $memRow["memName"];?>" maxlength="12"
                                id="memName">
                            <img src="../images/tina/pen.png" alt="編輯">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            電話：
                            <input type="number" name="phone" value="<?php echo $memRow["memPhone"];?>" maxlength="10"
                                id="memPhone">
                            <img src="../images/tina/pen.png" alt="編輯">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            信箱：
                            <input type="email" name="email" value="<?php echo $memRow["email"];?>" maxlength="20"
                                id="email">
                            <img src="../images/tina/pen.png" alt="編輯">
                        </p>
                    </td>
                </tr>

            </table>
            <table class="col-12 col-3">
                <tr>
                    <td>
                        <p>
                            成就：<span><?php echo $levRow["gradeName"];?></span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            積分：<span><?php echo $memRow["memPoint"];?></span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span><?php echo $commentRight;?></span>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="modify">
                            <button class="action" id="btnmodify">確認修改</button>
                        </div>
                    </td>
                </tr>


            </table>


        </form>


    </section>

    <!-- -------------------功能區------------------- -->

    <section class="itemTab2">
        <div class="tabContainer">
            <ul class="tabs">
                <li class="tablinks" id="defaultOpen" onclick="changeTabs(event,'tab-1')">
                    <h4 class="detail">累積成就</h4>
                </li>
                <li class="tablinks" onclick="changeTabs(event,'tab-2')" id="tab22">
                    <h4 class="detail">訂單管理</h4>
                </li>
                <li class="tablinks" onclick="changeTabs(event,'tab-3')" id="tab33">
                    <h4 class="detail">收藏商品</h4>
                </li>
                <li class="tablinks" onclick="changeTabs(event,'tab-4')" id="tab44">
                    <h4 class="detail">優惠券管理</h4>
                </li>
            </ul>

        </div>
        <div class="wrapTabPanel">
            <!-- -----------------累積成就---------------------- -->
            <div class="tabPanel" id="tab-1">
                <div class="levelInfor">
                    <div class="topLevel">
                        <span>Level1</span>
                        <span>Level3</span>
                        <span>Level5</span>
                        <span>12385分</span>
                    </div>
                    <div class="procBar">
                        <div class="baby">
                            <img src="../images/tina/大頭貼.png" alt="零食寶寶">
                        </div>

                        <div class="colorBar">
                            <div class="nowPro"></div>
                        </div>
                        <div class="kid">
                            <img src="../images/tina/kid.png" alt="零食小鬼">
                        </div>

                    </div>
                    <div class="bottumLevel">
                        <span>Level0</span>
                        <span>Level2</span>
                        <span>Level4</span>
                        <span>Level6</span>
                    </div>

                </div>
                <div class="description">
                    <h4>成就積分規則說明</h4>
                    <div class="specify">
                        <div class="col4 col4-1">
                            <p>等級制度</p>
                            <ul>
                                <li>Level0-零食寶寶</li>
                                <li>Level1-零食小鬼</li>
                                <li>Level2-零食練習生</li>
                                <li>Level3-零食學霸</li>
                                <li>Level4-零食科學家</li>
                                <li>Level5-零食博士</li>
                                <li>Level6-大零食家</li>
                            </ul>
                        </div>
                        <div class="col4 col4-2">
                            <p>升等條件</p>
                            <ul>
                                <li>Level0-Level1:100積分</li>
                                <li>Level1-Level2:1200積分</li>
                                <li>Level2-Level3:3600積分</li>
                                <li>Level3-Level4:7200積分</li>
                                <li>Level4-Level5:12000積分</li>
                                <li>Level5-Level6:1800積分</li>
                            </ul>

                        </div>
                        <div class="col4 col4-3">
                            <p>如何獲得積分？</p>
                            <ul>
                                <li>每完成一則評價獲得100積分</li>
                                <li>每按讚1次獲得1積分</li>
                            </ul>

                        </div>
                        <div class="col4 col4-4">
                            <p>扣分規則</p>
                            <ul>
                                <li>被檢舉成立收回該評價</li>
                                <li>並收回100分及該評價按讚數積分</li>
                            </ul>

                        </div>


                    </div>
                    <div class="btnn">
                        <button class="goToCustom">領取升等獎勵</button>
                    </div>

                </div>

            </div>
            <!----------------------- 訂單管理----------------------------- -->
            <div class="tabPanel " id="tab-2">
                <div class="orderList">
                    <table>

                        <tr>
                            <th>訂單編號:</th>
                            <td>01</td>
                        </tr>
                        <tr>
                            <th>下單日期：</th>
                            <td>2019/01/28</td>
                        </tr>
                        <tr>
                            <th>付款方式：</th>
                            <td>信用卡</td>
                        </tr>
                        <tr>
                            <th>出貨狀態：</th>
                            <td>未出貨</td>
                        </tr>


                    </table>
                    <table>
                        <tr>
                            <th>收件人地址:</th>
                            <td>台北市大安區羅斯福路三段227號9樓</td>
                        </tr>
                        <tr>
                            <th>收件人電話：</th>
                            <td>0911664587</td>
                        </tr>
                        <tr>
                            <th>評價狀態：</th>
                            <td>無法評價</td>
                        </tr>

                    </table>

                </div>
                <div class="total">
                    <p>總額：<span>6000元</span></p>
                </div>
                <div id="listMore">
                    <p><a href="#">訂單明細v</a> </p>
                </div>
                <div class=line></div>
                <div id="proEva" class="orderItem">
                    <table class="orderItemList">
                        <tr>
                            <th>商品</th>
                            <th>品名</th>
                            <th>數量</th>
                            <th>單價</th>
                            <th>小計</th>
                            <th>備註</th>
                            <th>評價狀態</th>
                        </tr>
                        
                        <tr>
                            <td>
                            <img src="../images/index/co2.png" alt="">
                            </td>
                            <td>Pocky 巧克力</td>
                            <td>12</td>
                            <td>200</td>
                            <td>200</td>
                            <td>客製化</td>
                            <td>
                                未評價
                            </td>
                        </tr>
                    

                    </table>
                    <div id="evaBox" class="evaLightBox">
                        <span>X</span>
                        <div class="evaLightBox_content">
                            <div class="evaContent proPic">
                                <img src="../images/index/co2.png" alt="">
                                <p>Pocky 巧克力</p>
                            </div>
                            <div class="evaContent evaStars">
                                <ul>
                                    <li>
                                        <p>
                                            甜度：
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            酸度：
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            辣度：
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            好評度：
                                        </p>
                                    </li>

                                </ul>

                            </div>


                        </div>
                        <div class="evaContent discuss">
                            <textarea name="textDiscuss" id="textDiscuss" cols="30" rows="10"></textarea>
                        </div>
                        <div class="evaContent evaPro">

                            <div class="proPicBox">
                                <img id="proPic" src="../images/index/co2.png">
                            </div>

                            

                            <label class="evaproPic" for="upFile">

                                <p class="step">上傳圖檔</p>
                                <input type="file" name="upFile" id="upFile">

                            </label>
                        </div>
                        <div class="evaContent evaSend">
                            <button class="step">確認送出</button>
                        </div>

                    </div>
                </div>


            </div>
            <!------------------收藏品--------------------  -->
            <div class="tabPanel " id="tab-3">
<<<<<<< HEAD
                <div class="collect">
                    <div class="item citem1">
                        <img class="country" src="../images/blair/jp-no2.png" alt="">
                        <img class="itemImg" src="../images/blair/item3.png" alt="">
                        <h4 class="itemName">[日本]Pure 草莓優格軟糖</h4>
                        <div class="sellPrice">
                            <p>價格<span>$80</span></p>

                        </div>
                        <div class="citemBtns">
                            <button class="cart">加入購物車</button>
                            <button class="trash"><i class="far fa-trash-alt"></i></button>
                        </div>

                    </div>
                    <div class="item citem2">
                        <img class="country" src="../images/blair/jp-no2.png" alt="">
                        <img class="itemImg" src="../images/blair/item3.png" alt="">
                        <h4 class="itemName">[日本]Pure 草莓優格軟糖</h4>
                        <div class="sellPrice">
                            <p>價格<span>$80</span></p>

                        </div>
                        <div class="citemBtns">
                            <button class="cart">加入購物車</button>
                            <button class="trash"><i class="far fa-trash-alt"></i></button>
                        </div>

                    </div>
                    <div class="item citem3">
                        <img class="country" src="../images/blair/jp-no2.png" alt="">
                        <img class="itemImg" src="../images/blair/item3.png" alt="">
                        <h4 class="itemName">[日本]Pure 草莓優格軟糖</h4>
                        <div class="sellPrice">
                            <p>價格<span>$80</span></p>

                        </div>
                        <div class="citemBtns">
                            <button class="cart">加入購物車</button>
                            <button class="trash"><i class="far fa-trash-alt"></i></button>
                        </div>

                    </div>
                   
                </div>


                <!-------------------------------優惠券-----------------------------  -->
                 <div class="tabPanel " id="tab-4">
=======

                <div class="collect" id="getCollect">
        
                </div>
            </div>

                <!------優惠券----->
                <div class="tabPanel " id="tab-4">
>>>>>>> master
                    <table>
                        <tr>
                            <th></th>
                            <th>優惠券名目</th>
                            <th>折扣金額</th>
                            <th>使用期限</th>
                        </tr>
                    </table>
        
                    <table id="coupon">
        

                    </table>

                </div>
            </div> 

    </section>                            

                                

    
    
    
    
    
    <!-- <footer>

        <div id="floor"> 
            <img src="../images/nnnnn/floor.png" alt="floor">
            <p id="copy">Copyright©2019 Snack Master</p>
        </div>
    
    </footer>  -->




</body>

<script>
    //判斷點擊哪一個 tab
    function tabClick(e){
        var tab = e.target.parentNode.id;

        switch(tab){
            case 'defaultOpen':
                
                break;
            case 'tab22':
                
                break;
            case 'tab33':
                getCollection();
                break;
            case 'tab44':
                getCoupon();
                break;
        }
    }
    //收藏清單
    function getCollection(){
        var xhr = new XMLHttpRequest();
        xhr.onload = function(){
            if( xhr.status == 200 ){
                document.getElementById("getCollect").innerHTML = xhr.responseText;
                //trash
                var trash = document.getElementsByClassName('trash');
                var length = trash.length;
                for( var i=0; i<length; i++){
                    trash[i].addEventListener('click', deletTrash);
                }
                var trashIcon = document.getElementsByClassName('fa-trash-alt');
                var length2 = trashIcon.length;
                for( var j=0; j<length2; j++){
                    trashIcon[j].addEventListener('click', deletTrash);
                }
            }else{
                alert( xhr.status );
            }
        }

        var url = "memGetCollect.php";
        xhr.open("Get", url, true);
        xhr.send( null );
    }

    //deletTrash
    function deletTrash(e){
        if(e.target.className.indexOf('fa') == -1){
            var snackNo = e.target.id;
        }else{
            e.stopPropagation();
            var snackNo = e.target.parentNode.id;
        }
        
        var xhr = new XMLHttpRequest();
        xhr.onload = function () {
            if(xhr.status == 200){
                if(xhr.responseText != 'true'){
                    alert(xhr.responseText);
                }else{
                    getCollection();
                }
            }else{
                alert(xhr.status);
            }
        }
        var url = 'removeHeart.php?snackNo=' + snackNo;
        xhr.open('get', url, true);
        xhr.send(null);
    }
    //優惠眷
    function getCoupon(){
        var xhr = new XMLHttpRequest();
        xhr.onload = function(){
            if( xhr.status == 200 ){
                document.getElementById("coupon").innerHTML = xhr.responseText;
            }else{
                alert( xhr.status );
            }
        }

        var url = "memberGetCoupon.php";
        xhr.open("Get", url, true);
        xhr.send( null );
    }



    
    function doFirst(){
        tablinks = document.getElementsByClassName("tablinks");
        for(var num = 0; num<tablinks.length; num++){
           tablinks[num].addEventListener('click',tabClick); 
        }
    }  


    
    window.addEventListener('load', doFirst, false);
</script>

</html>

