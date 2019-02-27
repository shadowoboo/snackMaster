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
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>會員專區</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/nnnnn.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/memberM.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/header.js" defer></script>
    <!-- <script src="../js/upgrade.js"></script> -->
    
    
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

    <div class="title">
        <h2>會員專區</h2>
    </div>

    <form action="memUpdate.php" method="post" enctype="multipart/form-data" id="memInfo">
        <div class="memberWrap">
            <div class="mLeft">
                <div class="memPic">
                    <img src="../images/<?php 
                                if(isset($_SESSION["memPic"])==true){
                                    // echo "no picture";
                                    echo $_SESSION["memPic"];
                                }else {
                                    echo $memRow["memPic"];
                                }

                             ?>" alt="memberPic">
                </div>
                <div class="picRe">
                    <span>上傳大頭貼
                    <img src="../images/tina/pen.png" alt="編輯">
                    </span>
                    <!-- <input type="file" name="upFile" id="upFile"> -->
                </div>
            </div>

            <div class="mRight">
                <table>
                    <tr>
                        <td>
                            <input type="hidden" name="memNo" value="<?php echo $memRow["memNo"];?>">
                            會員編號:
                        </td>
                        <td>
                            <?php echo $memRow["memNo"];?>
                        </td>
                    </tr>
                    <tr>
                        <td id="memIfon-p">帳號:</td>
                        <td>
                            <input type="text" name="memId" value="<?php echo $memRow["memId"];?>" maxlength="15"
                                id="memIfon" > 
                                <!-- 還未增加readonly，修改input樣式要改變css未調 -->
                        </td>
                    </tr>
                    <tr>
                        <td>密碼:</td>
                        <td>
                            <input type="password" name="memPsw" value="<?php echo $memRow["memPsw"];?>" maxlength="15" autofocus>
                        </td>
                    </tr>
                    <tr>
                        <td>姓名:</td>
                        <td>
                            <input type="text" name="memName" value="<?php echo $memRow["memName"];?>" maxlength="12">
                        </td>
                    </tr>
                    <tr>
                        <td>電話:</td>
                        <td>
                            <input type="number" name="phone" value="<?php echo $memRow["memPhone"];?>" maxlength="10">
                        </td>
                    </tr>
                    <tr>
                        <td>信箱:</td>
                        <td>
                            <input type="email" name="email" value="<?php echo $memRow["email"];?>" maxlength="20">
                        </td>
                    </tr>
                    <tr>
                        <td>成就:</td>
                        <td id="gradeName">
                            <?php echo $levRow["gradeName"];?>
                        </td>
                    </tr>
                    <tr>
                        <td>積分:</td>
                        <td id="memPoint">
                            <?php echo $memRow["memPoint"];?>
                        </td>
                    </tr>
                </table>
                <div class="confirmBtn">
                <a href="#">
                <button class="subscribe" id="btnmodify">確認修改</button>
                </a>
                </div>
            </div>
        </div>
    </form>
    
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

    <div class="memberBox">
        <!-- 累積成就 -->
        <div class="tabPanel machive" id="tab-1">
            <!-- 血條 -->
            <div class="blood"></div>
            <!-- 積分說明 -->
            <h4>成就積分規則說明</h4>
            <div class="memDes">
                <div class="level">
                    <p>等級制度</p>
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
                <div class="upMission">
                    <p>升等條件</p>
                    <ul>
                        <li>Level 1 : 100積分</li>
                        <li>Level 2 : 1200積分</li>
                        <li>Level 3 : 3600積分</li>
                        <li>Level 4 : 7200積分</li>
                        <li>Level 5 : 12000積分</li>
                        <li>Level 6 : 18000積分</li>
                    </ul>
                </div>
                <div class="how">
                    <p>如何獲得積分？</p>
                    <ul>
                        <li>每完成一則評價獲得100積分</li>
                        <li>每按讚1次獲得1積分</li>
                    </ul>
                </div>
                <div class="loseRule">
                    <p>扣分規則</p>
                    <ul>
                        <li>被檢舉成立收回該評價</li>
                        <li>並收回100分及該評價按讚數積分</li>
                    </ul>
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

                    <a href="#">
                    <button class="goToCustom" <?php echo $check ?>>領取升等獎勵</button>
                    </a>
                </div>
            </div>


        </div>

        <!-- 訂單管理 -->
        <div class="tabPanel" id="tab-2">

        </div>

        <!-- 收藏商品 -->
        <div class="tabPanel" id="tab-3">
                <div class="collect" id="getCollect">

                </div>
        </div>

        <!-- 優惠券管理 -->
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

    <footer class="footer">
        <div id="floor">
            <img src="../images/nnnnn/floor.png" alt="floor">
            <p id="copy">Copyright©2019 Snack Master</p>
        </div>
    </footer>


    <!-- <script>
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
    </script> -->
    <script>
        function changeTabs(evt, tabList) {
            var i, tablinks, tabPanel;
            tabPanel = document.getElementsByClassName("tabPanel");
            for (i = 0; i < tabPanel.length; i++) {
            tabPanel[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");

            }
            document.getElementById(tabList).style.display = "block";

            evt.currentTarget.className += " active";
        }

  // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
    
</body>
</html>