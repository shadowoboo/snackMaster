<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "select * from rank order by rankGenre, ranking";
        $ranks = $pdo -> query($sql); 
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
            margin-right: 40px;
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
                <h3>排行榜管理</h3>
                <button class="step" id="update">更新</button>
                <div></div>
                <table>
                    <tr>
                        <th width="100">種類</th>
                        <th width="100">排名</th>
                        <th width="100">商品編號</th>
                    </tr>
                    <tr>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }

    for( $i = 1; $i < 13; $i++ ){
        $rankRow = $ranks -> fetch();
?>
                        <td><?php echo $rankRow['rankGenre']?></td>
                        <td><?php echo $rankRow['ranking']?></td>
                        <td><?php echo $rankRow['snackNo']?></td>
                    </tr>
<?php
    }
?>
                </table>
                <table>
                    <tr>
                        <th width="100">種類</th>
                        <th width="100">排名</th>
                        <th width="100">商品編號</th>
                    </tr>
                    <tr>
<?php
    for( $i = 1; $i < 13; $i++ ){
        $rankRow = $ranks -> fetch();
?>
                        <td><?php echo $rankRow['rankGenre']?></td>
                        <td><?php echo $rankRow['ranking']?></td>
                        <td><?php echo $rankRow['snackNo']?></td>
                    </tr>
<?php
    }
?>
                </table>
                <table>
                    <tr>
                        <th width="100">種類</th>
                        <th width="100">排名</th>
                        <th width="100">商品編號</th>
                    </tr>
                    <tr>
<?php
    for( $i = 1; $i < 7; $i++ ){
        $rankRow = $ranks -> fetch();
?>
                        <td><?php echo $rankRow['rankGenre']?></td>
                        <td><?php echo $rankRow['ranking']?></td>
                        <td><?php echo $rankRow['snackNo']?></td>
                    </tr>
<?php
    }
?>                </table>
            </div>
            <footer>
                <p id="copy">Copyright©2019 Snack Master</p>
            </footer>
        </div>
    </div> 
    <script>
        document.getElementById('update').addEventListener('click', function (){
            if(window.confirm('排行榜更新後，舊的排行榜資料將會消失，網站內容也會更新，確認要更新排行榜嗎？') == true){
                var xhr = new XMLHttpRequest();
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        if( xhr.responseText == 'true' ){
                            alert('更新排行榜成功！');
                            location.href='back_rank.php';
                        }else{
                            alert(xhr.responseText);
                        }
                    } else {
                        alert(xhr.status);
                    }
                } 
                xhr.open("Get", "back_rankToDb.php", true);
                xhr.send( null );
            }
        })
    
    </script>
</body>
</html>