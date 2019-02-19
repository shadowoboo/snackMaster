<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }
    
    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
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
    <link rel="stylesheet" href="../../css/backstage.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <style>
        .backstage #contentWrap #content table{
            margin: auto;
            margin-bottom: 30px;
        }
        .backstage #contentWrap #content table td{
            width: 350px;
        }
        .backstage #contentWrap #content button, #cancel{
            width: 120px;
            height: 46px;
        }
        #content form{
            text-align: center;
        }
        #content form select, form input, textarea{
            color: #737374;
            font-size: 16px;
        }
    </style>
    <title>大零食家 - 後端管理系統</title>
</head>
<body>
    <div class="backstage">
        <div id="menu">
            <div id="logo">
                <img src="../../images/tina/LOGO1.png" alt="">
            </div>
            <p>歡迎，管理員 <span id="manager"><?php echo $_SESSION['managerName'] ?></span></p>
            <ul id="menuUl">
                    <li>
                        <a href="">商品資料管理</a>
                    </li>
                    <li>
                        <a href="">訂單管理</a>
                    </li>
                    <li>
                        <a href="">會員管理</a>
                    </li>
                    <li>
                        <a href="">優惠券管理</a>
                    </li>
                    <li>
                        <a href="">排行榜管理</a>
                    </li>
                    <li>
                        <a href="">販賣機管理</a>
                    </li>
                    <li>
                        <a href="">客製化用素材</a>
                    </li>
                    <li>
                        <a href="">即期品專案管理</a>
                    </li>
                    <li>
                        <a href="">審核檢舉</a>
                    </li>
                    <li>
                        <a href="">帳號管理</a>
                    </li>
                    <a href="back_logout.php" id="logout">登出</a>
            </ul>
        </div>
        <div id="contentWrap">
            <div id="content">
                <h3>新增商品資料</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
?>
                <form action="back_snackToDb.php">
                    <table>
                        <tr>
                            <td>種類</td>
                            <td>
                                <select name="genre">
                                    <option value="巧克力">巧克力</option>
                                    <option value="糖果">糖果</option>
                                    <option value="餅乾">餅乾</option>
                                    <option value="洋芋片">洋芋片</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>名稱</td>
                            <td><input type="text" name="snackName" size="28"></td>
                        </tr>
                        <tr>
                            <td>價格</td>
                            <td><input type="text" name="snackPrice" size="6"></td>
                        </tr>
                        <tr>
                            <td>國家</td>
                            <td>
                                <select name="nation">
                                    <option value="巴西">巴西</option>
                                    <option value="日本">日本</option>
                                    <option value="美國">美國</option>
                                    <option value="英國">英國</option>
                                    <option value="埃及">埃及</option>
                                    <option value="德國">德國</option>
                                    <option value="澳洲">澳洲</option>
                                    <option value="韓國">韓國</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>圖片路徑</td>
                            <td><input type="text" name="snackPic" size="28"></td>
                        </tr>
                        <tr>
                            <td>上下架狀態</td>
                            <td>
                                <select name="snackStatus">
                                    <option value="1">上架中</option>
                                    <option value="0">下架中</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>販賣機販售</td>
                            <td>
                                <select name="snackVending">
                                    <option value="1">是</option>
                                    <option value="0">否</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>販賣機年月</td>
                            <td>
                                <input type="month" name="boxDate">
                            </td>
                        </tr>
                        <tr>
                            <td>零食描述</td>
                            <td><textarea name="snackWord" rows="4" cols="40"></textarea></td>
                        </tr>
                        <tr>
                            <td>成分</td>
                            <td><textarea name="snackIngre" rows="2" cols="40"></textarea></td>
                        </tr>
                    </table>
                    <button type="submit" class="cart" id="commit">新增商品</button>   
                    <input type="button" class="cart" id="cancel" value="放棄新增">
                </form>
            </div>
            <footer>
                <p id="copy">Copyright©2019 Snack Master</p>
            </footer>
        </div>
    </div> 
    <script>
        document.getElementById('cancel').addEventListener('click', function (){
            if(window.confirm('確定要放棄新增商品嗎？') == true){
                location.href = 'back_snack.php';
            }
        })
    </script>
</body>
</html>