<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }
    
    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "select * from snack where snackNo = {$_REQUEST['snackNo']}";
        $snack = $pdo -> query($sql);
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
                <h3>修改商品資料</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    $snackRow = $snack -> fetch();
?>
                <form action="back_editSnackToDb.php">
                    <table id="editTable">
                        <tr>
                            <td>編號</td>
                            <td>
                                <?php echo $snackRow['snackNo'] ?>
                                <input type="hidden" name="snackNo" value="<?php echo $snackRow['snackNo'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>種類</td>
                            <td>
                                <input type="text" name="snackGenre" value="<?php echo $snackRow['snackGenre'] ?>" size="10">
                            </td>
                        </tr>
                        <tr>
                            <td>名稱</td>
                            <td>
                                <input type="text" name="snackName" value="<?php echo $snackRow['snackName'] ?>" size="28">
                            </td>
                        </tr>
                        <tr>
                            <td>價格</td>
                            <td>
                                <input type="text" name="snackPrice" value="<?php echo $snackRow['snackPrice'] ?>" size="6">
                            </td>
                        </tr>
                        <tr>
                            <td>國家</td>
                            <td>
                                <input type="text" name="nation" value="<?php echo $snackRow['nation'] ?>" size="10">                                
                            </td>
                        </tr>
                        <tr>
                            <td>圖片路徑</td>
                            <td>
                                <input type="text" name="snackPic" value="<?php echo $snackRow['snackPic'] ?>" size="28">
                            </td>
                        </tr>
                        <tr>
                            <td>上下架狀態</td>
                            <td>
                                <input type="text" name="snackStatus" value="<?php echo $snackRow['snackStatus']== 1? '上架中':'下架中' ?>" size="10">
                            </td>
                        </tr>
                        <tr>
                            <td>販賣機販售</td>
                            <td>
                                <input type="text" name="snackVending" value="<?php echo $snackRow['snackVending']== 1? '是':'否' ?>" size="10">
                            </td>
                        </tr>
                        <tr>
                            <td>販賣機年月</td>
                            <td>
                                <input type="month" name="boxDate" value="<?php echo substr($snackRow['boxDate'], 0, 7) ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>零食描述</td>
                            <td>
                                <textarea name="snackWord" rows="4" cols="40"><?php echo $snackRow['snackWord'] ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>成分</td>
                            <td>
                                <textarea name="snackIngre" rows="2" cols="40"><?php echo $snackRow['snackIngre'] ?>
                                </textarea>
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="cart">修改商品</button>   
                    <input type="button" class="cart" id="cancel" value="放棄修改">
                </form>
            </div>
            <footer>
                <p id="copy">Copyright©2019 Snack Master</p>
            </footer>
        </div>
    </div> 
    <script>
        document.getElementById('cancel').addEventListener('click', function (){
            if(window.confirm('確定要放棄修改商品嗎？') == true){
                location.href = 'back_snack.php';
            }
        })
    </script>
</body>
</html>