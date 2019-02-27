<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="../css/cartShow.css"> -->
    <link rel="stylesheet" href="../css/header.css">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/header.js" defer></script>
    <title>Document</title>
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
                    <!-- <li><a href="?loglout=true"><span id="btnloglout">&nbsp</span></a></li> -->
                    <li><span id="btnloglout">&nbsp</span></li>
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
<!-- 
</body>
</html> -->
