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
        $totalRec = $countSta -> fetchColumn();
        $pages = ceil($totalRec/$recPerPage);
        if( isset($_REQUEST['pageNum']) ){
            $pageNum = $_REQUEST['pageNum'];
        }else{
            $pageNum = 1;
        }
        $start = ($pageNum - 1) * $recPerPage;

        if( isset($_REQUEST['search']) == false ){
            $sql = "select * from snack limit $start, $recPerPage";
        }else{
            $search= $_REQUEST['search'];
            $sql = "select * from snack where $search limit $start, $recPerPage";
        }
        $snacks = $pdo -> query($sql); 
        if( $snacks -> rowCount() == 0){
            $searchMsg = 'oops';
            $sql = "select * from snack limit $start, $recPerPage";
            $snacks = $pdo -> query($sql); 
        }

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
                <h3>商品資料管理</h3>
                <a href="back_addSnack.php"><button class="step">新增</button></a>
                <div class="searchBar">
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
                    <input type="text" id="searchName" placeholder="搜尋" size="10">
                    <i class="fas fa-search" id="searchClick"></i>
                </div>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    if( isset($searchMsg) ){
?>
                <div id="searchNone">
                    <p id="searchMsg">哎呀! 目前沒有符合搜尋條件的商品，以下是所有商品</p>
                    <img id="searchImg" src="../../images/blair/oops.png" alt="oops">
                </div>
 <?php
    }
?>               
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
                        <td><img src="../<?php echo $snackRow['snackPic']?>" alt="snack"></td>
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
                            $pagesP = $pages + 1;
                            $prev = $pageNum - 1 == 0? 1:$pageNum - 1;
                            $next = $pageNum + 1 == $pagesP? $pages:$pageNum + 1;
                            echo '<li class="page-item"><a href="back_snack.php?pageNum='.$prev.'" id="last" class="page-link"><i class="fas fa-chevron-left"></i></a></li>';
                            for($i=1; $i<=$pages; $i++){
                                if( $i == $pageNum ){
                                    echo '<li class="page-item"><a href="back_snack.php?pageNum='.$i.'" class="page-link nowLoc">'.$i.'</a></li>';
                                }else{
                                    echo '<li class="page-item"><a href="back_snack.php?pageNum='.$i.'" class="page-link">'.$i.'</a></li>';
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
    <script>
        function searchBar() {
            var country = document.getElementById('country').value;
            var kind = document.getElementById('kind').value;
            var flavor = document.getElementById('flavor').value;
            var name = document.getElementById('searchName').value;
            if (country != 0) {
                country = "'" + country + "'";
            }
            if (kind != 0) {
                kind = "'" + kind + "'";
            }
            if (flavor == 0) {
                var search = " nation = " + country + " and snackGenre = " + kind + " and snackName like '%" + name + "%'";
            } else {
                var search = " nation = " + country + " and snackGenre = " + kind + " and " + flavor + "Stars > 0" + " and snackName like '%" + name + "%'";
            }
            location.href = 'back_snack.php?search=' + search;
        }
        window.addEventListener('load', function () {
            document.getElementById('searchClick').addEventListener('click', searchBar);
        });
    </script>
</body>
</html>