<?php
    // session_start();
    // try{
    //     require_once("connectcd105g2.php");
    //     $sql = "select*from member where ";
    // }catch{

    // }

?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../css/loginBox.css">
    <link rel="stylesheet" href="../css/header.css">

    <title>Document</title>

</head> -->

<!-- <body> -->
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
                                    <li><a href="shopping.html">零食列表</a></li>
                                </ul>
                            </li>
                            <li><a href="gsell.html">尋找販賣機</a> </li>
                        </ul>
                    </div>
                </div>

                <ul class="login">
                    <li><span id="btnloglout">&nbsp</span></li>
                    <li><i class="fas fa-user-circle" id="memLogin"></i></li>
                    <li><i class="fas fa-shopping-cart" id="shopCart"></i></li>
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
    <div id="lightBox-wrap">
        <div id="lightBox">
            <div class="loginLeave">
                <span id="lightBoxLeave">X</span>
            </div>
            <ul class="tab-group">
                <li class="loginTab action  " id="open" onclick="changeway(event,'Loginpage')">登入</li>
                <li class="loginTab action" onclick="changeway(event,'signup')">註冊</li>
            </ul>
            <div class="loginTab-content">
                <!-----------------------------------登入表單------------------------------------  -->
                <!-- <form action="login_cy.php" id="Loginpage" class="tabContent" method="post" > -->
                <form action="" id="Loginpage" class="tabContent" method="post" >
                
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
                <form action="" id="LoginPageSend">
                    <input type="hidden" id="memId" name="memId">
                    <input type="hidden" id="memPsw" name="memPsw">
                </form>
        <!------------------------------------------------註冊表單------------------------------------------  -->
                <form action="get" id="signup" class="tabContent">
                    <table class="signUpBox">
                        <tr>
                            <td>
                                <label class="Box-name" for="signUpMemId">帳號</label>
                                <input type="text" name="signUpMemId" id="signUpMemId" size="12" autocomplete="off"
                                    placeholder="請輸入帳號">

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
                <form action="get" id="forgetPsw" class="tabContent">
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
    <!-- <script>
        //1.先開啟燈箱
        var memLogin = document.getElementById("memLogin");
        var lightBox = document.getElementById('lightBox-wrap');
        memLogin.addEventListener("click",showLightBox);
        function showLightBox(e){
            //icon 換色
             e.target.style.color = "#00457b";
            //  console.log('aaa');
             //點icon跳出燈箱
            lightBox.classList.toggle('show');
        }
      
      //2.頁籤切換 登入＋註冊＋忘記密碼
      function changeway(e,tabchange){
          var i,loginTab,tabContent;
          tabContent = document.getElementsByClassName('tabContent');
          for(i=0; i<tabContent.length; i++){
            tabContent[i].style.display="none";
          }
          loginTab = document.getElementsByClassName('loginTab');
        //   console.log('bbb');
          
          for(i=0; i<loginTab.length; i++){
              loginTab[i].classList.remove("active");
            // loginTab.className = loginTab[i].className.replace('active',"");
          }
          document.getElementById(tabchange).style.display = "block";
          e.target.classList.add("active");
        //   e.currentTarget.className += " active";
          
      }
      document.getElementById('open').click();
      //3.點x離開
      var lightBoxLeave = document.getElementById("lightBoxLeave");
      function leave(e){
          //點擊x燈箱關掉

          //icon換回灰色
      }

      lightBoxLeave.addEventListener("click",leave);
    </script> -->
    <!-- <script src="../js/header.js"></script> -->




<!-- </body> -->

<!-- </html> -->