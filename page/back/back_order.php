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
        $sql = 'select count(orderNo) from snackorder';
        $countSta = $pdo -> query($sql);
        $totalRec = $countSta -> fetchColumn();
        $pages = ceil($totalRec/$recPerPage);
        if( isset($_REQUEST['pageNum']) ){
            $pageNum = $_REQUEST['pageNum'];
        }else{
            $pageNum = 1;
        }
        $start = ($pageNum - 1) * $recPerPage;
        $sql = "select * from snackorder limit $start, $recPerPage";
        $orders = $pdo -> query($sql); 
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
<?php
    require_once('back_menu.php');
?>
        <div id="contentWrap">
            <div id="content">
                <h3>訂單管理</h3>
                <table>
                    <tr>
                        <th width="60">編號</th>
                        <th width="60">明細</th>
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
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    while( $orderRow = $orders -> fetch() ){
?>
                        <td><?php echo $orderRow['orderNo']?></td>
                        <td>
                            <form action="back_orderDetail.php">
                                <input type="hidden" name="orderNo" value="<?php echo $orderRow['orderNo']?>">
                                <a href="">
                                    <button type="submit" id="subBtn"><i class="fas fa-sitemap"></i></button>
                                </a>
                            </form>
                        </td>
                        <td><?php echo $orderRow['memNo']?></td>
                        <td><?php echo $orderRow['orderTime']?></td>
                        <td><?php echo $orderRow['orderStatus']?></td>
                        <td><?php echo $orderRow['payWay']?></td>
                        <td><?php echo $orderRow['orderTotal']?></td>
                        <td><?php echo $orderRow['orderName']?></td>
                        <td><?php echo $orderRow['address']?></td>
                        <td><?php echo $orderRow['phone']?></td>
                    </tr>
<?php
    }
?>
                </table>
                <div id="pagination">
                    <ul>
                        <?php
                            $pagesP = $pages + 1;
                            $prev = $pageNum - 1 == 0? 1:$pageNum - 1;
                            $next = $pageNum + 1 == $pagesP? $pages:$pageNum + 1;
                            echo '<li class="page-item"><a href="back_order.php?pageNum='.$prev.'" id="last" class="page-link"><i class="fas fa-chevron-left"></i></a></li>';
                            for($i=1; $i<=$pages; $i++){
                                if( $i == $pageNum ){
                                    echo '<li class="page-item"><a href="back_order.php?pageNum='.$i.'" class="page-link nowLoc">0'.$i.'</a></li>';
                                }else{
                                    echo '<li class="page-item"><a href="back_order.php?pageNum='.$i.'" class="page-link">0'.$i.'</a></li>';
                                }
                            }
                            echo '<li class="page-item"><a href="back_order.php?pageNum='.$next.'" id="next" class="page-link"><i class="fas fa-chevron-right"></i></a></li>';
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