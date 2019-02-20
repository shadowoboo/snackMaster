<?php 
    ob_start();
    session_start();
    //未登入直接跳轉到首頁
    // if( isset($_SESSION['memId']) == false ){
    //     header('location:index.php');
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
        header("Location: index.php");
      
    }
    $errMsg = "";
    try{
        require_once('connectcd105g2.php');
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

        // $grade=$memRow["grade"];
        // $memId=

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

        <form action="" method="post" enctype="multipart/form-data">
            <table class="col-12 col-1">
                <tr>
                    <td>
                        <div>
                            <img id="headPic" src="../images/Level<?php 
                                echo $memRow["memPic"]; 
                             ?>">
                        </div>

                        <label class="memPic" for="upFile">
                            <p>上傳大頭貼<img src="../images/tina/pen.png" alt="編輯"></p>

                            <input type="file" name="file" id="upFile">

                        </label>



                    </td>
                </tr>

            </table>
            <table class="col-12 col-2">
                <tr>
                    <td>
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
                            <input type="text" name="memId" value="<?php echo $memRow["memId"];?>" maxlength="15">
                            <img src="../images/tina/pen.png" alt="編輯">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            密碼：
                            <input type="password" name="memPsw" value="<?php echo $memRow["memPsw"];?>" maxlength="15" autofocus>
                            <img src="../images/tina/pen.png" alt="編輯">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            姓名：
                            <input type="text" name="memName" value="<?php echo $memRow["memName"];?>" maxlength="12">
                            <img src="../images/tina/pen.png" alt="編輯">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            電話：
                            <input type="number" name="phone" value="<?php echo $memRow["memPhone"];?>" maxlength="10">
                            <img src="../images/tina/pen.png" alt="編輯">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            信箱：
                            <input type="email" name="email" value="<?php echo $memRow["email"];?>" maxlength="20">
                            <img src="../images/tina/pen.png" alt="編輯">
                        </p>
                    </td>
                </tr>

            </table>
            <table class="col-12 col-3">
                <tr>
                    <td>
                        <p>
                            成就：<span>零食寶寶</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            積分：<span>12385</span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span><?php echo $memRow["commentRight"];?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="modify">
                            <button class="action">確認修改</button>
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
                <li class="tablinks" onclick="changeTabs(event,'tab-2')">
                    <h4 class="detail">訂單管理</h4>
                </li>
                <li class="tablinks" onclick="changeTabs(event,'tab-3')">
                    <h4 class="detail">收藏商品</h4>
                </li>
                <li class="tablinks" onclick="changeTabs(event,'tab-4')">
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


            </div>
            <!------------------收藏品--------------------  -->
            <div class="tabPanel " id="tab-3">
                <div class="collect">
                    <p>目前暫無收藏品</p>
                </div>

            </div>
            <!-------------------優惠券--------------------  -->
            <div class="tabPanel " id="tab-4">
                <table>
                    <tr>
                        <th></th>
                        <th>優惠券名目</th>
                        <th>折扣金額</th>
                        <th>使用期限</th>
                    </tr>
                    <tr>
                        <td>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="100" height="50" viewBox="0 0 100 50">
                                <image id="level" width="100" height="50"
                                    xlink:href="data:img/png;base64,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" />
                            </svg>
                        </td>
                        <td>升等獎勵優惠券</td>
                        <td>300元</td>
                        <td>2019/05/20</td>
                    </tr>
                </table>

            </div>
        </div>






    </section>

    <!-- <div class="footer_ip">
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
            
        </div> -->
    <footer class="footer">
        <div id="floor">
            <img src="../images/nnnnn/floor.png" alt="floor">
            <p id="copy">Copyright©2019 Snack Master</p>
        </div>
    </footer>



</body>

</html>