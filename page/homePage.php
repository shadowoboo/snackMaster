
<?php
    session_start();
	//判斷有無例外，沒有例外則執行try，有例外則執行catch
	try{
        require_once("connectcd105g2.php");
        // var_dump($snackRows);exit();
	}catch(PDOException $e){
		echo "失敗,原因:",$e -> getMessage();
        echo "行號:",$e -> getLine();
        // exit( );
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="../js/TweenMax.min.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/Chart.js"></script>
    <script src="../js/header.js" defer></script>
    <script src="../js/homePage.js"></script>
    <script src="../js/common.js"></script>
    <script src="../js/findingIp.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/showStar.js"></script>
    <script src="../js/addHeart.js"></script>
    <script src="../js/addCart.js"></script>
    <link rel="stylesheet" href="../css/boxModel.css">
    <link rel="stylesheet" href="../css/sale.css">
    <link rel="stylesheet" href="../css/homePage.css">
    <!-- <link rel="stylesheet" href="../css/header.css"> -->
    <title>Home Page</title>
</head>

<body>
    <div class="index">
        <header>
            <h1>大零食家</h1>
            <div class="cloud">
                <div class="doc doc--bg2">
                    <canvas id="canvas"></canvas>
                </div>
                <nav>
                    <label for="smlSearch" class="searchBtn" value="search">
                        <!-- <img src="../images/tina/search-icon.svg" alt="" id="searchBtn"> -->
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
                                <li id="goRankBoard"><a href="rankBoard.php">零食排行榜</a></li>
                                <li id="goCustomized"><a href="customized.php">客製零食箱</a> </li>
                                <!-- 在手機上要關掉這個li的logo -->
                                <li ><a href="homePage.php"><img src="../images/tina/LOGO1.png" alt="大零食家"></a></li>
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
                        <li><span id="btnloglout">&nbsp</span></li>
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
                            <input type="text"  id="searchName" placeholder="想找什麼零食呢？">
                            <i class="fas fa-search"  id="searchClick"></i>
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
                    <li class="loginTab"  id="open" onclick="changeway(event,'Loginpage')">登入</li>
                    <li class="loginTab"   onclick="changeway(event,'signup')">註冊</li>
                </ul>
                <div class="loginTab-content">
                    <!-----------------------------------登入表單------------------------------------  -->
                    <form  id="Loginpage" class="tabContent">
                        <table class="loginBox">
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
                                        <input type="password" name="loginMemPsw" id="loginMemPsw" size="12" placeholder="請輸入密碼">
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

                        </table>
                    </form>
            <!------------------------------------------------註冊表單------------------------------------------  -->
                    <form  id="signup" class="tabContent">
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
                                    <input type="password" name="signUpMemPsw" id="signUpMemPsw" size="12" placeholder="請輸入密碼">
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <label class="Box-name mail" for="signUpMemEmail">信箱</label>
                                    <input type="email" name="signUpMemEmail" id="signUpMemEmail" size="20" autocomplete="off">
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
                    <form  id="forgetPsw" class="tabContent">
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
                                    <input type="email" name="forgetpMemEmail" id="forgetpMemEmail" size="20" autocomplete="off">
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

        
        <div class="searchBar">
            <img src="../images/blair/pocky.png" alt="搜尋圖">
            <select name="country" id="country">
                <option value="0">國家</option>
                <option value='巴西'>巴西</option>
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

        <!-- <div class="searchBar">
            <img src="../images/blair/pocky.png" alt="搜尋圖">
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
            <input type="text" placeholder="想找什麼零食呢？">
            <i class="fas fa-search"></i>
        </div> -->

        

        <section class="worldMap">
            <?php 
                $country=array("美國","德國","巴西","英國","埃及","韓國","日本","澳洲");
                // arr_country: 美國,美國,德國,巴西,英國,埃及,韓國,日本,澳洲
                $ln=count($country);
                $arr_row=array();

                $i=0;
                // echo $ln; 
                for($i=0; $i<$ln; $i++){
                    $sql = "select MAX(snackNo),snackNo,nation,snackName,snackWord,snackPic,snackPrice from snack WHERE nation= ? group by snackNo ORDER by MAX(snackNo) DESC limit 1";
                    $prodRow = $pdo->prepare($sql); //執行上面的指令傳回陣列
                    // $aa=$country[$i];
                    // echo $country[$i]; 
                    $prodRow -> bindValue(1, $country[$i]);

                    // echo $country[$i]; exit();
                    // echo print_r($country); exit();

                    $prodRow -> execute(); 
                    $row = $prodRow->fetch(); //需求送出去，資料抓回來，阿凱發大財
                    array_push($arr_row,$row);
                    // print_r($arr_row);
                    // print_r($row);
                } 
            ?>
            <div class="mapCount">
                <div class="countryMap">
                    <img src="../images/index/map1.svg" id="testMap">
                        <div class="countryImg">
                            <img src="../images/index/US.png" alt="美國座標">
                                <div class="countryInfoLg">
                                    <a href="showItem.php?snackNo=<?php echo $arr_row[0]["snackNo"];?>">  
                                        <div class="countryInfoHeader">
                                            <div class="countryInfoImg">
                                                <img src="<?php echo $arr_row[0]["snackPic"];?>">
                                            </div>
                                            <div class="countryInfoStar">
                                                <ul>
                                                    <li>新品上市！</li>
                                                    <li>川普最愛</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="countryInfosection">
                                            <h3>[<?php echo $arr_row[0]["nation"];?>] <?php echo $arr_row[0]["snackName"];?></h3>
                                            <p><?php echo $arr_row[0]["snackWord"];?></p>
                                        </div>
                                    </a>
                                    <div class="countryInfofooter">
                                        <a href="showItem.php?snackNo=<?php echo $arr_row[0]["snackNo"];?>">
                                            <div class="countryInfoPrice">
                                                <h3>價格<span>$<?php echo $arr_row[0]["snackPrice"];?></span></h3>
                                            </div>
                                        </a>
                                        <div class="countryInfoAddCart">
                                            <button class="cart" id="<?php echo "{$arr_row[0]['snackNo']}|{$arr_row[0]['snackPrice']}|0" ?>">加入購物車</button>
                                        </div>
                                        <div class="countryInfoHeart">
                                            <button class="heart" id="<?php echo $arr_row[0]['snackNo'];?>"><i class="far fa-heart"></i></button>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    
                    
                        <div class="countryImg">
                            <img src="../images/index/DE.png" alt="德國座標">
                            <div class="countryInfoLg">
                                <a href="showItem.php?snackNo=<?php echo $arr_row[1]["snackNo"];?>">
                                    <div class="countryInfoHeader">
                                        <div class="countryInfoImg">
                                            <img src="<?php echo $arr_row[1]["snackPic"];?>">
                                        </div>
                                        <div class="countryInfoStar">
                                            <ul>
                                                <li>新品上市！</li>
                                                <li>德國人氣No.1</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="countryInfosection">
                                        <h3>[<?php echo $arr_row[1]["nation"];?>] <?php echo $arr_row[1]["snackName"];?></h3>
                                        <p><?php echo $arr_row[1]["snackWord"];?></p>
                                    </div>
                                </a>
                                <div class="countryInfofooter">
                                    <a href="showItem.php?snackNo=<?php echo $arr_row[1]["snackNo"];?>">
                                        <div class="countryInfoPrice">
                                            <h3>價格<span>$<?php echo $arr_row[1]["snackPrice"];?></span></h3>
                                        </div>
                                    </a>
                                    <div class="countryInfoAddCart">
                                        <button class="cart" id="<?php echo "{$arr_row[1]['snackNo']}|{$arr_row[1]['snackPrice']}|0" ?>">加入購物車</button>
                                    </div>
                                    <div class="countryInfoHeart">
                                        <button class="heart" id="<?php echo $arr_row[1]['snackNo'];?>"><i class="far fa-heart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    
                        <div class="countryImg">
                            <img src="../images/index/BR.png" alt="巴西座標">
                            <div class="countryInfoLg">
                                <a href="showItem.php?snackNo=<?php echo $arr_row[2]["snackNo"];?>">
                                    <div class="countryInfoHeader">
                                        <div class="countryInfoImg">
                                            <img src="<?php echo $arr_row[2]["snackPic"];?>">
                                        </div>
                                        <div class="countryInfoStar">
                                            <ul>
                                                <li>新品上市！</li>
                                                <li>南美平民零時榜冠軍</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="countryInfosection">
                                        <h3>[<?php echo $arr_row[2]["nation"];?>] <?php echo $arr_row[2]["snackName"];?></h3>
                                        <p><?php echo $arr_row[2]["snackWord"];?></p>
                                    </div>
                                </a>
                                <div class="countryInfofooter">
                                    <a href="showItem.php?snackNo=<?php echo $arr_row[2]["snackNo"];?>">
                                        <div class="countryInfoPrice">
                                            <h3>價格<span>$<?php echo $arr_row[2]["snackPrice"];?></span></h3>
                                        </div>
                                    </a>
                                    <div class="countryInfoAddCart">
                                        <button class="cart" id="<?php echo "{$arr_row[2]['snackNo']}|{$arr_row[2]['snackPrice']}|0" ?>">加入購物車</button>
                                    </div>
                                    <div class="countryInfoHeart">
                                        <button class="heart" id="<?php echo $arr_row[2]['snackNo'];?>"><i class="far fa-heart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    
                        <div class="countryImg">
                            <img src="../images/index/UK.png" alt="英國座標">
                            <div class="countryInfoLg">
                            <a href="showItem.php?snackNo=<?php echo $arr_row[3]["snackNo"];?>">
                                <div class="countryInfoHeader">
                                    <div class="countryInfoImg">
                                        <img src="<?php echo $arr_row[3]["snackPic"];?>">
                                    </div>
                                    <div class="countryInfoStar">
                                        <ul>
                                            <li>新品上市！</li>
                                            <li>英國皇室招待品</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="countryInfosection">
                                    <h3>[<?php echo $arr_row[3]["nation"];?>] <?php echo $arr_row[3]["snackName"];?></h3>
                                    <p><?php echo $arr_row[3]["snackWord"];?></p>
                                </div>
                            </a>
                            <div class="countryInfofooter">
                                <a href="showItem.php?snackNo=<?php echo $arr_row[3]["snackNo"];?>">
                                    <div class="countryInfoPrice">
                                        <h3>價格<span>$<?php echo $arr_row[3]["snackPrice"];?></span></h3>
                                    </div>
                                </a>
                                    <div class="countryInfoAddCart">
                                        <button class="cart" id="<?php echo "{$arr_row[3]['snackNo']}|{$arr_row[3]['snackPrice']}|0" ?>">加入購物車</button>
                                    </div>
                                    <div class="countryInfoHeart">
                                        <button class="heart" id="<?php echo $arr_row[3]['snackNo'];?>"><i class="far fa-heart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    
                    <div class="countryImg">
                        <img src="../images/index/EG.png" alt="埃及座標">
                        <div class="countryInfoLg">
                            <a href="showItem.php?snackNo=<?php echo $arr_row[4]["snackNo"];?>">
                                <div class="countryInfoHeader">
                                    <div class="countryInfoImg">
                                        <img src="<?php echo $arr_row[4]["snackPic"];?>">
                                    </div>
                                    <div class="countryInfoStar">
                                        <ul>
                                            <li>新品上市！</li>
                                            <li>觀光客最愛伴手禮</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="countryInfosection">
                                    <h3>[<?php echo $arr_row[4]["nation"];?>] <?php echo $arr_row[4]["snackName"];?></h3>
                                    <p><?php echo $arr_row[4]["snackWord"];?></p>
                                </div>
                            </a>
                            <div class="countryInfofooter">
                                <a href="showItem.php?snackNo=<?php echo $arr_row[4]["snackNo"];?>">
                                    <div class="countryInfoPrice">
                                        <h3>價格<span>$<?php echo $arr_row[4]["snackPrice"];?></span></h3>
                                    </div>
                                </a>
                                <div class="countryInfoAddCart">
                                    <button class="cart" id="<?php echo "{$arr_row[4]['snackNo']}|{$arr_row[4]['snackPrice']}|0" ?>">加入購物車</button>
                                </div>
                                <div class="countryInfoHeart">
                                    <button class="heart" id="<?php echo $arr_row[4]['snackNo'];?>"><i class="far fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    
                    <div class="countryImg">
                        <img src="../images/index/KR.png" alt="韓國座標">
                        <div class="countryInfoLg">
                            <a href="showItem.php?snackNo=<?php echo $arr_row[5]["snackNo"];?>">
                                <div class="countryInfoHeader">
                                    <div class="countryInfoImg">
                                        <img src="<?php echo $arr_row[5]["snackPic"];?>">
                                    </div>
                                    <div class="countryInfoStar">
                                        <ul>
                                            <li>新品上市！</li>
                                            <li>歐爸推薦商品</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="countryInfosection">
                                    <h3>[<?php echo $arr_row[5]["nation"];?>] <?php echo $arr_row[5]["snackName"];?></h3>
                                    <p><?php echo $arr_row[5]["snackWord"];?></p>
                                </div>
                            </a>
                            <div class="countryInfofooter">
                                <a href="showItem.php?snackNo=<?php echo $arr_row[5]["snackNo"];?>">
                                    <div class="countryInfoPrice">
                                        <h3>價格<span>$<?php echo $arr_row[5]["snackPrice"];?></span></h3>
                                    </div>
                                </a>
                                <div class="countryInfoAddCart">
                                    <button class="cart" id="<?php echo "{$arr_row[5]['snackNo']}|{$arr_row[5]['snackPrice']}|0" ?>">加入購物車</button>
                                </div>
                                <div class="countryInfoHeart">
                                    <button class="heart" id="<?php echo $arr_row[5]['snackNo'];?>"><i class="far fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="countryImg">
                        <img src="../images/index/JP.png" alt="日本座標">
                        <div class="countryInfoLg">
                            <a href="showItem.php?snackNo=<?php echo $arr_row[6]["snackNo"];?>">
                                <div class="countryInfoHeader">
                                    <div class="countryInfoImg">
                                        <img src="<?php echo $arr_row[6]["snackPic"];?>">
                                    </div>
                                    <div class="countryInfoStar">
                                        <ul>
                                            <li>新品上市！</li>
                                            <li>全國零食榜發燒商品</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="countryInfosection">
                                    <h3>[<?php echo $arr_row[6]["nation"];?>] <?php echo $arr_row[6]["snackName"];?></h3>
                                    <p><?php echo $arr_row[6]["snackWord"];?></p>
                                </div>
                            </a>
                            <div class="countryInfofooter">
                                <a href="showItem.php?snackNo=<?php echo $arr_row[6]["snackNo"];?>">
                                    <div class="countryInfoPrice">
                                        <h3>價格<span>$<?php echo $arr_row[6]["snackPrice"];?></span></h3>
                                    </div>
                                </a>
                                <div class="countryInfoAddCart">
                                    <button class="cart" id="<?php echo "{$arr_row[6]['snackNo']}|{$arr_row[6]['snackPrice']}|0" ?>">加入購物車</button>
                                </div>
                                <div class="countryInfoHeart">
                                    <button class="heart" id="<?php echo $arr_row[6]['snackNo'];?>"><i class="far fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="countryImg">
                        <img src="../images/index/AU.png" alt="澳洲座標">
                        <div class="countryInfoLg">
                            <a href="showItem.php?snackNo=<?php echo $arr_row[7]["snackNo"];?>">
                                <div class="countryInfoHeader">
                                    <div class="countryInfoImg">
                                        <img src="<?php echo $arr_row[7]["snackPic"];?>">
                                    </div>
                                    <div class="countryInfoStar">
                                        <ul>
                                            <li>新品上市！</li>
                                            <li>賣場秒殺零食</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="countryInfosection">
                                    <h3>[<?php echo $arr_row[7]["nation"];?>] <?php echo $arr_row[7]["snackName"];?></h3>
                                    <p><?php echo $arr_row[7]["snackWord"];?></p>
                                </div>
                            </a>
                            <div class="countryInfofooter">
                                <a href="showItem.php?snackNo=<?php echo $arr_row[7]["snackNo"];?>">
                                    <div class="countryInfoPrice">
                                        <h3>價格<span>$<?php echo $arr_row[7]["snackPrice"];?></span></h3>
                                    </div>
                                </a>
                                <div class="countryInfoAddCart">
                                    <button class="cart" id="<?php echo "{$arr_row[7]['snackNo']}|{$arr_row[7]['snackPrice']}|0" ?>">加入購物車</button>
                                </div>
                                <div class="countryInfoHeart">
                                    <button class="heart" id="<?php echo $arr_row[7]['snackNo'];?>"><i class="far fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="snackMap" id="container">
                        <div class="snackImg slide1">
                            <img src="../images/index/snack-us.png" alt="零食icon">
                        </div>
                        <div class="snackImg slide2">
                            <img src="../images/index/snack-de.png" alt="零食icon">
                        </div>
                        <div class="snackImg slide3">
                            <img src="../images/index/snack-br.png" alt="零食icon">
                        </div>
                        <div class="snackImg slide4">
                            <img src="../images/index/snack-uk.png" alt="零食icon">
                        </div>
                        <div class="snackImg slide5">
                            <img src="../images/index/snack-eg.png" alt="零食icon">
                        </div>
                        <div class="snackImg slide1">
                            <img src="../images/index/snack-kr.png" alt="零食icon">
                        </div>
                        <div class="snackImg slide2">
                            <img src="../images/index/snack-jp.png" alt="零食icon">
                        </div>
                        <div class="snackImg slide3">
                            <img src="../images/index/snack-au.png" alt="零食icon">
                        </div>
                    </div>
                </div>
                <div class="cloudMap" id="container">
                    <div class="cloudImg slide1">
                        <img src="../images/index/cloud-5.png" alt="地圖雲">
                    </div>
                    <div class="cloudImg slide2">
                        <img src="../images/index/cloud-6.png" alt="地圖雲">
                    </div>
                    <div class="cloudImg slide3">
                        <img src="../images/index/cloud-7.png" alt="地圖雲">
                    </div>
                    <div class="cloudImg slide4">
                        <img src="../images/index/cloud-1.png" alt="地圖雲">
                    </div>
                    <div class="cloudImg slide5">
                        <img src="../images/index/cloud-2.png" alt="地圖雲">
                    </div>
                    <div class="cloudImg slide1">
                        <img src="../images/index/cloud-3.png" alt="地圖雲">
                    </div>
                </div>
                <div class="balloonMap">
                    <div class="ballImg">
                        <img src="../images/index/green-balloon.png" alt="熱氣球">
                    </div>
                    <div class="ballImg">
                        <img src="../images/index/red-balloon.png" alt="熱氣球">
                    </div>
                </div>

                <div class="countryInfo">
                    <div class="countryInfoReel"> 
                        <div class="countryInfoSm">
                            <a href="showItem.php?snackNo=<?php echo $arr_row[0]["snackNo"];?>">
                                <div class="countryInfoHeader">
                                    <div class="countryInfoImg">
                                        <img src="<?php echo $arr_row[0]["snackPic"];?>">
                                    </div>
                                    <div class="countryInfoTitle">
                                        <h3>新品上市！</h3>
                                    </div>
                                </div>
                                <div class="countryInfosection">
                                    <h4>[<?php echo $arr_row[0]["nation"];?>] <?php echo $arr_row[0]["snackName"];?></h4>
                                    <p><?php echo $arr_row[0]["snackWord"];?></p>
                                </div>
                            </a>
                            <div class="countryInfofooter">
                                <a href="showItem.php?snackNo=<?php echo $arr_row[0]["snackNo"];?>">
                                    <div class="countryInfoPrice">
                                        <h3>$<?php echo $arr_row[0]["snackPrice"];?></h3>
                                    </div>
                                </a>
                                <div class="countryInfoAddCart">
                                    <button class="cart" id="<?php echo "{$arr_row[0]['snackNo']}|{$arr_row[0]['snackPrice']}|0" ?>">加入購物車</button>
                                </div>
                                <div class="countryInfoHeart">
                                    <button class="heart" id="<?php echo $arr_row[0]['snackNo'];?>"><i class="far fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="countryInfoSm">
                            <a href="showItem.php?snackNo=<?php echo $arr_row[1]["snackNo"];?>">
                                <div class="countryInfoHeader">
                                    <div class="countryInfoImg">
                                        <img src="<?php echo $arr_row[1]["snackPic"];?>">
                                    </div>
                                    <div class="countryInfoTitle">
                                        <h3>新品上市！</h3>
                                    </div>
                                </div>
                                <div class="countryInfosection">
                                    <h4>[<?php echo $arr_row[1]["nation"];?>] <?php echo $arr_row[1]["snackName"];?></h4>
                                    <p><?php echo $arr_row[1]["snackWord"];?></p>
                                </div>
                            </a>
                            <div class="countryInfofooter">
                                <a href="showItem.php?snackNo=<?php echo $arr_row[1]["snackNo"];?>">
                                    <div class="countryInfoPrice">
                                        <h3>$<?php echo $arr_row[1]["snackPrice"];?></h3>
                                    </div>
                                </a>
                                <div class="countryInfoAddCart">
                                    <button class="cart" id="<?php echo "{$arr_row[1]['snackNo']}|{$arr_row[1]['snackPrice']}|0" ?>">加入購物車</button>
                                </div>
                                <div class="countryInfoHeart">
                                    <button class="heart" id="<?php echo $arr_row[1]['snackNo'];?>"><i class="far fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="countryInfoSm">
                            <a href="showItem.php?snackNo=<?php echo $arr_row[2]["snackNo"];?>">
                                <div class="countryInfoHeader">
                                    <div class="countryInfoImg">
                                        <img src="<?php echo $arr_row[2]["snackPic"];?>">
                                    </div>
                                    <div class="countryInfoTitle">
                                        <h3>新品上市！</h3>
                                    </div>
                                </div>
                                <div class="countryInfosection">
                                    <h4>[<?php echo $arr_row[2]["nation"];?>] <?php echo $arr_row[2]["snackName"];?></h4>
                                    <p><?php echo $arr_row[2]["snackWord"];?></p>
                                </div>
                            </a>
                            <div class="countryInfofooter">
                                <a href="showItem.php?snackNo=<?php echo $arr_row[2]["snackNo"];?>">
                                    <div class="countryInfoPrice">
                                        <h3>$<?php echo $arr_row[2]["snackPrice"];?></h3>
                                    </div>
                                </a>
                                <div class="countryInfoAddCart">
                                    <button class="cart" id="<?php echo "{$arr_row[2]['snackNo']}|{$arr_row[2]['snackPrice']}|0" ?>">加入購物車</button>
                                </div>
                                <div class="countryInfoHeart">
                                    <button class="heart" id="<?php echo $arr_row[2]['snackNo'];?>"><i class="far fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="countryInfoSm">
                            <a href="showItem.php?snackNo=<?php echo $arr_row[3]["snackNo"];?>">
                                <div class="countryInfoHeader">
                                    <div class="countryInfoImg">
                                        <img src="<?php echo $arr_row[3]["snackPic"];?>">
                                    </div>
                                    <div class="countryInfoTitle">
                                        <h3>新品上市！</h3>
                                    </div>
                                </div>
                                <div class="countryInfosection">
                                    <h4>[<?php echo $arr_row[3]["nation"];?>] <?php echo $arr_row[3]["snackName"];?></h4>
                                    <p><?php echo $arr_row[3]["snackWord"];?></p>
                                </div>
                            </a>
                            <div class="countryInfofooter">
                                <a href="showItem.php?snackNo=<?php echo $arr_row[3]["snackNo"];?>">
                                    <div class="countryInfoPrice">
                                        <h3>$<?php echo $arr_row[3]["snackPrice"];?></h3>
                                    </div>
                                </a>
                                <div class="countryInfoAddCart">
                                    <button class="cart" id="<?php echo "{$arr_row[3]['snackNo']}|{$arr_row[3]['snackPrice']}|0" ?>">加入購物車</button>
                                </div>
                                <div class="countryInfoHeart">
                                    <button class="heart" id="<?php echo $arr_row[3]['snackNo'];?>"><i class="far fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="countryInfoSm">
                            <a href="showItem.php?snackNo=<?php echo $arr_row[4]["snackNo"];?>">
                                <div class="countryInfoHeader">
                                    <div class="countryInfoImg">
                                        <img src="<?php echo $arr_row[4]["snackPic"];?>">
                                    </div>
                                    <div class="countryInfoTitle">
                                        <h3>新品上市！</h3>
                                    </div>
                                </div>
                                <div class="countryInfosection">
                                    <h4>[<?php echo $arr_row[4]["nation"];?>] <?php echo $arr_row[4]["snackName"];?></h4>
                                    <p><?php echo $arr_row[4]["snackWord"];?></p>
                                </div>
                            </a>
                            <div class="countryInfofooter">
                                <a href="showItem.php?snackNo=<?php echo $arr_row[4]["snackNo"];?>">
                                    <div class="countryInfoPrice">
                                        <h3>$<?php echo $arr_row[4]["snackPrice"];?></h3>
                                    </div>
                                </a>
                                <div class="countryInfoAddCart">
                                    <button class="cart" id="<?php echo "{$arr_row[4]['snackNo']}|{$arr_row[4]['snackPrice']}|0" ?>">加入購物車</button>
                                </div>
                                <div class="countryInfoHeart">
                                    <button class="heart" id="<?php echo $arr_row[4]['snackNo'];?>"><i class="far fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="countryInfoSm">
                            <a href="showItem.php?snackNo=<?php echo $arr_row[5]["snackNo"];?>">
                                <div class="countryInfoHeader">
                                    <div class="countryInfoImg">
                                        <img src="<?php echo $arr_row[5]["snackPic"];?>">
                                    </div>
                                    <div class="countryInfoTitle">
                                        <h3>新品上市！</h3>
                                    </div>
                                </div>
                                <div class="countryInfosection">
                                    <h4>[<?php echo $arr_row[5]["nation"];?>] <?php echo $arr_row[5]["snackName"];?></h4>
                                    <p><?php echo $arr_row[5]["snackWord"];?></p>
                                </div>
                            </a>
                            <div class="countryInfofooter">
                                <a href="showItem.php?snackNo=<?php echo $arr_row[5]["snackNo"];?>">
                                    <div class="countryInfoPrice">
                                        <h3>$<?php echo $arr_row[5]["snackPrice"];?></h3>
                                    </div>
                                </a>
                                <div class="countryInfoAddCart">
                                    <button class="cart" id="<?php echo "{$arr_row[5]['snackNo']}|{$arr_row[5]['snackPrice']}|0" ?>">加入購物車</button>
                                </div>
                                <div class="countryInfoHeart">
                                    <button class="heart" id="<?php echo $arr_row[5]['snackNo'];?>"><i class="far fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="countryInfoSm">
                            <a href="showItem.php?snackNo=<?php echo $arr_row[6]["snackNo"];?>">
                                <div class="countryInfoHeader">
                                    <div class="countryInfoImg">
                                        <img src="<?php echo $arr_row[6]["snackPic"];?>">
                                    </div>
                                    <div class="countryInfoTitle">
                                        <h3>新品上市！</h3>
                                    </div>
                                </div>
                                <div class="countryInfosection">
                                    <h4>[<?php echo $arr_row[6]["nation"];?>] <?php echo $arr_row[6]["snackName"];?></h4>
                                    <p><?php echo $arr_row[6]["snackWord"];?></p>
                                </div>
                            </a>
                            <div class="countryInfofooter">
                                <a href="showItem.php?snackNo=<?php echo $arr_row[6]["snackNo"];?>">
                                    <div class="countryInfoPrice">
                                        <h3>$<?php echo $arr_row[6]["snackPrice"];?></h3>
                                    </div>
                                </a>
                                <div class="countryInfoAddCart">
                                    <button class="cart" id="<?php echo "{$arr_row[6]['snackNo']}|{$arr_row[6]['snackPrice']}|0" ?>">加入購物車</button>
                                </div>
                                <div class="countryInfoHeart">
                                    <button class="heart" id="<?php echo $arr_row[6]['snackNo'];?>"><i class="far fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="countryInfoSm">
                            <a href="showItem.php?snackNo=<?php echo $arr_row[7]["snackNo"];?>">
                                <div class="countryInfoHeader">
                                    <div class="countryInfoImg">
                                        <img src="<?php echo $arr_row[7]["snackPic"];?>">
                                    </div>
                                    <div class="countryInfoTitle">
                                        <h3>新品上市！</h3>
                                    </div>
                                </div>
                                <div class="countryInfosection">
                                    <h4>[<?php echo $arr_row[7]["nation"];?>] <?php echo $arr_row[7]["snackName"];?></h4>
                                    <p><?php echo $arr_row[7]["snackWord"];?></p>
                                </div>
                            </a>
                            <div class="countryInfofooter">
                                <a href="showItem.php?snackNo=<?php echo $arr_row[7]["snackNo"];?>">
                                    <div class="countryInfoPrice">
                                        <h3>$<?php echo $arr_row[7]["snackPrice"];?></h3>
                                    </div>
                                </a>
                                <div class="countryInfoAddCart">
                                    <button class="cart" id="<?php echo "{$arr_row[7]['snackNo']}|{$arr_row[7]['snackPrice']}|0" ?>">加入購物車</button>
                                </div>
                                <div class="countryInfoHeart">
                                    <button class="heart" id="<?php echo $arr_row[7]['snackNo'];?>"><i class="far fa-heart"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="sale">
            <div id="closeSale">
                <i class="fas fa-times"></i>
            </div>
            <div class="saleTitle">
                <h3>限時特賣</h3>
                <div class="countdown">
                    <span id='hour'></span>
                    <span id='minute'></span>
                    <span id='second'></span>
                </div>
            </div>
            <?php
                require_once("connectcd105g2.php");
                $sql = "SELECT * FROM clearanceitem c,clearance a,snack s WHERE c.snackNo = s.snackNo and c.clearanceNo = a.clearanceNo ORDER by c.clearanceNo desc limit 3";
                $sales = $pdo->query( $sql );
                $salesRow = $sales->fetchAll();
            ?>
            <div class="item fade" id="3.7|1|5|2">
                <!-- <a href="showItem.html"></a> -->
                <img class="country" src="../images/blair/<?php echo $salesRow[0]['nation']?>.png" alt="國家圖">
                <img class="itemImg" src="<?php echo $salesRow[0]['snackPic']?>" alt="商品圖">
                <h4 class="itemName">[<?php echo $salesRow[0]['nation']?>]<?php echo $salesRow[0]['snackName']?></h4>
                <p class="price">$<?php echo $salesRow[0]['salePrice']?></p>
                <div class="itemBtns">
                    <button class="cart" id="<?php echo "{$salesRow[0]['snackNo']}|{$salesRow[0]['salePrice']}|2|{$salesRow[0]['snackPrice']}|{$salesRow[0]['clearanceNo']}" ?>">加入購物車</button>
                </div>
                <p class="stock">商品數量剩餘&nbsp;<span class="stockQty"><?php echo $salesRow[0]['quantity']?></span>&nbsp;件</p>
            </div>
            <div class="item fade" id="3.7|1|5|2">
                <!-- <a href="showItem.html"></a> -->
                <img class="country" src="../images/blair/<?php echo $salesRow[1]['nation']?>.png" alt="">
                <img class="itemImg" src="<?php echo $salesRow[1]['snackPic']?>" alt="">
                <h4 class="itemName">[<?php echo $salesRow[1]['nation']?>]<?php echo $salesRow[1]['snackName']?></h4>
                <p class="price">$<?php echo $salesRow[1]['salePrice']?></p>
                <div class="itemBtns">
                    <button class="cart" id="<?php echo "{$salesRow[1]['snackNo']}|{$salesRow[1]['salePrice']}|2|{$salesRow[1]['snackPrice']}|{$salesRow[1]['clearanceNo']}" ?>">加入購物車</button>
                </div>
                <p class="stock">商品數量剩餘&nbsp;<span class="stockQty"><?php echo $salesRow[1]['quantity']?></span>&nbsp;件</p>
            </div>
            <div class="item fade" id="3.7|1|5|2">
                <!-- <a href="showItem.html"></a> -->
                <img class="country" src="../images/blair/<?php echo $salesRow[2]['nation']?>.png" alt="">
                <img class="itemImg" src="<?php echo $salesRow[2]['snackPic']?>" alt="">
                <h4 class="itemName">[<?php echo $salesRow[2]['nation']?>]<?php echo $salesRow[2]['snackName']?></h4>
                <p class="price">$<?php echo $salesRow[2]['salePrice']?></p>
                <div class="itemBtns">
                    <button class="cart" id="<?php echo "{$salesRow[2]['snackNo']}|{$salesRow[2]['salePrice']}|2|{$salesRow[2]['snackPrice']}|{$salesRow[2]['clearanceNo']}" ?>">加入購物車</button>
                </div>
                <p class="stock">商品數量剩餘&nbsp;<span class="stockQty"><?php echo $salesRow[2]['quantity']?></span>&nbsp;件</p>
            </div>
            <a id="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a id="next" onclick="plusSlides(1)">&#10095;</a>
        </div>


        <section class="section_12" id="section_12">
            <?php
                // $sql = "select * from snack order by goodStars desc limit 3";
                $sql = "SELECT * FROM `rank`,`snack` WHERE `rankGenre` LIKE :category AND `rank`.`snackNo`=`snack`.`snackNo` ORDER BY ranking limit 0,3";
                $prodRow = $pdo->prepare( $sql );
                $prodRow->bindValue(":category", '綜合');
                $prodRow->execute();
                $row = $prodRow->fetchAll(); //需求送出去，資料抓回來，阿凱發大財  
                $sql0="SELECT * FROM `snack` WHERE `snackNo`='{$row[0]['snackNo']}' ";
                $sql1="SELECT * FROM `snack` WHERE `snackNo`='{$row[1]['snackNo']}' ";
                $sql2="SELECT * FROM `snack` WHERE `snackNo`='{$row[2]['snackNo']}' ";
                $prodRow = $pdo->query($sql0);
                $row0=$prodRow->fetch();
                $prodRow = $pdo->query($sql1);
                $row1=$prodRow->fetch();
                $prodRow = $pdo->query($sql2);
                $row2=$prodRow->fetch();
        
                $rank0 = round($row0['goodStars']/$row0['goodTimes'],1);
                $rank1 = round($row1['goodStars']/$row1['goodTimes'],1);
                $rank2 = round($row2['goodStars']/$row2['goodTimes'],1);         
            ?>
                <div class="camera">
                    <div class="box boxBase" id="box_12">
                        <div class="surface surface_top" id="cover_out_12"></div>
                        <div class="surface surface_top_inner" id="cover_in_12"></div>
                        <!-- <div class="surface surface_down">下</div> -->
                        <div class="surface surface_down_left" id="cover_dl_12"></div>
                        <div class="surface surface_down_right" id="cover_dr_12"></div>
                        <div class="surface surface_back"></div>
                        <div class="surface surface_font"></div>
                        <div class="surface surface_left"></div>
                        <div class="surface surface_right"></div>
                    </div>
                </div>
                <div class="LeaderboardTitle">
                    <h2>零食排行榜</h2>
                    <canvas id="celebration"></canvas>
                </div>
                <div class="LeaderboardCount">
                    <div id="lbReel">
                        <div class="LeaderboardNo2">
                            <a href="showItem.php?snackNo=<?php echo $row1["snackNo"];?>">
                                <div class="Leaderboarditem No2">
                                    <div class="LeaderboarCountry">
                                        <img src="../images/blair/<?php echo $row1["nation"];?>.png" alt="排行國家">
                                    </div>
                                    <div class="commodity">
                                        <img src="<?php echo $row1["snackPic"];?>" alt="產品圖">
                                        <h4 class="commodityTitle">[<?php echo $row1["nation"];?>]<?php echo $row1["snackName"];?></h4>
                                        <div class="flexMid">
                                            <p class="score"><?php echo ($rank1);?><span class="total">/5</span></p>
                                        </div>
                                        <div class="star" grad="<?php echo ($rank1);?>">
                                            <img src="../images/rankBoard/starMask.png" alt="星等">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="LeaderboardNo1">
                            <a href="showItem.php?snackNo=<?php echo $row0["snackNo"];?>">
                                <div class="Leaderboarditem No1">
                                    <div class="LeaderboarCountry">
                                        <img src="../images/blair/<?php echo $row0["nation"];?>.png" alt="排行國家">
                                    </div>
                                    <div class="commodity">
                                        <img src="<?php echo $row0["snackPic"];?>" alt="產品圖">
                                        <h4 class="commodityTitle">[<?php echo $row0["nation"];?>]<?php echo $row0["snackName"];?></h4>
                                        <div class="flexMid">
                                            <p class="score"><?php echo ($rank0);?><span class="total">/5</span></p>
                                        </div>
                                        <div class="star" grad="<?php echo ($rank0);?>">
                                            <img src="../images/rankBoard/starMask.png" alt="星等">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="LeaderboardNo3">
                            <a href="showItem.php?snackNo=<?php echo $row2["snackNo"];?>">
                                <div class="Leaderboarditem No3">
                                    <div class="LeaderboarCountry">
                                        <img src="../images/blair/<?php echo $row2["nation"];?>.png" alt="排行國家">
                                    </div>
                                    <div class="commodity">
                                        <img src="<?php echo $row2["snackPic"];?>" alt="產品圖">
                                        <h4 class="commodityTitle">[<?php echo $row2["nation"];?>]<?php echo $row2["snackName"];?></h4>
                                        <div class="flexMid">
                                            <p class="score"><?php echo ($rank2);?><span class="total">/5</span></p>
                                        </div>
                                        <div class="star" grad="<?php echo ($rank2);?>">
                                            <img src="../images/rankBoard/starMask.png" alt="星等">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="LeaderboardIcon">
                    <div class="lbIconImg">
                        <img src="../images/index/candy-1.png" alt="糖果背景圖">
                    </div>
                    <div class="lbIconImg">
                        <img src="../images/index/candy-2.png" alt="糖果背景圖">
                    </div>
                    <div class="lbIconImg">
                        <img src="../images/index/candy-3.png" alt="糖果背景圖">
                    </div>
                    <div class="lbIconImg">
                        <img src="../images/index/candy-4.png" alt="糖果背景圖">
                    </div>
                    <div class="lbIconImg">
                        <img src="../images/index/candy-5.png" alt="糖果背景圖">
                    </div>
                    <div class="lbIconImg">
                        <img src="../images/index/candy-6.png" alt="糖果背景圖">
                    </div>
                    <div class="lbIconImg">
                        <img src="../images/index/candy-7.png" alt="糖果背景圖">
                    </div>
                    <div class="lbIconImg">
                        <img src="../images/index/candy-8.png" alt="糖果背景圖">
                    </div>
                    <div class="lbIconImg">
                        <img src="../images/index/candy-9.png" alt="糖果背景圖">
                    </div>
                </div>
                <div class="LeaderboardSort">
                    <button class="category">綜合</button>
                    <button class="category">餅乾</button>
                    <button class="category">糖果</button>
                    <button class="category">洋芋片</button>
                    <button class="category">巧克力</button>
                </div>
                <div class="goRankBtn">
                    <a href="rankBoard.php"><button class="subscribe">看更多</button></a>
                </div>
        </section>
        <!-- <div id="ctrl_bar">
            <div class="btn btn_front" id="btn_front">前</div>
            <div class="btn btn_back" id="btn_back">後</div>
            <div class="btn btn_top" id="btn_top">上</div>
            <div class="btn btn_bottom" id="btn_bottom">下</div>
            <div class="btn btn_left" id="btn_left">左</div>
            <div class="btn btn_right" id="btn_right">右</div>
            <div class="btn rotateX" id="rotateX">X軸轉轉</div>
            <div class="btn rotateY" id="rotateY">Y軸轉轉</div>
            <div class="btn rotateZ" id="rotateZ">Z軸轉轉</div>
            <div class="btn show" id="show">Show</div>
        </div> -->


        <section class="customized">
            <div class="waveTop">
                <img src="../images/index/waveTop_5.svg" alt="波浪圖">
            </div>
            <div class="LeaderboardTitle">
                <h2>客製零食箱</h2>
            </div>
            <div class="customizedCount">
                <div id="roulette">
                    <div class="color" id="red"></div>
                    <div class="color" id="orange"></div>
                    <div class="color" id="yellow"></div>
                    <div class="color" id="green"></div>
                    <div class="color" id="blue"></div>
                    <div class="color" id="indigo"></div>
                    <div class="color" id="violet"></div>
                    <div class="color" id="black"></div>
                </div>
                <div class="ctNull"></div>
                <section class="section_15" id="section_15">
                    <div class="camera">
                        <div class="box boxBase" id="box_15">
                            <div class="surface surface_top ctBox" id="suf_top"></div>
                            <div class="surface surface_down ctBox"></div>
                            <div class="surface surface_back ctBox" id="suf_back"></div>
                            <div class="surface surface_font ctBox" id="suf_front"></div>
                            <div class="surface surface_left ctBox" id="suf_left"></div>
                            <div class="surface surface_right ctBox" id="suf_right"></div>
                        </div>
                    </div>
                </section>
                <div class="ctCard">
                    <div class="ctIntroduce">
                        <h3>簡單4步驟</h3>
                        <p>設計箱子 → 選卡片 → 選零食 → 結帳</p>
                    </div>
                    <div class="ctBtns">
                        <h2>step 1 設計箱子</h2>
                        <div class="ctBtn" id="ctrl_bar">
                            <button class="dimension btns btn_front" id="btn_front">前</button>
                            <button class="dimension btns btn_back" id="btn_back">後</button>
                            <button class="dimension btns btn_left" id="btn_left">左</button>
                            <button class="dimension btns btn_right" id="btn_right">右</button>
                            <button class="dimension btns btn_top" id="btn_top">上</button>
                        </div>
                        <div class="ctBtnGo">
                            <a href="customized.php"><button class="goToCustom">客製去!</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="waveBottom">
                <img src="../images/index/waveBottom.svg" alt="波浪圖">
            </div>
        </section>

        <section class="preOrder">
            <div class="poTitle">
                <h2>預購零食箱</h2>
            </div>
            <div class="poCount">
                <div class="poray">
                    <!-- <img src="../images/index/ray.svg" alt="放射線"> -->
                    <!-- <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul> -->
                </div>
                <div class="poMainCount">
                    <div class="poCard">
                        <div class="poTrait">
                            <h2>預購5大特點</h2>
                            <div class="traitCount">
                                <p>絕對<br>是新品</p>
                                <p>像開禮物<br>一樣驚喜</p>
                                <p>零食<br>不重複</p>
                                <p>每月<br>定期扣款</p>
                                <p>隨時能<br>取消訂閱</p>
                            </div>
                            <div class="traitGo">
                                <a href="preOrder.php"><button class="subscribe">馬上預購!</button></a>
                            </div>
                        </div>
                        <div class="poInside">
                            <p>裡面有什麼？</p>
                            <div class="insideBtn" id="show">
                                <button class="month">2019<br>1月期</button>
                                <button class="month">2019<br>2月期</button>
                                <button class="month">2019<br>3月期</button>
                            </div>
                        </div>
                    </div>
                    <div class="poBox">
                        <section class="section section_9" id="section_9">
                            <div class="camera">
                                <div class="box boxBase" id="box_9">

                                    <div class="surface surface_top" id="cover_out"></div>
                                    <div class="surface surface_top_inner" id="cover_in">
                                        <div class="way">
                                            <div class="light"></div>
                                            <div class="light"></div>
                                            <div class="light"></div>
                                            <div class="light"></div>
                                            <div class="light"></div>
                                            <div class="light"></div>
                                            <div class="light"></div>
                                            <div class="light"></div>
                                        </div>
                                        <div class="way">
                                            <div class="light"></div>
                                            <div class="light"></div>
                                            <div class="light"></div>
                                            <div class="light"></div>
                                            <div class="light"></div>
                                            <div class="light"></div>
                                            <div class="light"></div>
                                            <div class="light"></div>
                                        </div>
                                    </div>
                                    <div class="surface surface_down"></div>
                                    <div class="surface surface_back"></div>
                                    <div class="surface surface_font"></div>
                                    <div class="surface surface_left"></div>
                                    <div class="surface surface_right"></div>
                                </div>
                            </div>
                            
                            <?php
                                $sql = "SELECT snackPic FROM `snack` WHERE boxDate = '2019-01-01'";
                                $prodRow = $pdo->prepare($sql); //執行上面的指令傳回陣列
                                // $prodRow -> bindValue(':snackGenre', 0 );
                                $prodRow -> execute(); 
                                while($row = $prodRow->fetchAll()){ //需求送出去，資料抓回來，阿凱發大財                            
                            ?>
                                <div id="snacksRun">
                                    <div class="snacksRunImg">
                                        <img src="<?php echo $row[0]["snackPic"];?>" alt="零食">
                                    </div>
                                    <div class="snacksRunImg">
                                        <img src="<?php echo $row[1]["snackPic"];?>" alt="零食">
                                    </div>
                                    <div class="snacksRunImg">
                                        <img src="<?php echo $row[2]["snackPic"];?>" alt="零食">
                                    </div>
                                    <div class="snacksRunImg">
                                        <img src="<?php echo $row[3]["snackPic"];?>" alt="零食">
                                    </div>
                                    <div class="snacksRunImg">
                                        <img src="<?php echo $row[4]["snackPic"];?>" alt="零食">
                                    </div>
                                    <div class="snacksRunImg">
                                        <img src="<?php echo $row[5]["snackPic"];?>" alt="零食">
                                    </div>
                                </div>
                            <?php };?>
                        </section>
                    </div>
                </div>
            </div>
        </section>


        <!-- <section class="igShare">
            <div class="igTitle">
                <h2>IG分享牆</h2>
            </div>
            <div class="igCount">
                <div class="chocoGroup">
                    <img src="../images/index/Chocolate-group.svg" alt="巧克力">
                    <div class="igImg">
                        <img src="../images/index/igImg-2.png" id="large" alt="分享圖">
                        <img src="../images/index/igImg-2.png" class="small" alt="分享圖">
                        <img src="../images/index/igImg-3.png" class="small" alt="分享圖">
                        <img src="../images/index/igImg-4.png" class="small" alt="分享圖">
                        <img src="../images/index/igImg-5.png" class="small" alt="分享圖">
                        <img src="../images/index/igImg-1.png" class="small" alt="分享圖">
                        <img src="../images/index/igImg-8.png" class="small" alt="分享圖">
                    </div>
                    <div class="igName">
                        <h4>Molly1020</h4>
                    </div>
                    <div class="igText">
                        <p>在連假前收到<span>@sanckMaster</span>的一月零食箱，太開心啦嗷嗷！廉價的零食...</p>
                        <span>#大零食家#新年新希望#超好吃</span>
                    </div>
                </div>
                <div class="chocoPack">
                    <img src="../images/index/Chocolate-pack1.svg" alt="巧克力包裝">
                </div>
            </div>
        </section> -->



        <section class="vmMap">
            <div id="mapSearch">
                <div id="map"></div>
                <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxP0uxcl_z9Y2bY7OkrWZg5TRhtkANEog&callback=initMap">
                    </script>
                <div class="mapRoof">
                    <img src="../images/index/shed.png" alt="地圖的屋頂">
                </div>
            </div>
            <div class="vmCount">
                <div class="vmTitle">
                    <h2>尋找販賣機</h2>
                </div>
                <div class="vmMainCount">
                    <div class="vmText"><h3>點選販賣機馬上搜尋！</h3></div>
                    <div class="vmBtn"><a href="gsell.php"><button class="subscribe">了解更多</button></a></div>
                </div>
                <div class="vmInfo">
                    <div class="vmLocate">
                        <div class="locateImg">
                            <img src="../images/index/coordinate.png" alt="定位圖">
                        </div>
                        <div class="locateImg">
                            <img src="../images/index/coordinate.png" alt="定位圖">
                        </div>
                        <div class="locateImg">
                            <img src="../images/index/coordinate.png" alt="定位圖">
                        </div>
                    </div>
                    <div class="vmImg">
                        <img src="../images/index/vending-1.png" alt="販賣機">
                        <img src="../images/index/vending-2.png" alt="販賣機">
                        <img src="../images/index/vending-3.png" alt="販賣機">
                    </div>
                </div>
            </div>
        </section>

        <!-- <div class="gameBox">
            <img src="../images/index/gameImgL.png" alt="遊戲圖">
            <p>玩小遊戲可獲得<br>折價優惠券哦！</p>
        </div> -->
        <!-- <div id="game" class="gameScratch">
            <img src="../images/index/gameImgR.png" alt="遊戲圖">
            <p>限時刮刮樂<br>刮出優惠券！</p>
        </div> -->

        <footer class="footer">
            <div id="floor">
                <img src="../images/nnnnn/floor.png" alt="floor">
                <p id="copy">Copyright©2019 Snack Master</p>
            </div>
        </footer>

    </div>


<!-- 即期品特賣 -->
    <script>
        // 
        //     require_once("connectcd105g2.php");
        //     $sql = "SELECT * FROM clearanceitem c,clearance a,snack s WHERE c.snackNo = s.snackNo and c.clearanceNo = a.clearanceNo ORDER by a.clearanceNo desc limit 3";
        //     $sales = $pdo->query( $sql );
        //     $salesRow = $sales->fetchAll();
        // 
        var slideIndex = 1;
        function showSlides(n) {
            // console.log(`showSlide start, slideIndex= ${slideIndex}`);
            
            var i;
            var slides = document.getElementsByClassName('item');
            if (n > slides.length) { slideIndex = 1;}
            if (n < 1) { slideIndex = slides.length;}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
            console.log(`display = "block" , slides [${slideIndex-1}]`);

        }
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }
        function countdown() {
            //取得現在的時間
            var now = String( new Date());
            // console.log(now);
            var newNow = new Date(now.replace(/-/g, "/"));
            // console.log(newNow);
            //取得活動結束的時間(第一次專題先寫死而不是從資料庫撈資料)
            // var oneDay = now.getDate() + 1;
            var endTime = String('<?php echo $salesRow[0]["endTime"]?>') ;
            var newEndTime = new Date(endTime.replace(/-/g, "/"));
            // console.log(endTime); //2019-02-20
            // var end = new Date(`${endTime} 00:00:00`);
            // var end = new Date(newEndTime);
            // console.log(end);
            //算出目前時間到結束時間中間有多少秒            
            var leftTime = newEndTime.getTime() - newNow.getTime();  //1552752000-1550378890=2372984
            // console.log(leftTime); 

            //依序將毫秒轉換成幾天幾時幾分幾秒
            var leftSecond = parseInt(leftTime / 1000); //毫秒-秒
            var hour = Math.floor(leftSecond / 3600); //
            // console.log(hour);
            var minute = Math.floor((leftSecond - hour * 3600) / 60);
            var second = Math.floor(leftSecond - hour * 3600 - minute * 60);
            document.getElementById('hour').innerText = hour + '時 : ';
            document.getElementById('minute').innerText = minute + '分 : ';
            document.getElementById('second').innerText = second + '秒';
        }
        // function test(){
        //     console.log('here');
        // }
        function sale() {
            //先呼叫一次呈現倒數的函數，不然一進畫面會是空白
            countdown();
            //設定計時器讓倒數函式countdown每秒被呼叫一次
            setInterval(countdown, 1000);
            // document.getElementById('close').addEventListener('click', test);
            document.getElementById('closeSale').addEventListener('click', function (){
                document.getElementById('sale').style.display = 'none';
            });
            window.addEventListener('resize', function (){
                if (window.screen.width < 768){
                    showSlides(slideIndex);
                }else{
                    var slides = document.getElementsByClassName('item');
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "block";
                    }
                }
            });
            if (window.screen.width < 768) {
                showSlides(slideIndex);
            };
        }
        window.addEventListener('load', sale);
    </script>

    <script>
        //函式內容都是直接從codepen抓的，所以我也看不太懂XDDDDDDDD
        //總之是取得滑鼠移動的距離，經過一堆計算之後讓物件移動相對應的距離
        function parallaxIt(e, target, movement) {
            var $this = $("#container");
            var relX = e.pageX - $this.offset().left;
            var relY = e.pageY - $this.offset().top;

            TweenMax.to(target, 1, {
                x: (relX - $this.width() / 2) / $this.width() * movement,
                y: (relY - $this.height() / 2) / $this.height() * movement
            });
        }
        function doFirst() {
            container = document.getElementById('container');
            //滑鼠每次移動的時候會呼叫函式parallaxIt，針對不同的class(.slide1~3)，給予不同的移動距離
            container.addEventListener('mousemove', function (e) {
                parallaxIt(e, ".slide1", -100);
                parallaxIt(e, ".slide2", -50);
                parallaxIt(e, ".slide3", -75);
                parallaxIt(e, ".slide4", -25);
                parallaxIt(e, ".slide5", -125);

            });
        }
        window.addEventListener('load', doFirst);
    </script>

    <script>
        var monthBtn = document.getElementsByClassName('month');
        for (var m = 0; m < monthBtn.length; m++) {
            monthBtn[m].addEventListener('click', function (e) {
                //因為被點擊到的要換色，其他要恢復原狀
                //所以有按鈕被點擊時先一律全部恢復原狀，再讓被點擊的那個換色
                for (m = 0; m < monthBtn.length; m++) {
                    monthBtn[m].style.color = '';
                    monthBtn[m].style.backgroundColor = '';
                }
                e.target.style.color = '#737374';
                e.target.style.backgroundColor = '#fbc84a';
            });
        }
    </script>

    <!-- 箱子打開動畫 -->
    <script>
        const boxBases = document.querySelectorAll(".boxBase");
        const btns = document.querySelectorAll(".btns");
        //箱子上蓋測試
        const cover_out = document.querySelector("#cover_out");
        const cover_in = document.querySelector("#cover_in");
        const lights = document.querySelectorAll(".light");
        //箱子上蓋+下蓋收納測試
        const cover_in_12 = document.querySelector("#cover_in_12");
        const cover_out_12 = document.querySelector("#cover_out_12");
        const cover_dl_12 = document.querySelector("#cover_dl_12");
        const cover_dr_12 = document.querySelector("#cover_dr_12");
        const box_12 = document.querySelector("#box_12");
        //零食旋轉
        const snacksRun = document.querySelector("#snacksRun");


        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", boxRotate);
        }

        // 預購零食箱動畫
        var btnMonth = document.querySelectorAll(".month");
        for (var i = 0; i < btnMonth.length; i++) {
            btnMonth[i].addEventListener("click", monthRotate);
            // $(this).css({'backgroundColor':'#076baf'});
        }

        function monthRotate(e) {
            snacksRun.style.display = 'none';
            if (window.screen.width > 768) {
                boxBases.forEach(element => {
                    element.style.transform = "rotateX(270deg) rotateY(180deg) rotateZ(20deg)";
                });
                // 先把蓋子蓋起來
                {
                    let arr = cover_out.style.transform.split(" ");
                    console.log(`arr: ${arr}`);
                    cover_out.style.transform = "translate3d(0, 40px, -100px) rotateX(90deg)";
                    cover_in.style.transform = "translate3d(0, 40px, -100px) rotateX(90deg) rotateY(180deg)";
                }

                //延遲一段時間後...TADA~蓋子打開~
                setTimeout(e => {
                    cover_out.style.transform = "translate3d(0, 40px, -100px) rotateX(200deg)";
                    cover_in.style.transform = "translate3d(0, 40px, -100px) rotateX(200deg) rotateY(180deg)";
                }, 1000);
                //再延遲一下...燈燈~電燈假發光~
                setTimeout(e => {
                    console.log(lights);
                    lights.forEach(element => {
                        element.classList.add("showLight");
                    })
                }, 1000);
                //零食旋轉出來
                setTimeout(e => {
                    snacksRun.style.display = 'block';
                }, 1350);
                // break;
            } else {
                boxBases.forEach(element => {
                    element.style.transform = "rotateX(270deg) rotateY(180deg) rotateZ(0deg)";
                });
                //先把蓋子蓋起來
                {
                    let arr = cover_out.style.transform.split(" ");
                    console.log(`arr: ${arr}`);
                    cover_out.style.transform = "translate3d(0, 35px, -75px) rotateX(90deg)";
                    cover_in.style.transform = "translate3d(0, 35px, -75px) rotateX(90deg) rotateY(180deg)";
                }

                //延遲一段時間後...TADA~蓋子打開~
                setTimeout(e => {
                    cover_out.style.transform = "translate3d(0, 35px, -75px) rotateX(200deg)";
                    cover_in.style.transform = "translate3d(0, 35px, -75px) rotateX(200deg) rotateY(180deg)";
                }, 1000);
                //再延遲一下...燈燈~電燈假發光~
                setTimeout(e => {
                    console.log(lights);
                    lights.forEach(element => {
                        element.classList.add("showLight");
                    })
                }, 1000);
                //零食旋轉出來
                setTimeout(e => {
                    snacksRun.style.display = 'block';
                }, 1350);
                // break;
            }
        }

        // function init() {
        //     monthRotate();
        //     window.addEventListener('resize', monthRotate);
        // }

        // window.addEventListener("load", init);





        // 轉轉箱子功能鈕
        // 缺陷:style.transform是抓 css inline style的值，所以必須給箱子inline style的初始值
        function boxRotate(e) {
            console.log(`this.id: ${this.id}`);
            switch (this.id) {
                case "btn_front":
                    boxBases.forEach(element => {
                        element.style.transform = "rotateX(0deg) rotateY(0deg) rotateZ(0deg)";
                    });
                    $('.btns').removeClass('btnSelect');
                    $(this).addClass('btnSelect');
                    break;
                case "btn_back":
                    boxBases.forEach(element => {
                        element.style.transform = "rotateX(0deg) rotateY(180deg) rotateZ(0deg)";
                    });
                    $('.btns').removeClass('btnSelect');
                    $(this).addClass('btnSelect');
                    break;
                case "btn_top":
                    boxBases.forEach(element => {
                        element.style.transform = "rotateX(-90deg) rotateY(0deg) rotateZ(0deg)";
                    });
                    $('.btns').removeClass('btnSelect');
                    $(this).addClass('btnSelect');
                    break;
                case "btn_bottom":
                    boxBases.forEach(element => {
                        element.style.transform = "rotateX(90deg) rotateY(0deg) rotateZ(0deg)";
                    });
                    $('.btns').removeClass('btnSelect');
                    $(this).addClass('btnSelect');
                    break;
                case "btn_left":
                    boxBases.forEach(element => {
                        element.style.transform = "rotateX(0deg) rotateY(90deg) rotateZ(0deg)";
                    });
                    $('.btns').removeClass('btnSelect');
                    $(this).addClass('btnSelect');
                    break;
                case "btn_right":
                    boxBases.forEach(element => {
                        element.style.transform = "rotateX(0deg) rotateY(-90deg) rotateZ(0deg)";
                    });
                    $('.btns').removeClass('btnSelect');
                    $(this).addClass('btnSelect');
                    break;
                // case "show":
                //     if (window.screen.width > 768) {
                //         boxBases.forEach(element => {
                //             element.style.transform = "rotateX(270deg) rotateY(180deg) rotateZ(30deg)";
                //         });
                //         //先把蓋子蓋起來
                //         {
                //             let arr = cover_out.style.transform.split(" ");
                //             console.log(`arr: ${arr}`);
                //             cover_out.style.transform = "translate3d(0, 40px, -100px) rotateX(90deg)";
                //             cover_in.style.transform = "translate3d(0, 40px, -100px) rotateX(90deg) rotateY(180deg)";
                //         }

                //         //延遲一段時間後...TADA~蓋子打開~
                //         setTimeout(e => {
                //             cover_out.style.transform = "translate3d(0, 40px, -100px) rotateX(200deg)";
                //             cover_in.style.transform = "translate3d(0, 40px, -100px) rotateX(200deg) rotateY(180deg)";
                //         }, 1000);
                //         //再延遲一下...燈燈~電燈假發光~
                //         setTimeout(e => {
                //             console.log(lights);
                //             lights.forEach(element => {
                //                 element.classList.add("showLight");
                //             })
                //         }, 1000);
                //         break;
                //     } else {
                //         boxBases.forEach(element => {
                //             element.style.transform = "rotateX(270deg) rotateY(180deg) rotateZ(0deg)";
                //         });
                //         //先把蓋子蓋起來
                //         {
                //             let arr = cover_out.style.transform.split(" ");
                //             console.log(`arr: ${arr}`);
                //             cover_out.style.transform = "translate3d(0, 35px, -75px) rotateX(90deg)";
                //             cover_in.style.transform = "translate3d(0, 35px, -75px) rotateX(90deg) rotateY(180deg)";
                //         }

                //         //延遲一段時間後...TADA~蓋子打開~
                //         setTimeout(e => {
                //             cover_out.style.transform = "translate3d(0, 35px, -75px) rotateX(200deg)";
                //             cover_in.style.transform = "translate3d(0, 35px, -75px) rotateX(200deg) rotateY(180deg)";
                //         }, 1000);
                //         //再延遲一下...燈燈~電燈假發光~
                //         setTimeout(e => {
                //             console.log(lights);
                //             lights.forEach(element => {
                //                 element.classList.add("showLight");
                //             })
                //         }, 1000);
                //         break;
                //     }
            }
        };


        // 給箱子姿態初始值
        boxBases.forEach(el => {
            el.style.transform = "rotateX(-30deg) rotateY(30deg) rotateZ(0deg)";
        })


        // 驗證回傳值確實是陣列
        console.log(`cssTest: ${cssGet("#box_12", "transform")}`); //每個.boxBase的transform屬性值，我全都要
        console.log(`cssTest type: ${typeof (cssGet("#box_12", "transform")[0])}`);//檢查 陣列內 值的型別為字串
        console.log(`cssTest type arr: ${Object.prototype.toString.call(cssGet("#box_12", "transform"))}`);//檢查回傳值確實是陣列型態
        // cssGet(".boxBase","transform");

        //抓css檔內樣式
        //getPropertyValue不支援駝峰寫法=>表示不管大小寫~
        //原句:window.getComputedStyle(element, null).getPropertyValue("float");
        //不抓偽類 ex: var result = cssGet(".class","width");
        //抓偽類 ex: var result = cssGet(".class","width",":after");
        //回傳值是一個陣列!!!!
        //transform會得到矩陣，不是 translate / rotate 之類的
        function cssGet(element, property = "width-height", pseudo = null) {
            let el = document.querySelectorAll(element);
            var arrData = [];
            el.forEach(item => {
                let data = window.getComputedStyle(item, pseudo).getPropertyValue(property);
                arrData.push(data);
            })
            return arrData;
        }
    </script>



    <script>
        if (window.screen.width > 768) {
            // console.log(window.screen.width);
            //要讓被點擊的顏色旋轉到左手邊並將顏色套用到盒子上
            function rotate(e) {
                //因為點擊其他顏色的時候，上一個被點擊的顏色放大效果要取消
                //所以有顏色被點擊時就一律將所有顏色先恢復成正常大小
                for (var i = 0; i < colors.length; i++) {
                    colors[i].style.transform = 'scale(1)';
                }
                //只有被點擊的顏色會放大
                e.target.style.transform = 'scale(1.4)';

                //取得被點擊的顏色的id
                var color = e.target.id;
                var roulette = document.getElementById('roulette');
                //根據顏色來絕對轉盤要轉到哪個角度
                switch (color) {
                    case 'red':
                        roulette.style.transform = 'rotate(90deg)';
                        break;
                    case 'orange':
                        roulette.style.transform = 'rotate(45deg)';
                        break;
                    case 'yellow':
                        roulette.style.transform = 'rotate(0deg)';
                        break;
                    case 'green':
                        roulette.style.transform = 'rotate(-45deg)';
                        break;
                    case 'blue':
                        roulette.style.transform = 'rotate(-90deg)';
                        break;
                    case 'indigo':
                        roulette.style.transform = 'rotate(-135deg)';
                        break;
                    case 'violet':
                        roulette.style.transform = 'rotate(-180deg)';
                        break;
                    case 'black':
                        roulette.style.transform = 'rotate(-225deg)';
                        break;
                }

                //取得被點擊顏色的色碼
                var colorCode = window.getComputedStyle(e.target).getPropertyValue("background-color");
                console.log(colorCode);

                //將色碼設定給盒子
                // var box = document.getElementsByClassName('ctBox')[0];
                // box.style.backgroundColor = colorCode;


                //Js
                let elem = document.getElementsByClassName("btnSelect");
                console.log(elem[0].id);
                let tar = elem[0].id;
                tar = tar.replace("btn", "suf");
                console.log(tar);
                let targetEl = document.getElementById(tar);
                targetEl.style.backgroundColor = colorCode;

                //為解決一開始選顏色會有error的狀況，在HTML預先加了btnSelect，但在案別的按鈕時就不能選顏色了！ 待解決

                //Jq issue now
                // var tarId = $('.btnSelect').attr("id");
                // console.log(tarId)
                // tarId = tarId.replace("btn","suf"); //Jq can not
                // $(tarId).css({
                //     backgroundColor: colorCode
                // })
            }
        } else {
            // console.log(window.screen.width);
            //要讓被點擊的顏色旋轉到左手邊並將顏色套用到盒子上
            function rotate(e) {
                //因為點擊其他顏色的時候，上一個被點擊的顏色放大效果要取消
                //所以有顏色被點擊時就一律將所有顏色先恢復成正常大小
                for (var i = 0; i < colors.length; i++) {
                    colors[i].style.transform = 'scale(1)';
                }
                //只有被點擊的顏色會放大
                e.target.style.transform = 'scale(1.4)';

                //取得被點擊的顏色的id
                var color = e.target.id;
                var roulette = document.getElementById('roulette');
                //根據顏色來絕對轉盤要轉到哪個角度
                switch (color) {
                    case 'red':
                        roulette.style.transform = 'rotate(0deg)';
                        break;
                    case 'orange':
                        roulette.style.transform = 'rotate(-45deg)';
                        break;
                    case 'yellow':
                        roulette.style.transform = 'rotate(-90deg)';
                        break;
                    case 'green':
                        roulette.style.transform = 'rotate(225deg)';
                        break;
                    case 'blue':
                        roulette.style.transform = 'rotate(180deg)';
                        break;
                    case 'indigo':
                        roulette.style.transform = 'rotate(135deg)';
                        break;
                    case 'violet':
                        roulette.style.transform = 'rotate(90deg)';
                        break;
                    case 'black':
                        roulette.style.transform = 'rotate(45deg)';
                        break;
                }

                //取得被點擊顏色的色碼
                var colorCode = window.getComputedStyle(e.target).getPropertyValue("background-color");
                console.log(colorCode);

                //將色碼設定給盒子
                // var box = document.getElementsByClassName('ctBox')[0];
                // box.style.backgroundColor = colorCode;


                //Js
                let elem = document.getElementsByClassName("btnSelect");
                // console.log(elem[0].id);
                // alert(elem[0].id);
                let tar = elem[0].id;
                tar = tar.replace("btn", "suf");
                console.log(tar);
                let targetEl = document.getElementById(tar);
                targetEl.style.backgroundColor = colorCode;

                //為解決一開始選顏色會有error的狀況，在HTML預先加了btnSelect，但在案別的按鈕時就不能選顏色了！ 待解決

                //Jq issue now
                // var tarId = $('.btnSelect').attr("id");
                // console.log(tarId)
                // tarId = tarId.replace("btn","suf"); //Jq can not
                // $(tarId).css({
                //     backgroundColor: colorCode
                // })
            }
        }

        function doFirst() {
            //取得顏色們的物件關聯並設定點擊事件的聆聽功能
            colors = document.getElementsByClassName('color');
            for (var i = 0; i < colors.length; i++) {
                colors[i].addEventListener('click', rotate);
            }
        }
        window.addEventListener('load', doFirst);
    </script>

    <script>

        // function showLarge(e) {
        //     var small = e.target;
        //     var src = small.src;
        //     document.getElementById("large").src = src;
        // }


        // window.addEventListener("load", function () {
        //     //var imgs = document.querySelectorAll(".small");
        //     var imgs = document.getElementsByClassName("small");
        //     for (var i = 0; i < imgs.length; i++) {
        //         imgs[i].addEventListener("click", showLarge, false);
        //     }

        // }, false);

    </script>

    <script>
        // Initialize and add the map初始化並添加地圖
        function initMap() {
            // 下面的代碼構造了一個新的Google地圖對象，並向地圖添加了屬性，包括中心和縮放級別。

            var directionsService = new google.maps.DirectionsService();
            var directionsDisplay = new google.maps.DirectionsRenderer();
            // 位置
            var loc = [
                // {label:'A',lat:24.9650192,lng:121.1909533},
                {label:'B',lat:24.959982,lng:121.215134},
                {label:'C',lat:24.958616,lng:121.298447},
                {label:'D',lat:24.990711,lng:121.232857}
            ];
            var uluru = { lat: 24.9650192, lng: 121.1909533 };
            // The map, centered at Uluru地圖以烏魯魯為中心
            var map = new google.maps.Map(
                document.getElementById('map'), {
                    zoom: 12,
                    center: uluru,
                    styles:[
                        {
                            "featureType": "water",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "color": "#b5cbe4"
                                }
                            ]
                        },
                        {
                            "featureType": "landscape",
                            "stylers": [
                                {
                                    "color": "#efefef"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#83a5b0"
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#bdcdd3"
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "color": "#e3eed3"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "lightness": 33
                                }
                            ]
                        },
                        {
                            "featureType": "road"
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "lightness": 20
                                }
                            ]
                        },
                        {},
                        {
                            "featureType": "road",
                            "stylers": [
                                {
                                    "lightness": 20
                                }
                            ]
                        }
                    ]
                });
            // The marker, positioned at Uluru標記，位於烏魯魯。下面的代碼在地圖上放置一個標記。

            var img =[
                {url:'../images/index/vending-1.png',
                scaledSize: new google.maps.Size(30,45)},
                {url:'../images/index/vending-2.png',
                scaledSize: new google.maps.Size(30,45)},
                {url:'../images/index/vending-3.png',
                scaledSize: new google.maps.Size(30,45)},
            ];
            var marker = new google.maps.Marker({ position: uluru, map: map});
            for (var i = 0; i < loc.length; i++) {
                marker= new google.maps.Marker({
                    position: {
                    lat: loc[i].lat,
                    lng: loc[i].lng
                    },
                    map: map,
                    icon:img[i]
                });
            }
            $('.vmImg img').click(function(){
                var vm = $('.vmImg img').index(this);
                var loc = [
                    // {label:'A',lat:24.9650192,lng:121.1909533},
                    {label:'B',lat:24.959982,lng:121.215134},
                    {label:'C',lat:24.958616,lng:121.298447},
                    {label:'D',lat:24.990711,lng:121.232857}
                ];
                    directionsDisplay.setMap(map);
                    var request = {
                        origin: uluru,
                        destination: { lat: loc[vm].lat, lng: loc[vm].lng },
                        travelMode: 'DRIVING'
                    };
                    directionsService.route(request, function (result, status) {
                        if (status == 'OK') {
                            // 回傳路線上每個步驟的細節
                            console.log(result.routes[0].legs[0].steps);
                            directionsDisplay.setDirections(result);
                        } else {
                            console.log(status);
                        }
                    });
            })
        }
    </script>


