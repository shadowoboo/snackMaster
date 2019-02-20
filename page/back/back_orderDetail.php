<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }
    
    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "select * from snackorder where orderNo = {$_REQUEST['orderNo']}";
        $orders = $pdo -> query($sql); 
        $sql = "select * from orderitem where orderNo = {$_REQUEST['orderNo']}";
        $orderItems = $pdo -> query($sql);
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
    <title>大零食家 - 後端管理系統</title>
    <style>
        table{
            margin: auto;
        }
    </style>
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
                <h3>訂單明細</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    $orderRow = $orders -> fetch();
?>
                <table>
                    <tr>
                        <th width="60">編號</th>
                        <th width="100">會員編號</th>
                        <th width="150">下單日期</th>
                        <th width="100">狀態</th>
                        <th width="100">付款方式</th>
                        <th width="60">總額</th>
                        <th width="100">收件人</th>
                        <th width="200">地址</th>
                        <th width="200">電話</th>
                    </tr>
                    <tr>   
                        <td><?php echo $orderRow['orderNo']?></td>
                        <td><?php echo $orderRow['memNo']?></td>
                        <td><?php echo $orderRow['orderTime']?></td>
                        <td><?php echo $orderRow['orderStatus']?></td>
                        <td><?php echo $orderRow['payWay']?></td>
                        <td><?php echo $orderRow['orderTotal']?></td>
                        <td><?php echo $orderRow['orderName']?></td>
                        <td><?php echo $orderRow['address']?></td>
                        <td><?php echo $orderRow['phone']?></td>
                    </tr>
                </table>
                <table style="margin-top: 45px;">
                    <tr>
                        <th width='100'>明細編號</th>
                        <th width='100'>商品編號</th>
                        <th width='100'>單價</th>
                        <th width='100'>數量</th>
                        <th width='100'>客製箱項目</th>
                    </tr>
                    <tr>
<?php
    while($itemRow = $orderItems -> fetch()){
?>
                    <td><?php echo $itemRow['orderItemNo']?></td>
                    <td><?php echo $itemRow['snackNo']?></td>
                    <td><?php echo $itemRow['snackPrice']?></td>
                    <td><?php echo $itemRow['snackQuan']?></td>
                    <td><?php echo $itemRow['customBoxItem']==1? '是':'否'?></td>
                    </tr>
<?php
    }
?>
                </table>
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