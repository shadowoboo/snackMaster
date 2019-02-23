<?php
    ob_start();
    session_start();
    
    $errMsg = "";
    try {
        require_once("connectcd105g2.php");
        $recPerPage = 9;
        $sql = 'select count(snackNo) from snack';
        $countSta = $pdo -> query($sql);
        $totalRec = $countSta -> fetchColumn();
        $pages = ceil($totalRec/$recPerPage);
        if( isset($_REQUEST['pageNum']) ){
            $pageNum = $_REQUEST['pageNum'];
        }else{
            $pageNum = 1;
        }
        $start = ($pageNum - 1) * $recPerPage;
        if( isset($_REQUEST['search']) == false ){
            $sql = "select * from snack where snackGenre != '客製箱' and snackGenre != '預購箱' limit $start, $recPerPage";
        }else{
            $search= $_REQUEST['search'];
            $sql = "select * from snack where snackName != '客製箱' and snackGenre != '預購箱' $search limit 0, 9";
        }
        $snacks = $pdo -> query($sql); 
        if( $snacks -> rowCount() == 0){
            $searchMsg = 'oops';
            $sql = "select * from snack where snackName != '客製箱' and snackGenre != '預購箱' limit $start, $recPerPage";
            $snacks = $pdo -> query($sql); 
        }

    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <title>大零食家 - 零食列表</title>
    <link rel="stylesheet" href="../css/nnnnn.css">
    <link rel="stylesheet" href="../css/shopping.css">
    <script src="../js/common.js"></script>
    <script src="../js/Chart.js"></script>
    <script src="../js/shopping.js"></script>
    <script src="../js/addHeart.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/showStar.js"></script>
    <script src="../js/findingIp.js"></script>
    <script src="../js/addCart.js"></script>

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
                    <!-- <img src="../images/tina/search-icon.svg" alt="" id="searchBtn"> -->
                    <img src="" alt="" id="searchBtn">
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
                    </div>
                    <div id="list_appear">
                        <!-- ----------手機選單離開-------- -->
                        <div id="cros">
                            <span class="leave">X</span>
                        </div>
                        <ul class="list">
                            <li><a href="rankBoard.php">零食排行榜</a></li>
                            <li><a href="customized.php">客製零食箱</a> </li>
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
                    <li><i class="fas fa-user-circle" id="memLogin"></i></li>
                    <li id="goCartShow"><a href="cartShow.php"><i class="fas fa-shopping-cart" id="shopCart"></i></a></li>
                </ul>
            </nav>
            <!-- <div class="seachRegion" id="search_appear">
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
            </div> -->
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

    <div class="shopping">
        <div class="wrap">
            <div class="title">
                <h2>零食列表</h2>
            </div>
            <div class="searchBar">
                <img src="../images/blair/pocky.png" alt="search">
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
                <input type="text" id="searchName" placeholder="想找什麼零食呢？">
                <i class="fas fa-search" id="searchClick"></i>
            </div>
            <div class="items">
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    if( isset($searchMsg)){
?>
        <div id="searchNone">
            <p id="searchMsg">哎呀! 目前沒有符合搜尋條件的商品，請參考以下推薦商品</p>
            <img id="searchImg" src="../images/blair/oops.png" alt="oops">
        </div>
<?php
    }
    $i = 1;
    while($snackRow = $snacks -> fetch()){
        if($i > 6){
            $color = 'green';
        }else if($i > 3){
            $color = 'blue';
        }else{
            $color = 'red';
        }
        $i++;
?>
                <div class="item <?php echo $color ?>" id="<?php
                        $good = round($snackRow['goodStars'] / $snackRow['goodTimes'], 1);
                        $sour = round($snackRow['sourStars'] / $snackRow['sourTimes'], 1);
                        $sweet = round($snackRow['sweetStars'] / $snackRow['sweetTimes'], 1);
                        $spicy = round($snackRow['spicyStars'] / $snackRow['spicyTimes'], 1);
                        echo "$good|$sour|$sweet|$spicy";
                    ?>">
                    <a href="showItem.php?snackNo=<?php echo $snackRow['snackNo'] ?>"></a>
                    <img class="country" src="../images/blair/<?php echo $snackRow['nation'] ?>.png" alt="nation">
                    <img class="itemImg" src="<?php echo $snackRow['snackPic']?>" alt="snack">
                    <h4 class="itemName"><?php echo '['.$snackRow['nation'].']'.$snackRow['snackName']?></h4>
                    <div class="star" grad="<?php echo $good;?>">
                        <img src="../images/rankBoard/starMask.png" alt="星等">
                    </div>
                    <p class="price">$<?php echo $snackRow['snackPrice']?></p>
                    <div class="itemBtns">
                        <button class="cart" id="<?php echo "{$snackRow['snackNo']}|{$snackRow['snackPrice']}|0" ?>">加入購物車</button>
                        <button class="heart" id="<?php echo $snackRow['snackNo'] ?>"><i class="far fa-heart"></i></button>
                    </div>
                </div> 
<?php
	}
?>
                <div class="clearfix"></div>
            </div>
            <div id="pagination">
                <ul>
                    <?php
                        if( isset($_REQUEST['search']) == false ){
                            $prev = $pageNum - 1 == 0? 1:$pageNum - 1;
                            $next = $pageNum + 1 == 7? 6:$pageNum + 1;
                            echo '<li class="page-item"><a href="shopping.php?pageNum='.$prev.'" id="last" class="page-link"><i class="fas fa-chevron-left"></i></a></li>';
                            for($i=1; $i<=$pages; $i++){
                                if( $i == $pageNum ){
                                    echo '<li class="page-item"><a href="shopping.php?pageNum='.$i.'" class="page-link nowLoc">'.$i.'</a></li>';
                                }else{
                                    echo '<li class="page-item"><a href="shopping.php?pageNum='.$i.'" class="page-link">'.$i.'</a></li>';
                                }
                            }
                            echo '<li class="page-item"><a href="shopping.php?pageNum='.$next.'" id="next" class="page-link"><i class="fas fa-chevron-right"></i></a></li>';
                        }
                    ?>
                </ul>
            </div>
            <div class="mint">
                <div class="info">
                    <h4 id="goodTitle"></h4>
                    <span id="mintStar"></span>
                    <span id="mintFive"></span>
                    <!-- <h4>好評度</h4>
                    <span id="mintStar">3</span>
                    <span id="mintFive">/5</span>
                    <div class="star" grad="3" id="starShow">
                        <img src="../images/rankBoard/starMask.png" alt="星等">
                    </div> -->
                    <h4 id="msg">我可以告訴你商品的評價星等喔!</h4>
                </div>
                <div class="radar">
                    <canvas id="radarCanvas"></canvas>
                </div>
                <img class="mintImg" src="../images/blair/mint.png" alt="mint">
            </div> 

        </div>
        <img id="bgChips" src="../images/blair/bgChips.png" alt="chips">
        <img src="../images/blair/5-1.png" alt="chips" id="bgChips1">
        <img src="../images/blair/5-2.png" alt="chips" id="bgChips2">
        <img src="../images/blair/5-3.png" alt="chips" id="bgChips3">
        <img src="../images/blair/5-4.png" alt="chips" id="bgChips4">
        <img src="../images/blair/5-5.png" alt="chips" id="bgChips5">
        <img src="../images/blair/5-6.png" alt="chips" id="bgChips6">
        <img src="../images/blair/5-1.png" alt="chips" id="bgChips7">
        <img src="../images/blair/5-2.png" alt="chips" id="bgChips8">
        <img src="../images/blair/5-3.png" alt="chips" id="bgChips9">
        <img src="../images/blair/5-4.png" alt="chips" id="bgChips10">
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
    <script src="../js/header.js"></script>
</body>
</html>