<!-- 刮刮樂遊戲動畫 -->
    <!-- <script>
        function doFirst() {
            setInterval(showGame, 10000);
        }
        function showGame() {
            var random = (Math.floor(Math.random() * 10) + 1) * 1000;
            randomTimer = setInterval(randomGame, random);
        }
        function randomGame() {
            var game = document.getElementById('game');
            game.classList.remove('fadeOut');
            game.classList.add('fadeIn');
            clearInterval(randomTimer);
            catchTimer = setInterval(gameCountdown, 5000);
        }
        function gameCountdown() {
            game.classList.add('fadeOut');
            game.classList.remove('fadeIn');
            clearInterval(catchTimer);
        }

        window.addEventListener('load', doFirst);
    </script> -->

    



    <!-- <script>
        var countryImg=document.getElementsByClassName("countryImg");
        var countryInfoSm=document.getElementsByClassName("countryInfoSm");
        var countryInfoReel=document.getElementsByClassName("countryInfoReel");

        console.log(`countryInfoSm: ${countryInfoSm}`);

        console.log(`countryImg: ${countryImg}`);
        let ln=countryImg.length;
        for(var i=0;i<=ln;i++){
            countryImg[i].addEventListener("click",moveItem);
            console.log("moveItem");
        }

        function moveItem(e) {
            for (let i=0;i<=countryInfoSm.length;i++){
                console.log(`countryInfoSm[i] in moveItem: ${countryInfoSm[i]}`);

                var arr_x=countryInfoSm[i].offsetX;
            }
            let xpos= arr_x[5];
            countryInfoReel.scrollTo(xpos,0);
        }
    </script> -->


    <!-- //換排行榜動畫 -->
    <script>
        $('.category').click(function () {
            // console.log(`第 ${i} 次 點擊`)
            // var k = i ;
            // i++;
            // $('.LeaderboardCount').addClass('zoomInOut');
            // setTimeout(function(){
            //     $('.LeaderboardCount').removeClass('zoomInOut');
            //     console.log(`第 ${k} 次 播放完畢`);

            // },5000);

            $('.LeaderboardCount').css({
                'transform': 'translateY(0) scale(0)',
                'transition': '0.3s',
            })
            setTimeout(() => {
                $('.LeaderboardCount').css({
                    'transform': 'translateY(0) scale(1)',
                    'transition': '0.3s cubic-bezier(.24,.42,.63,1)',
                })
            }, 500);
        })
    </script>


    <!-- 預設值給綜合亮 -->
    <script>
        var rankColor = document.getElementsByClassName('category');
        rankColor[0].classList.add('showColor');
        for(var i=1;i<rankColor.length;i++){
            rankColor[i].addEventListener('click',function(){
                rankColor[0].classList.remove('showColor');
            });
        }
    </script>


