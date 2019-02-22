<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }
    
    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "select snackNo from snack where snackGenre != '客製箱' and snackGenre != '預購箱'";
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
    <style>
        .backstage #contentWrap #content table{
            margin: auto;
            margin-bottom: 30px;
        }
        .backstage #contentWrap #content table td{
            width: 180px;
        }
        .backstage #contentWrap #content button, #cancel{
            width: 120px;
            height: 46px;
        }
        #content form{
            text-align: center;
        }
        #content form select, form input, textarea{
            color: #737374;
            font-size: 16px;
        }
    </style>
    <title>大零食家 - 後端管理系統</title>
</head>
<body>
    <div class="backstage">
<?php
    require_once('back_menu.php');
?>
        <div id="contentWrap">
            <div id="content">
                <h3>新增即期品專案</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
?>
                <form action="back_clearanceToDb.php">
                    <table>
                        <tr>
                            <td>開始時間</td>
                            <td><input type="date" name="startTime" size="26"></td>
                        </tr>
                        <tr>
                            <td>結束時間</td>
                            <td><input type="date" name="endTime" size="26"></td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <th>明細編號</th>
                            <th>商品編號</th>
                            <th>出清價格</th>
                            <th>出清數量</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>
                                <select name="item1No">
                                    <?php
                                        while( $snackRow = $snacks -> fetch() ){
                                    ?>
                                        <option value="<?php echo $snackRow['snackNo'] ?>"><?php echo $snackRow['snackNo'] ?></option>                                    
                                    <?php        
                                        }
                                    ?>
                                </select>
                            </td>
                            <td><input type="text" name="item1Price" size="10"></td>
                            <td><input type="text" name="item1Qty" size="10"></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <select name="item2No">
                                    <?php
                                        $snacks = $pdo -> query($sql);
                                        while( $snackRow = $snacks -> fetch() ){
                                    ?>
                                        <option value="<?php echo $snackRow['snackNo'] ?>"><?php echo $snackRow['snackNo'] ?></option>                                    
                                    <?php        
                                        }
                                    ?>
                                </select>
                            </td>
                            <td><input type="text" name="item2Price" size="10"></td>
                            <td><input type="text" name="item2Qty" size="10"></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>
                                <select name="item3No">
                                    <?php
                                        $snacks = $pdo -> query($sql);
                                        while( $snackRow = $snacks -> fetch() ){
                                    ?>
                                        <option value="<?php echo $snackRow['snackNo'] ?>"><?php echo $snackRow['snackNo'] ?></option>                                    
                                    <?php        
                                        }
                                    ?>
                                </select>
                            </td>
                            <td><input type="text" name="item3Price" size="10"></td>
                            <td><input type="text" name="item3Qty" size="10"></td>
                        </tr>
                    </table>
                    <button type="submit" class="cart" id="commit">新增專案</button>   
                    <input type="button" class="cart" id="cancel" value="放棄新增">
                </form>
            </div>
            <footer>
                <p id="copy">Copyright©2019 Snack Master</p>
            </footer>
        </div>
    </div> 
    <script>
        document.getElementById('cancel').addEventListener('click', function (){
            if(window.confirm('確定要放棄新增即期品專案嗎？') == true){
                location.href = 'back_clearance.php';
            }
        })
    </script>
</body>
</html>