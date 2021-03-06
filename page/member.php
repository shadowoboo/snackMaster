<?php 
    ob_start();
    session_start();
    //未登入直接跳轉到首頁
    if( isset($_SESSION['g2memId']) == false ){
        unset ($_SESSION["g2memId"]);
        header('location:homePage.php');
    }
    // 點擊登出，會員資料要清空
    // 跳轉回首頁
    if (isset($_REQUEST["btnloglout"]) && ($_REQUEST["btnloglout"]=="true")) {
        //登出資料要清空
        unset ($_SESSION["g2memNo"]);
        unset ($_SESSION["g2memId"]);
        //跳轉回首頁
        header("Location: homePage.php");
      
    }
    
    $errMsg = "";
    try{
        require_once('connectcd105g2.php');
        //會員基本資料
        //用No找到該筆會員資料
        $memNo =$_SESSION["g2memNo"];
        //從會員裡的會員編號找出其他相關欄位
        $sql = "select * from member where memNo=:memNo";        
        $members = $pdo->prepare($sql);
        $members ->bindValue(":memNo", $memNo);
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
    <link rel="stylesheet" href="../css/memberEva.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/loginBox.css">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/header.js" defer></script>
    <script src="../js/member.js" defer></script>
    <script src="../js/upgrade.js"></script>
    <script src="../js/addCart.js"></script>
    <script src="../js/alert.js"></script>

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
                            <span class="leave"><i class="fas fa-times"></i></span>
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
            <span id="lightBoxLeave"><i class="fas fa-times"></i></span>
        </div>
        <div class="loginTab-content">
            <h3 id="open">登入</h3>
            <!-----------------------------------登入表單------------------------------------  -->
            <form id="Loginpage" class="tabContent">
                <table class="loginBox">
                    <tr>
                        <td>
                            <label class="Box-name" for="loginMemId">帳號</label>
                            <input type="text" name="loginMemId" id="loginMemId" autocomplete="off">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="Box-name" for="loginMemPsw">密碼</label>
                            <input type="password" name="loginMemPsw" id="loginMemPsw">
                            <p id="forgetPswLink" onclick="changeway(event,'forgetPsw')"> 忘記密碼?</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="button" id="btnLogin" value="登入" class="loginBoxBtn">
                        </td>
                    </tr>
                </table>
                <p id="signUpBtn" onclick="changeway(event,'signup')">註冊會員</p>
            </form>
            <!------------------------------------------------註冊表單------------------------------------------  -->
            <form id="signup" class="tabContent">
                <table class="signUpBox">
                    <tr>
                        <td>
                            <label class="Box-name" for="signUpMemId">帳號</label>
                            <input type="text" name="signUpMemId" id="signUpMemId" autocomplete="off"
                                placeholder="英數字2~10碼">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="Box-name" for="signUpMemPsw">密碼</label>
                            <input type="password" name="signUpMemPsw" id="signUpMemPsw" placeholder="英數字2~10碼">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="Box-name mail" for="signUpMemEmail">信箱</label>
                            <input type="email" name="signUpMemEmail" id="signUpMemEmail" autocomplete="off">
                        </td>
                    </tr>
                    <tr>
                        <td class="formBtn">
                            <input type="button" id="btnSignUp" value="註冊" class="loginBoxBtn">
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
                            <input type="text" name="forgetMemId" id="forgetMemId" autocomplete="off">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="Box-name mail" for="forgetMemEmail">信箱</label>
                            <input type="email" name="forgetpMemEmail" id="forgetpMemEmail" autocomplete="off">
                        </td>
                    </tr>
                    <tr>
                        <td class="formBtn">
                            <input type="button" id="forgetSend" value="寄送" class="loginBoxBtn">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>


    <div class="title">
        <h2>會員專區</h2>
    </div>

    <section class="memWrap">
        <form method="post" enctype="multipart/form-data" id="memInfo">
            <table class="col-12 col-1">
                <tr>
                    <td>
                        <div>
                            <img id="headPic"
                                src="../images/<?php 
                                if(isset($_SESSION["g2memPic"])==true){
                                    // echo "no picture";
                                    echo $_SESSION["g2memPic"];
                                }else {
                                    echo $memRow["memPic"];
                                }
                             ?>">
                        </div>
                        <label class="memPic" for="upFile">
                            <!-- <p>上傳大頭貼<img src="../images/tina/pen.png" alt="編輯"></p> -->
                            <p>上傳大頭貼<i class="fas fa-pen"></i></p>
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
                        <p >
                            帳號：
                            <input type="text" name="memId" value="<?php echo $memRow["memId"];?>" maxlength="15"
                                id="memId" readonly>   
                            <i class="fas fa-pen" onclick="modInfon1()"></i>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            密碼：
                            <input type="password" name="memPsw" value="<?php echo $memRow["memPsw"];?>" maxlength="15"
                                readonly id="password">
                            <i class="fas fa-pen" onclick="modInfon2()"></i>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            姓名：
                            <input type="text" name="memName" value="<?php echo $memRow["memName"];?>" maxlength="12"
                                readonly id="memName">
                            <i class="fas fa-pen" onclick="modInfon3()"></i>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            電話：
                            <input type="text" name="phone" value="<?php echo $memRow["memPhone"];?>" maxlength="10"
                                readonly id="memPhone">
                            <i class="fas fa-pen" onclick="modInfon4()"></i>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            信箱：
                            <input type="email" name="email" value="<?php echo $memRow["email"];?>" maxlength="20"
                                readonly id="email">
                            <i class="fas fa-pen" onclick="modInfon5()"></i>
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
                            <!-- <button class="subscribe" id="btnmodify" >確認修改</button> -->
                            <input type="button" class="subscribe" id="btnmodify" value="確認修改">
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
                <li class="tablinks " id="defaultOpen" onclick="changeTabs(event,'tab-1')">
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
                        <!-- <span>Level1</span>
                        <span>Level3</span>
                        <span>Level5</span> -->
                        <!-- <span>12385分</span> -->
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
                        <span>積分：0</span>
                        <!-- <span>Level2</span>
                        <span>Level4</span> -->
                        <span>積分：18000</span>
                    </div>

                </div>
                <div class="description">
                    <h4>成就積分規則說明</h4>
                    <div class="specify">
                        <div class="col4 col4-1">
                            <p>等級制度 :</p>
                            <ul>
                                <li>Level 0 - 零食寶寶</li>
                                <li>Level 1 - 零食小鬼</li>
                                <li>Level 2 - 零食練習生</li>
                                <li>Level 3 - 零食學霸</li>
                                <li>Level 4 - 零食科學家</li>
                                <li>Level 5 - 零食博士</li>
                                <li>Level 6 - 大零食家</li>
                            </ul>
                        </div>
                        <div class="col4 col4-2">
                            <p>升等條件 :</p>
                            <ul>
                                <li>Level 1 : 100積分</li>
                                <li>Level 2 : 1200積分</li>
                                <li>Level 3 : 3600積分</li>
                                <li>Level 4 : 7200積分</li>
                                <li>Level 5 : 12000積分</li>
                                <li>Level 6 : 18000積分</li>
                            </ul>

                        </div>
                        <div class="col4 col4-3">
                            <p>如何獲得積分？</p>
                            <ul>
                                <li>每完成一則評價獲得100積分</li>
                                <li>每被按讚1次獲得1積分</li>
                            </ul>

                        </div>
                        <div class="col4 col4-4">
                            <p>扣分規則 :</p>
                            <ul>
                                <li>被檢舉成立收回該評價</li>
                                <li>並收回100分及該評價按讚數積分</li>
                            </ul>

                        </div>
                    </div>
                    <div class="btnn">
                        <?php 
    $sql = "select grade, memPoint from member where memNo = {$_SESSION['g2memNo']}";
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
                        echo "<center id='or'>您目前尚無訂單！</center>";
                 }else{
                    while($orderRow = $order->fetch(PDO::FETCH_ASSOC)){
                        $orderNo = $orderRow['orderNo'];
        ?>
                <div class="order">
                    <!-- -------------------------訂單-------------------->
                    <div class="orderList">
                        <table>
                            <tr>
                                <th>訂單編號 :</th>
                                <td><?php echo $orderRow['orderNo'] ?></td>
                            </tr>
                            <tr>
                                <th>下單日期 :</th>
                                <td><?php echo $orderRow['orderTime'] ?></td>
                            </tr>
                            <tr>
                                <th>付款方式 :</th>
                                <td><?php echo $orderRow['payWay'] ?></td>
                            </tr>
                            <tr>
                                <th>出貨狀態 :</th>
                                <td><?php echo $orderRow['orderStatus'] ?></td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <th>收件人地址 :</th>
                                <td><?php echo $orderRow['address'] ?></td>
                            </tr>
                            <tr>
                                <th>收件人電話 :</th>
                                <td><?php echo $orderRow['phone'] ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="total">
                        <p>總額 : <?php echo $orderRow['orderTotal'] ?></p>
                    </div>
                    <!-----------------訂單明細------------------------  -->
                    <div class="orderitem">
                        <p class="orderList_btn">訂單明細 v</p>
                        <div class=line></div>

                        <!-- ------------------------手機版html-------------------------------------- -->
                        <div class="orderLis_content">
                            <ul class="orderList_items_title">
                                <li>商品</li>
                                <li>品名</li>
                                <li>數量</li>
                                <li>單價</li>
                                <li>小計</li>
                                <li>備註</li>
                                <li>評價狀態</li>
                            </ul>
                            <?php 
              $OL_sql= "select a.snackNo, a.snackName, a.snackPic, a.snackPrice, b.orderNo, b.snackQuan, b.customBoxItem, b.snackNo from snack a join orderItem b on a.snackNo = b.snackNo where orderNo=:orderNo";
                          $order_list =$pdo->prepare($OL_sql);
                          $order_list->bindValue(":orderNo",$orderNo);
                          $order_list->execute();

                          $order_listArr = $order_list->fetchAll(PDO::FETCH_ASSOC);
                          $OLrowcount = $order_list->rowCount(); 

                          for($i=0;$i<$OLrowcount;$i++){ 
                              $snackNo=$order_listArr[$i]['snackNo'] ;  
                              $orderNo = $order_listArr[$i]['orderNo'];
                ?>
                            <ul class="orderList_moreItems">
                                <li>
                                    <img src="<?php echo $order_listArr[$i]['snackPic'] ?> " alt="">

                                </li>
                                <li>
                                    <?php echo $order_listArr[$i]['snackName'] ?>
                                </li>
                                <li>
                                    <?php echo $order_listArr[$i]['snackQuan'] ?>
                                </li>
                                <li>
                                    <?php echo $order_listArr[$i]['snackPrice'] ?>
                                </li>
                                <li>
                                    <?php echo $order_listArr[$i]['snackPrice']*$order_listArr[$i]['snackQuan'] ?>
                                </li>
                                <li>
                                    <?php 
                                        $note_msg="";
                                        try{
                                            $note_sql ="select customBoxItem from orderitem where orderNo=:orderNo";
                                            $note =$pdo->prepare($note_sql);
                                            $note->bindValue(":orderNo",$orderNo);
                                            $note->execute();

                                            $noteCount = $note->rowCount();
                                            
                                            if($noteCount !==0){
                                                echo "一般";
                                            }else{
                                                echo "客製";
                                            }
                                        }catch(PDOException $e){
                                            echo "失敗",$e->getMessage();
                                            echo "行號",$e->getLine();
                                        }
                                    
                                    ?>
                                </li>
                                <li>
                                    <?php
                                        $eva_msg="";
                                        try{
                                            $eva_sql = "select * from  eva where memNo=:memNo and snackNo=:snackNo";
                                            $eva =$pdo->prepare($eva_sql);
                                            $eva->bindValue(":memNo",$memNo);
                                            $eva->bindValue(":snackNo",$snackNo);
                                            $eva->execute();

                                            $evaCount = $eva->rowCount();
                                            if($orderRow['orderStatus']=='運送中'){
                                                echo '<button class="orderList_eva_done cart" type="button">運送中</button>';

                                            }else{
                                                if($evaCount>0){
                                                    echo '<button class="orderList_eva_done cart" type="button">已評價</button>';
                                                }else{
                                                    echo '<button class="orderList_eva cart" type="button">未評價</button>';
                                                }
                                            }
                                            
                                        } catch(PDOException $e){
                                            echo "失敗",$e->getMessage();
                                            echo "行號",$e->getLine();
                                        }
                                        
                                    ?>
                                </li>
                            </ul>

                            <!----------------------------------評價燈箱-------------------------  -->
                            <div class="eva_lightBox" name="snackNo<?php echo $order_listArr[$i]['snackNo'] ?>">
                                <span class="eva_lightBox_leave"><i class="fas fa-times"></i></span>
                                <div class="eva_Boxing">
                                    <div class="evaContent boxing">
                                        <img src="<?php echo $order_listArr[$i]['snackPic'] ?>" alt="商品圖">
                                        <p><?php echo $order_listArr[$i]['snackName'] ?></p>
                                    </div>
                                    <div class="eva_lightBox_Starts boxing">
                                        <ul>
                                            <li>
                                                <p>
                                                    甜度：
                                                    <ul class="eva_lightBox_swStars">
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="swStar" value="1" >
                                                                <span>1星</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="swStar" value="2">
                                                                <span>2星</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="swStar" value="3">
                                                                <span>3星</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="swStar" value="4">
                                                                <span>4星</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="swStar" value="5" checked>
                                                                <span>5星</span>
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </p>
                                            </li>
                                            <li>
                                                <p>
                                                    辣度：
                                                    <ul class="eva_lightBox_spStars">
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="spStar" value="1">
                                                                <span>1星</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="spStar" value="2">
                                                                <span>2星</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="spStar" value="3">
                                                                <span>3星</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="spStar" value="4">
                                                                <span>4星</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="spStar" value="5" checked>
                                                                <span>5星</span>
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </p>
                                            </li>
                                            <li>
                                                <p>
                                                    酸度：
                                                    <ul class="eva_lightBox_suStars">
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="suStar" value="1">
                                                                <span>1星</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="suStar" value="2">
                                                                <span>2星</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="suStar" value="3">
                                                                <span>3星</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="suStar" value="4">
                                                                <span>4星</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="suStar" value="5" checked>
                                                                <span>5星</span>
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </p>
                                            </li>
                                            <li>
                                                <p>
                                                    好評度：
                                                    <ul class="eva_lightBox_gdStars">
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="gdStar" value="1">
                                                                <span>1星</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="gdStar" value="2">
                                                                <span>2星</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="gdStar" value="3">
                                                                <span>3星</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="gdStar" value="4">
                                                                <span>4星</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="gdStar" value="5" checked>
                                                                <span>5星</span>
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="eva_lightBox_msg boxing">
                                        <p>評價分享</p>
                                        <textarea name="textDiscuss" cols="24" rows="10"
                                            class="eva_lightBox_textDics"></textarea>
                                    </div>
                                </div>
                                <div class="eva_lightBox_send evaSend">
                                    <input type='submit' id="<?php echo $order_listArr[$i]['snackNo'] ?>"
                                        class="step sendEva" value="送出評價">
                                </div>

                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <!-- -------------------------------手機版html結束----------------------------- -->


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

    <!-- <footer>
        <div id="floor">
            <img src="../images/nnnnn/floor.png" alt="floor">
            <p id="copy">Copyright©2019 Snack Master</p>
        </div>
    </footer> -->

</body>

<script>
//判斷點擊哪一個 tab
function tabClick(e) {
    var tab = e.target.parentNode.id;
    switch (tab) {
        case 'tab33':
            getCollection();
            break;
        case 'tab44':
            getCoupon();
            break;
    }
}

//評價表單送出
function addBtnEva() {
    $('.sendEva').click(function() {
        var snackNo = $(this).attr('id');
        var evaCtx = $(`div[name=snackNo${snackNo}] textarea`).val();
        var sweetStar = $(`div[name=snackNo${snackNo}] input[name=swStar]:checked`).val();
        var sourStar = $(`div[name=snackNo${snackNo}] input[name=suStar]:checked`).val();
        var spicyStar = $(`div[name=snackNo${snackNo}] input[name=spStar]:checked`).val();
        var goodStar = $(`div[name=snackNo${snackNo}] input[name=gdStar]:checked`).val();
        if($(`div[name=snackNo${snackNo}] input:checked`).length!=4){
            alertBox("請至少填寫各項星等，才能送出評價");
        }
        else{
            var data_info =
                `snackNo=${snackNo}&evaCtx=${evaCtx}&goodStar=${goodStar}&sourStar=${sourStar}&sweetStar=${sweetStar}&spicyStar=${spicyStar}`;
            var xhr = new XMLHttpRequest();
            xhr.open("Post", "sendEva.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send(data_info);
            xhr.onload = function() {
                alertBox("感謝您提供的評價，會員積分加100分～");
                var tarBtn = $(`div[name=snackNo${snackNo}]`).prev("ul").find("button");
                // console.log(tarBtn);
                tarBtn.text("已評價");
                tarBtn.attr("class", "orderList_eva_done cart");
                $(`div[name=snackNo${snackNo}]`).remove();
                document.getElementById('memPoint').innerText = parseInt(document.getElementById('memPoint').innerText) + 100;
            }
        }
    });
}


window.addEventListener('load', addBtnEva, false);






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
            var carts = document.getElementsByClassName('cart');
            var length = carts.length;
            for (var i = 0; i < length; i++) {
                carts[i].addEventListener('click', addCart);
            }
        } else {
            alertBox(xhr.status);
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
    confirmBox('確定要刪除收藏嗎？', function (){
        var xhr = new XMLHttpRequest();
        xhr.onload = function() {
            if (xhr.status == 200) {
                if (xhr.responseText != 'true') {
                    alertBox(xhr.responseText);
                } else {
                    getCollection();
                }
            } else {
                alertBox(xhr.status);
            }
        }
        var url = 'removeHeart.php?snackNo=' + snackNo;
        xhr.open('get', url, true);
        xhr.send(null);
    })
}
//優惠券
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

    var gdRadio = document.getElementsByName('gdStar');
    for(var k = 0 ; k < 5; k++){
        gdRadio[k].addEventListener('click', function (e){
            for( k = 0; k < 5; k++){
                gdRadio[k].removeAttribute('checked');
            }
            e.target.setAttribute('checked', true);
        })
    }
    var suRadio = document.getElementsByName('suStar');
    for(var l = 0 ; l < 5; l++){
        suRadio[l].addEventListener('click', function (e){
            for( l = 0; l < 5; l++){
                suRadio[l].removeAttribute('checked');
            }
            e.target.setAttribute('checked', true);
        })
    }
    var spRadio = document.getElementsByName('spStar');
    for(var m = 0 ; m < 5; m++){
        spRadio[m].addEventListener('click', function (e){
            for( m = 0; m < 5; m++){
                spRadio[m].removeAttribute('checked');
            }
            e.target.setAttribute('checked', true);
        })
    }
    var swRadio = document.getElementsByName('swStar');
    for(var n = 0 ; n < 5; n++){
        swRadio[n].addEventListener('click', function (e){
            for( n = 0; n < 5; n++){
                swRadio[n].removeAttribute('checked');
            }
            e.target.setAttribute('checked', true);
        })
    }
}



window.addEventListener('load', doFirst, false);
</script>

</html>