<!-- 點選排行分類撈出該分類的排行 -->
    <script>
        function showRank(category){
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange=function (){
                if( xhr.readyState == 4){
                    if( xhr.status == 200 ){
                        //將撈回來的資料取代原本的網頁內容 
                        document.getElementById("lbReel").innerHTML = xhr.responseText;
                        showStar();
                    }else{
                    alert( xhr.status );
                    }
                }
            }
            var url = "getRank.php?category=" + category;
            xhr.open("Get", url, true);
            xhr.send( null );
            
        }
        var rank = document.getElementsByClassName('category');
        rank[0].addEventListener('click',function(){
            showRank('綜合');
        });
        rank[1].addEventListener('click',function(){
            showRank('餅乾');
        });
        rank[2].addEventListener('click',function(){
            showRank('糖果');
        });
        rank[3].addEventListener('click',function(){
            showRank('洋芋片');
        });
        rank[4].addEventListener('click',function(){
            showRank('巧克力');
        });
        
    </script>





    <!-- 點擊購物車增減數量傳回資料庫 -->
    <script>
        
        // if(sessionStorage['cutQty'] == null){
        //     sessionStorage['cutQty'] = $('.stockQty').eq(2).text();
        // }else{
            
        //     $('.stockQty').eq(2).text(sessionStorage['cutQty']);
        // }
        $(function(){
            $stockQty=$(".stockQty");
            console.log($stockQty);
            
            $stockQty.each(function(){
                let qty = $(this).text();
                console.log(`stock qty: ${qty}`);
                if(qty<=0){
                    let $tarBtn=$(this).closest(".stock").prev(".itemBtns").children(".cart");
                    $tarBtn.css({
                        "backgroundColor":"#ccc",
                        "color":"#aaa",
                        "cursor":"default",
                    })
                    $tarBtn.attr('disabled',true);
                    $tarBtn.addClass("zero");
                }
            })
        })
        
        

        $(".cart").click(function(){
            var i = $('.cart').index(this) - 19;
            var thisQty = $('.stockQty').eq(i);
            console.log(i);
            var qty = $(thisQty).text();
            // console.log(qty);
            // var qty = aa.firstChild.nodeValue;
            cutQty = qty - 1;
            // if(cutQty==0){
                // $(thisQty).text(0);
                $(thisQty).text(cutQty);
                $(this).css({backgroundColor:'#ccc',color:'#aaa'});
                $(this).attr('disabled',true);
            // }else{
                // fCutQty = sessionStorage['cutQty'];
                // console.log(cutQty);//9 8 7....
                // $(thisQty).text(cutQty);
                // sessionStorage['cutQty'] = cutQty;
                // console.log($(aa).text(fCutQty));
                // console.log(fCutQty);
            // }
        })
    </script>




    <!-- 點選前幾期預購商品 -->
    <script>
        function showGoods(month){
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange=function (){
                if( xhr.readyState == 4){
                    if( xhr.status == 200 ){
                        //將撈回來的資料取代原本的網頁內容 
                        document.getElementById("snacksRun").innerHTML = xhr.responseText;  
                    }else{
                    alert( xhr.status );
                    }
                }
            }
            var url = "getGoods.php?month=" + month;
            xhr.open("Get", url, true);
            xhr.send( null );
        }
        var preGoods = document.getElementsByClassName('month');
        preGoods[0].addEventListener('click',function(){
            showGoods('2019-01-01');
        });
        preGoods[1].addEventListener('click',function(){
            showGoods('2019-02-01');
        });
        preGoods[2].addEventListener('click',function(){
            showGoods('2019-03-01');
        });
        
    </script>

    <!-- 點販賣機提示點到哪一台 -->
    <script>
        // $('.vmImg img').click(function () {
        //     $('.locateImg').toggleClass('showYellow');
        // })

        // const aa=$('.vmImg img');
        // const bb=$('.locateImg');
        // console.log(`aa: ${aa}`);
        // console.log(`bb: ${bb}`);

        // aa.get(0).click(function () {
        //     bb.get(0).toggleClass('showYellow');
        // })

        // console.log(`$('.vmImg img')[0]: ${typeof($('.vmImg img')[0])}`);
        // console.log($('.vmImg img')[0]);

        $('.vmImg img').click(function () {
            //陣列無法使用事件處理函式
            // $('.locateImg')[0].removeClass('showYellow');
            // console.log($('.vmImg img').index(this));
            var locaA = $('.vmImg img').index(this);
            // $('.locateImg')[0].addClass('showYellow');
            var lightThis = $('.locateImg')[locaA];
            $(lightThis).addClass('showYellow');
            $('.locateImg').not(lightThis).removeClass('showYellow');
        })
    </script>


    <script>
            var concon= document.querySelectorAll('.countryImg > img');
            console.log(concon);
            
            var arr_country=[];
            concon.forEach(el=>{
                arr_country.push(el.alt.replace("座標",""));
            })
            console.log(`arr_country: ${arr_country}`);
            console.log(arr_country);

    </script>



    
</body>

</html>