<?php 
    ob_start();
    session_start();
    //未登入直接跳轉到首頁
    if( isset($_SESSION['memId']) == false ){
        unset ($_SESSION["memNo"]);
        unset ($_SESSION["memId"]);
        unset ($_SESSION["memId"]);
        header('location:homePage.php');
    }
    //點擊登出，會員資料要清空
    //跳轉回首頁
    if (isset($_REQUEST["btnloglout"]) && ($_REQUEST["btnloglout"]=="true")) {
        //登出資料要清空
        unset ($_SESSION["memNo"]);
        unset ($_SESSION["memId"]);
        unset ($_SESSION["memId"]);
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

        //=======================訂單管理=================================

        //用orderNo做連結
        $order_sql = "select * from snackorder join orderitem on snackorder.orderNo = orderitem.orderNo join snack on orderitem.snackNo = snack.snackNo where memNo=:memNo";
        $order = $pdo->prepare($order_sql);
        $order->bindValue(":memNo",$memNo);
        $order->execute();
        // $orderRow = $order->fetch(PDO::FETCH_ASSOC);
        
        // if ($order->rowCount() ==0 ) {
        //     echo "您目前尚無訂單！";
        // }
    


        
    

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
    <script src="../js/upgrade.js"></script>

    <title>會員專區</title>

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
                        <a href="homePage.php"><img src="../images/tina/LOGO2.png" alt="大零食家"></a>

                    </div>
                    <div id="list_appear">
                        <!-- ----------手機選單離開-------- -->
                        <div id="cros">
                            <span class="leave">X</span>
                        </div>
                        <ul class="list">
                            <li id="gorankBoard"><a href="rankBoard.php">零食排行榜</a></li>
                            <li id="gocustomized"><a href="customized.php">客製零食箱</a> </li>
                            <!-- 在手機上要關掉這個li的logo -->
                            <li><a href="homePage.php"><img src="../images/tina/LOGO1.png" alt="大零食家"></a></li>
                            <li id="store"> 零食商店街
                                <ul id="Submenu" class="subMenu">
                                    <li id="snBox"><a href="preOrder.php">預購零食箱</a></li>
                                    <li><a href="shopping.php">零食列表</a></li>
                                </ul>
                            </li>
                            <li id="goGsell"><a href="gsell.php">尋找販賣機</a> </li>
                        </ul>
                    </div>
                </div>

                <ul class="login">
                    <li><a href="?loglout=true"><span id="btnloglout">&nbsp</span></a></li>
                    <!-- <li><span id="btnloglout">&nbsp</span></li> -->
                    <li><i class="fas fa-user-circle" id="memLogin"></i></li>
                    <li id="goCartShow"><a href="cartShow.php"><i class="fas fa-shopping-cart" id="shopCart"></i></a></li>
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
    <!-- //-------------------------------------------------------//
-----------------------       這是燈箱        ------------------ -->
    <!-- //-------------------------------------------------------// -->
    <div id="lightBox-wrap">
        <div id="lightBox">
            <div class="loginLeave">
                <span id="lightBoxLeave">X</span>
            </div>
            <ul class="tab-group">
                <li class="loginTab" id="open" onclick="changeway(event,'Loginpage')">登入</li>
                <li class="loginTab" onclick="changeway(event,'signup')">註冊</li>
            </ul>
            <div class="loginTab-content">
                <!-----------------------------------登入表單------------------------------------  -->
                <form id="Loginpage" class="tabContent">

                    <table class="loginBox">
                        <tr>
                            <td>
                                <label class="Box-name" for="loginMemId">帳號</label>
                                <input type="text" name="loginMemId" id="loginMemId" size="12" autocomplete="off"
                                    placeholder="請輸入帳號">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="Box-name" for="loginMemPsw">密碼</label>
                                <input type="password" name="loginMemPsw" id="loginMemPsw" size="12"
                                    placeholder="請輸入密碼">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="button" id="btnLogin" value="登入" class="cart">

                            </td>
                        </tr>
                    </table>
                    <div class="forgetPsw">
                        <p id="forgetPswLink" class="loginTab " onclick="changeway(event,'forgetPsw')"> 忘記密碼</p>
                    </div>


                </form>
                <!------------------------------------------------註冊表單------------------------------------------  -->
                <form id="signup" class="tabContent">
                    <table class="signUpBox">
                        <tr>
                            <td>
                                <label class="Box-name" for="signUpMemId">帳號</label>
                                <input type="text" name="signUpMemId" id="signUpMemId" size="12" autocomplete="off"
                                    placeholder="不得少於2碼">

                            </td>

                        </tr>
                        <tr>
                            <td>
                                <label class="Box-name" for="signUpMemPsw">密碼</label>
                                <input type="password" name="signUpMemPsw" id="signUpMemPsw" size="12"
                                    placeholder="請輸入密碼">
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <label class="Box-name mail" for="signUpMemEmail">信箱</label>
                                <input type="email" name="signUpMemEmail" id="signUpMemEmail" size="20"
                                    autocomplete="off">
                            </td>

                        </tr>
                        <tr>
                            <td class="formBtn">
                                <input type="button" id="btnSignUp" value="註冊" class="cart">
                            </td>
                        </tr>

                    </table>
                </form>
                <!-- ---------------------------------------忘記密碼 -->
                <form id="forgetPsw" class="tabContent">
                    <table class="forgetPswBox">
                        <tr>
                            <td>
                                <label class="Box-name" for="forgetMemId">帳號</label>
                                <input type="text" name="forgetMemId" id="forgetMemId" size="12" autocomplete="off"
                                    placeholder="請輸入帳號">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="Box-name mail" for="forgetMemEmail">信箱</label>
                                <input type="email" name="forgetpMemEmail" id="forgetpMemEmail" size="20"
                                    autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <td class="formBtn">
                                <input type="button" id="forgetSend" value="寄送密碼" class="cart">
                            </td>

                        </tr>

                    </table>


                </form>

            </div>

        </div>


    </div>    
    


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

                            <input type="file" name="upFile" id="upFile" =>

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
                        <p id="memIfon-p">
                            帳號：
                            <input type="text" name="memId" value="<?php echo $memRow["memId"];?>" maxlength="15"
                                id="memIfon" > 
                                <!-- 還未增加readonly，修改input樣式要改變css未調 -->
                            <img src="../images/tina/pen.png" alt="編輯" id="infoChange">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            密碼：
                            <input type="password" name="memPsw" value="<?php echo $memRow["memPsw"];?>" maxlength="15" autofocus>
                            <img src="../images/tina/pen.png" alt="編輯" id="infoChange">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            姓名：
                            <input type="text" name="memName" value="<?php echo $memRow["memName"];?>" maxlength="12">
                            <img src="../images/tina/pen.png" alt="編輯" id="infoChange">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            電話：
                            <input type="number" name="phone" value="<?php echo $memRow["memPhone"];?>" maxlength="10">
                            <img src="../images/tina/pen.png" alt="編輯" id="infoChange">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            信箱：
                            <input type="email" name="email" value="<?php echo $memRow["email"];?>" maxlength="20">
                            <img src="../images/tina/pen.png" alt="編輯" id="infoChange">
                        </p>
                    </td>
                </tr>

            </table>
            <table class="col-12 col-3">
                <tr>
                    <td>
                        <p>
                            成就：<span id="gradeName"><?php echo $levRow["gradeName"];?></span>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            積分：<span id="memPoint"><?php echo $memRow["memPoint"];?></span>
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
                        <!-- <div class="baby">
                            <img src="../images/tina/大頭貼.png" alt="零食寶寶">
                        </div> -->

                        <div class="colorBar" style="overflow: hidden">
                            <div class="nowPro"></div>
                        </div>
                        <!-- <div class="kid">
                            <img src="../images/tina/kid.png" alt="零食小鬼">
                        </div> -->

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
<?php 
    $sql = "select grade, memPoint from member where memNo = {$_SESSION['memNo']}";
    $members = $pdo -> query($sql);
    $member = $members -> fetch();
    if( $member['grade'] == 6 ){
        $check = 'disabled style="cursor: no-drop;"';
    }else{
        $nextGrade = $member['grade'] + 1;
        $sql = "select * from masterlevel where grade = {$nextGrade}";
        $grades = $pdo -> query($sql);
        $grade = $grades -> fetch(); 
        if( $member['memPoint'] < $grade['gradePoint'] ){
            $check = 'disabled style="cursor: no-drop;"';
        }else{
            $check = '';
        }
    }
?>
                        <button class="goToCustom" <?php echo $check ?>>領取升等獎勵</button>
                    </div>

                </div>

            </div>
            <!----------------------- 訂單管理---------------------------->
            <div class="tabPanel " id="tab-2">
                <?php 
            //先抓出訂單資料
                $order_sql= "select * from snackOrder where memNo=:memNo";
                $order = $pdo->prepare($order_sql);
                $order->bindValue(":memNo", $memNo);
                $order->execute();
                if ($order->rowCount() ==0 ) {
                        echo "您目前尚無訂單！";
                 }else{
                    while($orderRow = $order->fetch(PDO::FETCH_ASSOC)){
                        $orderNo = $orderRow['orderNo'];
                        

    ?>

                <div class="order">

                    <!-- -------------------------訂單-------------------->
                    <div class="orderList">
                        <table>

                            <tr>
                                <th>訂單編號:</th>
                                <td><?php echo $orderRow['orderNo'] ?></td>
                            </tr>
                            <tr>
                                <th>下單日期：</th>
                                <td><?php echo $orderRow['orderTime'] ?></td>
                            </tr>
                            <tr>
                                <th>付款方式：</th>
                                <td><?php echo $orderRow['payWay'] ?></td>
                            </tr>
                            <tr>
                                <th>出貨狀態：</th>
                                <td><?php echo $orderRow['orderStatus'] ?></td>
                            </tr>


                        </table>
                        <table>
                            <tr>
                                <th>收件人地址:</th>
                                <td><?php echo $orderRow['address'] ?></td>
                            </tr>
                            <tr>
                                <th>收件人電話：</th>
                                <td><?php echo $orderRow['phone'] ?></td>
                            </tr>


                        </table>

                    </div>
                    <div class="total">
                        <p>總額：<?php echo $orderRow['orderTotal'] ?></p>
                    </div>
                    <!-----------------訂單明細------------------------  -->
                    <div class="orderitem">
                        <p class="orderList_btn">訂單明細v</p>
                        <div class=line></div>

                        <div class="orderLis_content">
                            <table class="orderList_items">
                                <tr>
                                    <th>商品</th>
                                    <th>品名</th>
                                    <th>數量</th>
                                    <th>單價</th>
                                    <th>小計</th>
                                    <th>備註</th>
                                    <th>評價狀態</th>

                                </tr>

         <?php 
              $OL_sql= "select a.snackNo, a.snackName, a.snackPic, a.snackPrice, b.orderNo, b.snackQuan, b.customBoxItem, b.snackNo from snack a join orderItem b on a.snackNo = b.snackNo where orderNo=:orderNo";
                          $order_list =$pdo->prepare($OL_sql);
                          $order_list->bindValue(":orderNo",$orderNo);
                          $order_list->execute();

                          $order_listArr = $order_list->fetchAll(PDO::FETCH_ASSOC);
                          $OLrowcount = $order_list->rowCount(); 
                        //   print_r($order_listRow);
                        //   print_r($order_listArr);
                        //   echo $OLrowcount."<br>" ;
                        //   echo count($order_listArr).$br;

                      
                        

                          for($i=0;$i<$OLrowcount;$i++){
        ?>
                                <tr class="orderList_moreItems item01">
                                    <td>
                                        <img src="<?php echo $order_listArr[$i]['snackPic'] ?>" alt="商品圖">
                                    </td>
                                    <td><?php echo $order_listArr[$i]['snackName'] ?></td>
                                    <td><?php echo $order_listArr[$i]['snackQuan'] ?></td>
                                    <td><?php echo $order_listArr[$i]['snackPrice'] ?></td>
                                    <td><?php echo $order_listArr[$i]['snackQuan'] *$order_listArr[$i]['snackPrice']?></td>
                                    <td>一般</td>
                                    <td>
                                        <button class="orderList_eva cart">未評價</button>
                                    </td>
                                </tr>
                                <tr class="eva_lightBox_Box01 eva_lightBox" style="display: none;" name="snackNo
                                <?php echo $order_listArr[$i]['snackNo'] ?>">
                                            <td>
                                            <span class="eva_lightBox_leave">x</span>
                                                <div class="evaContent ">
                                                    <img src="<?php echo $order_listArr[$i]['snackPic'] ?>" alt="商品圖">
                                                </div>
                                                <p><?php echo $order_listArr[$i]['snackName'] ?></p>

                                            </td>
                                            <td>
                                                <ul class="eva_lightBox_stars">
                                                    <li>
                                                        <p>
                                                            甜度：
                                                            <ul class="eva_lightBox_swStars">
                                                                <li>
                                                                    1星 <input type="radio" name="swStar" value="1">
                                                                </li>
                                                                <li>
                                                                    2星 <input type="radio" name="swStar" value="2">
                                                                </li>
                                                                <li>
                                                                    3星 <input type="radio" name="swStar" value="3">
                                                                </li>
                                                                <li>
                                                                    4星 <input type="radio" name="swStar" value="4">
                                                                </li>
                                                                <li>
                                                                    5星 <input type="radio" name="swStar" value="5">
                                                                </li>
                                                            </ul>
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p>
                                                            酸度：
                                                            <ul class="eva_lightBox_suStars">
                                                                <li>
                                                                    1星 <input type="radio" name="suStar" value="1">
                                                                </li>
                                                                <li>
                                                                    2星 <input type="radio" name="suStar" value="2">
                                                                </li>
                                                                <li>
                                                                    3星 <input type="radio" name="suStar" value="3">
                                                                </li>
                                                                <li>
                                                                    4星 <input type="radio" name="suStar" value="4">
                                                                </li>
                                                                <li>
                                                                    5星 <input type="radio" name="suStar" value="5">
                                                                </li>
                                                            </ul>
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p>
                                                            辣度：
                                                            <ul class="eva_lightBox_spStars">
                                                                <li>
                                                                    1星 <input type="radio" name="spStar" value="1">
                                                                </li>
                                                                <li>
                                                                    2星 <input type="radio" name="spStar" value="2">
                                                                </li>
                                                                <li>
                                                                    3星 <input type="radio" name="spStar" value="3">
                                                                </li>
                                                                <li>
                                                                    4星 <input type="radio" name="spStar" value="4">
                                                                </li>
                                                                <li>
                                                                    5星 <input type="radio" name="spStar" value="5">
                                                                </li>
                                                            </ul>
                                                        </p>
                                                    </li>
                                                    <li>
                                                        <p>
                                                            好評度：
                                                            <ul class="eva_lightBox_gdStars">
                                                                <li>
                                                                    1星 <input type="radio" name="gdStar" value="1">
                                                                </li>
                                                                <li>
                                                                    2星 <input type="radio" name="gdStar" value="2">
                                                                </li>
                                                                <li>
                                                                    3星 <input type="radio" name="gdStar" value="3">
                                                                </li>
                                                                <li>
                                                                    4星 <input type="radio" name="gdStar" value="4">
                                                                </li>
                                                                <li>
                                                                    5星 <input type="radio" name="gdStar" value="5">
                                                                </li>
                                                            </ul>
                                                        </p>
                                                    </li>
                                                </ul>

                                            </td>
                                            <td>
                                                <p>留言分享</p>
                                                <textarea name="textDiscuss" cols="50" rows="10"
                                                    class="eva_lightBox_textDics"></textarea>
                                            </td>
                                            <td>
                                                <div class="evaContent evaSend">
                                                    <input type='button' id="<?php echo $order_listArr[$i]['snackNo'] ?>" class="step sendEva" value="送出表單" >
                                                </div>
                                            </td>
                                    </tr>
                                
                    <?php 
                               }  
                        ?>
                       
                            </table>
                        </div>
                    </div>

                </div>

                <?php 
                    }  
                }
            ?>



            </div>
            <!-- <------------------收藏品-------------------- -->
            <div class="tabPanel " id="tab-3">

                <div class="collect" id="getCollect">

                </div>
            </div>
            <!------優惠券----->
            <div class="tabPanel " id="tab-4">
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





    <footer>

        <div id="floor">
            <img src="../images/nnnnn/floor.png" alt="floor">
            <p id="copy">Copyright©2019 Snack Master</p>
        </div>

    </footer>




</body>

<script>
//判斷點擊哪一個 tab
function tabClick(e) {
    var tab = e.target.parentNode.id;

    switch (tab) {
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
//訂單管理
// function orderList() {
//     var xhr = new XMLHttpRequest();
//     xhr.onload = function() {
//         if (xhr.status == 200) {





//         }else {
//             alert(xhr.status);
//         }  


//         var url = "memOrderList.php";
//         xhr.open("Get", url, true);
//         xhr.send(null);

//     }



//收藏清單
function getCollection() {
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (xhr.status == 200) {
            document.getElementById("getCollect").innerHTML = xhr.responseText;
            //trash
            var trash = document.getElementsByClassName('trash');
            var length = trash.length;
            for (var i = 0; i < length; i++) {
                trash[i].addEventListener('click', deletTrash);
            }
            var trashIcon = document.getElementsByClassName('fa-trash-alt');
            var length2 = trashIcon.length;
            for (var j = 0; j < length2; j++) {
                trashIcon[j].addEventListener('click', deletTrash);
            }
        } else {
            alert(xhr.status);
        }
    }

    var url = "memGetCollect.php";
    xhr.open("Get", url, true);
    xhr.send(null);
}

//deletTrash
function deletTrash(e) {
    if (e.target.className.indexOf('fa') == -1) {
        var snackNo = e.target.id;
    } else {
        e.stopPropagation();
        var snackNo = e.target.parentNode.id;
    }

    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (xhr.status == 200) {
            if (xhr.responseText != 'true') {
                alert(xhr.responseText);
            } else {
                getCollection();
            }
        } else {
            alert(xhr.status);
        }
    }
    var url = 'removeHeart.php?snackNo=' + snackNo;
    xhr.open('get', url, true);
    xhr.send(null);
}
//優惠眷
function getCoupon() {
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (xhr.status == 200) {
            document.getElementById("coupon").innerHTML = xhr.responseText;
        } else {
            alert(xhr.status);
        }
    }

    var url = "memberGetCoupon.php";
    xhr.open("Get", url, true);
    xhr.send(null);
}




function doFirst() {
    tablinks = document.getElementsByClassName("tablinks");
    for (var num = 0; num < tablinks.length; num++) {
        tablinks[num].addEventListener('click', tabClick);
    }

    var trash = document.getElementsByClassName('trash');
    var length = trash.length;
    for (var i = 0; i < length; i++) {
        trash[i].addEventListener('click', deletTrash);
    }
    var trashIcon = document.getElementsByClassName('fa-trash-alt');
    var length2 = trashIcon.length;
    for (var j = 0; j < length2; j++) {
        trashIcon[j].addEventListener('click', deletTrash);
    }

}



window.addEventListener('load', doFirst, false);
</script>

</html>
    <script src="../js/member.js" defer></script>