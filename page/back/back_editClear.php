<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }
    
    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $snackSql = "select snackNo from snack where snackGenre != '客製箱' and snackGenre != '預購箱'";
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
    <script src="../../js/alert.js"></script>
    <style>
        .backstage #contentWrap #content table{
            margin: auto;
            margin-bottom: 30px;
        }
        .backstage #contentWrap #content table td{
            width: 180px;
        }
        .backstage #contentWrap #content button, #cancel, #submit{
            width: 120px;
            height: 46px;
        }
        #delete{
            background-color: #fbc84a;
        }
        #delete:hover{
            background-color: #ffb600;
        }
        #content form{
            text-align: center;
        }
        #content form select, form input, textarea{
            color: #737374;
            font-size: 16px;
        }
    </style>
<?php
    if($_SESSION['managerName'] == 'guest'){
        echo '<style>#submit{cursor: no-drop; background: #aaa; color: #ddd}</style>';
    }
?>
    <title>大零食家 - 後端管理系統</title>
</head>
<body>
    <div class="backstage">
<?php
    require_once('back_menu.php');
?>
        <div id="contentWrap">
            <div id="content">
                <h3>修改即期品專案</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    $clearRow = $clears -> fetch();
?>
                <form id="myForm">
                    <table>
                        <tr>
                            <th width="60">編號</th>
                            <th width="200">開始時間</th>
                            <th width="200">結束時間</th>
                        </tr>
                        <tr>   
                            <td>
                                <?php echo $clearRow['clearanceNo']?>
                                <input type="hidden" name="clearanceNo" value="<?php echo $clearRow['clearanceNo'] ?>">
                            </td>
                            <td>
                                <input type="date" name="startTime" value="<?php echo substr($clearRow['startTime'], 0, 10)?>">
                            </td>
                            <td>
                                <input type="date" name="endTime" value="<?php echo substr($clearRow['endTime'], 0, 10)?>">
                            </td>
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
                    <td>
                        <?php echo $i?>
                    </td>
                    <td><?php echo $itemRow['snackNo']?></td>
                    <td><?php echo $itemRow['snackName']?></td>
                    <td><?php echo $itemRow['snackPrice']?></td>
                    <td><input type="text" name="item<?php echo $i?>Price" value="<?php echo $itemRow['salePrice']?>"></td>
                    <td><input type="text" name="item<?php echo $i?>Qty" value="<?php echo $itemRow['quantity']?>"></td>
                    </tr>
<?php
        $i++;
    }
?>                    
                    </table>
                    <input type="button" class="cart" id="submit" value="修改專案" <?php echo $_SESSION['managerName'] == 'guest'? 'disabled':'' ?>>
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
            confirmBox('確定要放棄修改即期品專案嗎？', function (){
                location.href = 'back_clearance.php';
            });
        })
        document.getElementById('submit').addEventListener('click', function (){
            var xhr = new XMLHttpRequest();
            xhr.onload = function () {
                if (xhr.status == 200) {
                    if( xhr.responseText == 'true' ){
                        alertBox('修改即期品專案成功！');
                        document.getElementById('sure').addEventListener('click', function (){
                        location.href='back_clearance.php';
                        });
                    }else{
                        alertBox(xhr.responseText);
                    }
                } else {
                    alertBox(xhr.status);
                }
            } 

            xhr.open("Post", "back_editClearToDb.php", true);
            var myForm = new FormData( document.getElementById('myForm'));
            xhr.send( myForm );  
        })
    </script>
</body>
</html>