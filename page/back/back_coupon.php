<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $recPerPage = 12;
        $sql = 'select count(coupNo) from coupon';
        $countSta = $pdo -> query($sql);
        $totalRec = ($countSta -> fetchColumn() )-1;
        $pages = ceil($totalRec/$recPerPage);
        if( isset($_REQUEST['pageNum']) ){
            $pageNum = $_REQUEST['pageNum'];
        }else{
            $pageNum = 1;
        }
        $start = ($pageNum - 1) * $recPerPage;
        $sql = "select * from coupon limit $start, $recPerPage";
        $coupons = $pdo -> query($sql); 
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
                <h3>優惠券管理</h3>
                <a href="back_addCoupon.php"><button class="step">新增</button></a>
                <table>
                    <tr>
                        <th width="60">編號</th>
                        <th width="100">折價金額</th>
                        <th width="100">圖片</th>
                        <th width="150">名目</th>
                    </tr>
                    <tr>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    while( $coupRow = $coupons -> fetch() ){
?>
                        <td><?php echo $coupRow['coupNo']?></td>
                        <td><?php echo $coupRow['discountPrice']?></td>
                        <td><?php echo $coupRow['imgSRC']?></td>
                        <td><?php echo $coupRow['getWay']?></td>
                    </tr>
<?php
    }
?>
                </table>
                <div id="pagination">
                    <ul>
                        <?php
                            $prev = $pageNum - 1 == 0? 1:$pageNum - 1;
                            $next = $pageNum + 1 == 7? 6:$pageNum + 1;
                            echo '<li class="page-item"><a href="back_coupon.php?pageNum='.$prev.'" id="last" class="page-link"><i class="fas fa-chevron-left"></i></a></li>';
                            for($i=1; $i<=$pages; $i++){
                                if( $i == $pageNum ){
                                    echo '<li class="page-item"><a href="back_coupon.php?pageNum='.$i.'" class="page-link nowLoc">0'.$i.'</a></li>';
                                }else{
                                    echo '<li class="page-item"><a href="back_coupon.php?pageNum='.$i.'" class="page-link">0'.$i.'</a></li>';
                                }
                            }
                            echo '<li class="page-item"><a href="back_coupon.php?pageNum='.$next.'" id="next" class="page-link"><i class="fas fa-chevron-right"></i></a></li>';
                        ?>
                    </ul>
                </div>
            </div>
            <footer>
                <p id="copy">Copyright©2019 Snack Master</p>
            </footer>
        </div>
    </div> 
</body>
</html>