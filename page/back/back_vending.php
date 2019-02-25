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
        $sql = 'select count(maSellNo) from masell';
        $countSta = $pdo -> query($sql);
        $totalRec = ($countSta -> fetchColumn());
        $pages = ceil($totalRec/$recPerPage);
        if( isset($_REQUEST['pageNum']) ){
            $pageNum = $_REQUEST['pageNum'];
        }else{
            $pageNum = 1;
        }
        $start = ($pageNum - 1) * $recPerPage;
        $sql = "select * from masell limit $start, $recPerPage";
        $vendings = $pdo -> query($sql); 
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
                <h3>販賣機管理</h3>
                <a href="back_addVending.php"><button class="step">新增</button></a>
                <table>
                    <tr>
                        <th width="60">編輯</th>
                        <th width="60">編號</th>
                        <th width="120">經度</th>
                        <th width="120">緯度</th>
                        <th width="120">圖片</th>
                        <th width="100">地區</th>
                        <th width="280">地址</th>
                    </tr>
                    <tr>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    while( $venRow = $vendings -> fetch() ){
?>
                        <td>
                            <form action="back_editVending.php">
                                <input type="hidden" name="maSellNo" value="<?php echo $venRow['maSellNo']?>">
                                <a href="">
                                    <button type="submit" id="subBtn"><i class="fas fa-edit"></i></button>
                                </a>
                            </form>
                        </td>
                        <td><?php echo $venRow['maSellNo']?></td>
                        <td><?php echo $venRow['maLnge']?></td>
                        <td><?php echo $venRow['maLat']?></td>
                        <td><img src="../<?php echo $venRow['maPic']?>" alt="vending"></td>
                        <td><?php echo $venRow['maArea']?></td>
                        <td><?php echo $venRow['maAdd']?></td>
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
                            echo '<li class="page-item"><a href="back_vending.php?pageNum='.$prev.'" id="last" class="page-link"><i class="fas fa-chevron-left"></i></a></li>';
                            for($i=1; $i<=$pages; $i++){
                                if( $i == $pageNum ){
                                    echo '<li class="page-item"><a href="back_vending.php?pageNum='.$i.'" class="page-link nowLoc">'.$i.'</a></li>';
                                }else{
                                    echo '<li class="page-item"><a href="back_vending.php?pageNum='.$i.'" class="page-link">'.$i.'</a></li>';
                                }
                            }
                            echo '<li class="page-item"><a href="back_vending.php?pageNum='.$next.'" id="next" class="page-link"><i class="fas fa-chevron-right"></i></a></li>';
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
        document.getElementById('next').addEventListener('click', function (){
            console.log( <?php echo $totalRec?> );
        });
    </script>
</body>
</html>