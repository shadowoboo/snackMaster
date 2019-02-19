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
        $sql = 'select count(snackNo) from snack';
        $countSta = $pdo -> query($sql);
        $totalRec = ($countSta -> fetchColumn() )-1;
        $pages = ceil($totalRec/$recPerPage);
        if( isset($_REQUEST['pageNum']) ){
            $pageNum = $_REQUEST['pageNum'];
        }else{
            $pageNum = 1;
        }
        $start = ($pageNum - 1) * $recPerPage;
        $sql = "select * from snack limit $start, $recPerPage";
        $snacks = $pdo -> query($sql); 
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
                <h3>商品資料管理</h3>
                <a href="back_addSnack.php"><button class="step">新增</button></a>
                <table id="snack">
                    <tr>
                        <th width="55">編輯</th>
                        <th width="55">編號</th>
                        <th width="80">種類</th>
                        <th width="120">名稱</th>
                        <th width="55">價格</th>
                        <th width="55">國家</th>
                        <th width="120">圖片</th>
                        <th width="55">上下架</th>
                        <th width="80">販賣機<br>販售</th>
                        <th width="80">零食箱<br>年月</th>
                        <th width="80">好評度<br>總次數</th>
                        <th width="80">好評度<br>總星等</th>
                        <th width="80">酸度<br>總次數</th>
                        <th width="80">酸度<br>總星等</th>
                        <th width="80">甜度<br>總次數</th>
                        <th width="80">甜度<br>總星等</th>
                        <th width="80">辣度<br>總次數</th>
                        <th width="80">辣度<br>總星等</th>
                        <th width="510">描述</th>
                        <th width="300">成分</th>
                    </tr>
                    <tr>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    while( $snackRow = $snacks -> fetch() ){
?>
                        <td>
                            <form action="back_editSnack.php">
                                <input type="hidden" name="snackNo" value="<?php echo $snackRow['snackNo']?>">
                                <a href="">
                                    <button type="submit" id="subBtn"><i class="fas fa-edit"></i></button>
                                </a>
                            </form>
                        </td>
                        <td><?php echo $snackRow['snackNo']?></td>
                        <td><?php echo $snackRow['snackGenre']?></td>
                        <td><?php echo $snackRow['snackName']?></td>
                        <td><?php echo $snackRow['snackPrice']?></td>
                        <td><?php echo $snackRow['nation']?></td>
                        <td><?php echo $snackRow['snackPic']?></td>
                        <td><?php echo $snackRow['snackStatus'] == 1? '上架中':'下架中'; ?></td>
                        <td><?php echo $snackRow['snackVending'] == 1? '是':'否'; ?></td>
                        <td><?php echo $snackRow['boxDate']?></td>
                        <td><?php echo $snackRow['goodTimes']?></td>
                        <td><?php echo $snackRow['goodStars']?></td>
                        <td><?php echo $snackRow['sourTimes']?></td>
                        <td><?php echo $snackRow['sourStars']?></td>
                        <td><?php echo $snackRow['sweetTimes']?></td>
                        <td><?php echo $snackRow['sweetStars']?></td>
                        <td><?php echo $snackRow['spicyTimes']?></td>
                        <td><?php echo $snackRow['spicyStars']?></td>
                        <td><?php echo $snackRow['snackWord']?></td>
                        <td><?php echo $snackRow['snackIngre']?></td>
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
                            echo '<li class="page-item"><a href="back_snack.php?pageNum='.$prev.'" id="last" class="page-link"><i class="fas fa-chevron-left"></i></a></li>';
                            for($i=1; $i<=$pages; $i++){
                                if( $i == $pageNum ){
                                    echo '<li class="page-item"><a href="back_snack.php?pageNum='.$i.'" class="page-link nowLoc">0'.$i.'</a></li>';
                                }else{
                                    echo '<li class="page-item"><a href="back_snack.php?pageNum='.$i.'" class="page-link">0'.$i.'</a></li>';
                                }
                            }
                            echo '<li class="page-item"><a href="back_snack.php?pageNum='.$next.'" id="next" class="page-link"><i class="fas fa-chevron-right"></i></a></li>';
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