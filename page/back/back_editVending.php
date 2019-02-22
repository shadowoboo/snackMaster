<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }
    
    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "select * from masell where maSellNo = {$_REQUEST['maSellNo']}";
        $vending = $pdo -> query($sql);
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
            width: 350px;
        }
        .backstage #contentWrap #content button, #cancel{
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
    <title>大零食家 - 後端管理系統</title>
</head>
<body>
    <div class="backstage">
<?php
    require_once('back_menu.php');
?>
        <div id="contentWrap">
            <div id="content">
                <h3>修改販賣機</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    $venRow = $vending -> fetch();
?>
                <form action="back_editVendingToDb.php">
                    <table id="editTable">
                        <tr>
                            <td>編號</td>
                            <td>
                                <?php echo $venRow['maSellNo'] ?>
                                <input type="hidden" name="maSellNo" value="<?php echo $venRow['maSellNo'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>經度</td>
                            <td><input type="text" name="maLnge" size="26" value="<?php echo $venRow['maLnge'] ?>"></td>
                        </tr>
                        <tr>
                            <td>緯度</td>
                            <td><input type="text" name="maLat" size="26" value="<?php echo $venRow['maLat'] ?>"></td>
                        </tr>
                        <tr>
                            <td>圖片</td>
                            <td><input type="text" name="maPic" size="26" value="<?php echo $venRow['maPic'] ?>"></td>
                        </tr>
                        <tr>
                            <td>地區</td>
                            <td>
                                <select name="maArea">
                                    <option value="桃園區" <?php echo $venRow['maArea']=='桃園區'? 'selected':'' ?> >桃園區</option>
                                    <option value="中壢區" <?php echo $venRow['maArea']=='中壢區'? 'selected':'' ?> >中壢區</option>
                                    <option value="八德區" <?php echo $venRow['maArea']=='八德區'? 'selected':'' ?> >八德區</option>
                                    <option value="龜山區" <?php echo $venRow['maArea']=='龜山區'? 'selected':'' ?> >龜山區 </option>
                                    <option value="大溪區" <?php echo $venRow['maArea']=='大溪區'? 'selected':'' ?> >大溪區 </option>
                                    <option value="平鎮區" <?php echo $venRow['maArea']=='平鎮區'? 'selected':'' ?> >平鎮區 </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>地址</td>
                            <td>
                                <input type="text" name="maAdd" value="<?php echo $venRow['maAdd'] ?>" size="26">
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="cart">修改販賣機</button>   
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
            if(window.confirm('確定要放棄修改販賣機嗎？') == true){
                location.href = 'back_vending.php';
            }
        })
    </script>
</body>
</html>