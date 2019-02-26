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
    <title>大零食家 - 後端管理系統</title>
    <style>
        table{
            display: inline-block;
            vertical-align: top;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <div class="backstage">
<?php
    require_once('back_menu.php');
?>
        <div id="contentWrap">
            <div id="content">
                <h3>排行榜列表</h3>
                <table>
                    <tr>
                        <th width="60">種類</th>
                        <th width="60">排名</th>
                        <th width="62">商品編號</th>
                        <th width="80">商品名稱</th>
                    </tr>
                    <tr>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }

    $sql = "select * from snack where snackGenre = '巧克力' order by goodStars/goodTimes desc limit 6";
    $choco = $pdo -> query($sql);
    $i = 1;
    while( $chocoRow = $choco -> fetch() ){
?>
                        <td><?php echo $chocoRow['snackGenre']?></td>
                        <td><?php echo $i?></td>
                        <td><?php echo $chocoRow['snackNo']?></td>
                        <td><?php echo $chocoRow['snackName']?></td>
                    </tr>
<?php
        $i++;
    }
    $sql = "select * from snack where snackGenre = '餅乾' order by goodStars/goodTimes desc limit 6";
    $cookie = $pdo -> query($sql);
    $i = 1;
    while($cookieRow = $cookie -> fetch() ){
?>
                        <td><?php echo $cookieRow['snackGenre']?></td>
                        <td><?php echo $i?></td>
                        <td><?php echo $cookieRow['snackNo']?></td>
                        <td><?php echo $cookieRow['snackName']?></td>
                    </tr>
<?php
        $i++;
    }
?>
                </table>
                <table>
                    <tr>
                        <th width="60">種類</th>
                        <th width="60">排名</th>
                        <th width="62">商品編號</th>
                        <th width="80">商品名稱</th>
                    </tr>
                    <tr>
<?php
    $sql = "select * from snack where snackGenre = '糖果' order by goodStars/goodTimes desc limit 6";
    $candy = $pdo -> query($sql);
    $i = 1;
    while($candyRow = $candy -> fetch() ){
?>
                        <td><?php echo $candyRow['snackGenre']?></td>
                        <td><?php echo $i?></td>
                        <td><?php echo $candyRow['snackNo']?></td>
                        <td><?php echo $candyRow['snackName']?></td>
                    </tr>
<?php
        $i++;
    }
    $sql = "select * from snack where snackGenre = '洋芋片' order by goodStars/goodTimes desc limit 6";
    $chip = $pdo -> query($sql);
    $i = 1;
    while($chipRow = $chip -> fetch() ){
?>
                        <td><?php echo $chipRow['snackGenre']?></td>
                        <td><?php echo $i?></td>
                        <td><?php echo $chipRow['snackNo']?></td>
                        <td><?php echo $chipRow['snackName']?></td>
                    </tr>
<?php
        $i++;
    }
?>
                </table>
                <table>
                    <tr>
                        <th width="60">種類</th>
                        <th width="60">排名</th>
                        <th width="62">商品編號</th>
                        <th width="80">商品名稱</th>
                    </tr>
                    <tr>
<?php
    $sql = "select * from snack order by goodStars/goodTimes desc limit 6";
    $all = $pdo -> query($sql);
    $i = 1;
    while($allRow = $all -> fetch() ){
?>
                        <td>綜合</td>
                        <td><?php echo $i?></td>
                        <td><?php echo $allRow['snackNo']?></td>
                        <td><?php echo $allRow['snackName']?></td>
                    </tr>
<?php
        $i++;
    }
?>                </table>
            </div>
            <footer>
                <p id="copy">Copyright©2019 Snack Master</p>
            </footer>
        </div>
    </div> 
</body>
</html>