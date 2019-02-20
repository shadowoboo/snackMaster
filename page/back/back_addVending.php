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
                        <a href="back_snack.php">商品資料管理</a>
                    </li>
                    <li>
                        <a href="back_order.php">訂單管理</a>
                    </li>
                    <li>
                        <a href="back_member.php">會員管理</a>
                    </li>
                    <li>
                        <a href="back_coupon.php">優惠券管理</a>
                    </li>
                    <li>
                        <a href="back_rank.php">排行榜管理</a>
                    </li>
                    <li>
                        <a href="back_vending.php">販賣機管理</a>
                    </li>
                    <li>
                        <a href="back_material.php">客製化用素材</a>
                    </li>
                    <li>
                        <a href="back_clearance.php">即期品專案管理</a>
                    </li>
                    <li>
                        <a href="back_report.php">審核檢舉</a>
                    </li>
                    <li>
                        <a href="back_manager.php">後台帳號管理</a>
                    </li>
                    <a href="back_logout.php" id="logout">登出</a>
            </ul>
        </div>
        <div id="contentWrap">
            <div id="content">
                <h3>新增優惠券</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
?>
                <form action="back_vendingToDb.php">
                    <table>
                        <tr>
                            <td>經度</td>
                            <td><input type="text" name="maLnge" size="20"></td>
                        </tr>
                        <tr>
                            <td>緯度</td>
                            <td><input type="text" name="maLat" size="20"></td>
                        </tr>
                        <tr>
                            <td>圖片</td>
                            <td><input type="text" name="maPic" size="20"></td>
                        </tr>
                        <tr>
                            <td>地區</td>
                            <td>
                                <select name="maArea">
                                    <option value="桃園區">桃園區</option>
                                    <option value="中壢區">中壢區</option>
                                    <option value="八德區">八德區</option>
                                    <option value="龜山區">龜山區 </option>
                                    <option value="大溪區">大溪區 </option>
                                    <option value="平鎮區">平鎮區 </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>地址</td>
                            <td><input type="text" name="maAdd" size="20"></td>
                        </tr>
                    </table>
                    <button type="submit" class="cart" id="commit">新增販賣機</button>   
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
            if(window.confirm('確定要放棄新增販賣機嗎？') == true){
                location.href = 'back_vending.php';
            }
        })
    </script>
</body>
</html>