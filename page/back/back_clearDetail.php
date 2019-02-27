<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }
    
    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "select * from clearance where clearanceNo = {$_REQUEST['clearanceNo']}";
        $clears = $pdo -> query($sql); 
        $sql = "select * from clearanceitem c join snack s on c.snackNo = s.snackNo where c.clearanceNo = {$_REQUEST['clearanceNo']}";
        $clearItems = $pdo -> query($sql);
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
<?php
    require_once('back_menu.php');
?>  
        <div id="contentWrap">
            <div id="content">
                <h3>即期品專案明細</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    $clearRow = $clears -> fetch();
?>
                <table>
                    <tr>
                        <th width="60">編號</th>
                        <th width="200">開始時間</th>
                        <th width="200">結束時間</th>
                    </tr>
                    <tr>   
                        <td><?php echo $clearRow['clearanceNo']?></td>
                        <td><?php echo $clearRow['startTime']?></td>
                        <td><?php echo $clearRow['endTime']?></td>
                    </tr>
                </table>
                <table style="margin-top: 45px;">
                    <tr>
                        <th width='120'>明細編號</th>
                        <th width='120'>商品編號</th>
                        <th width='120'>商品名稱</th>
                        <th width='120'>商品原價</th>
                        <th width='120'>出清價格</th>
                        <th width='120'>出清數量</th>
                    </tr>
                    <tr>
<?php
    $i = 1;
    while($itemRow = $clearItems -> fetch()){
?>
                    <td><?php echo $i?></td>
                    <td><?php echo $itemRow['snackNo']?></td>
                    <td><?php echo $itemRow['snackName']?></td>
                    <td><?php echo $itemRow['snackPrice']?></td>
                    <td><?php echo $itemRow['salePrice']?></td>
                    <td><?php echo $itemRow['quantity']?></td>
                    </tr>
<?php
    $i++;
    }
?>
                </table>
            </div>
            <footer>
                <p id="copy">Copyright©2019 Snack Master</p>
            </footer>
        </div>
    </div> 
</body>
</html>