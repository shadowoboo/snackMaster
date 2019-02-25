<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }
    
    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "select * from coupon where coupNo = {$_REQUEST['coupNo']}";
        $coupon = $pdo -> query($sql);
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
                <h3>修改優惠券</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    $coupRow = $coupon -> fetch();
?>
                <form action="back_editCouponToDb.php" method="post" enctype="multipart/form-data">
                    <table id="editTable">
                        <tr>
                            <td>編號</td>
                            <td>
                                <?php echo $coupRow['coupNo'] ?>
                                <input type="hidden" name="coupNo" value="<?php echo $coupRow['coupNo'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>折價金額</td>
                            <td><?php echo $coupRow['discountPrice'] ?></td>
                        </tr>
                        <tr>
                            <td>圖片</td>
                            <td>
                                <img src="../<?php echo $coupRow['imgSRC']?>" alt="" id="preview">
                                <input type="file" name="upFile" id="upFile">
                            </td>
                        </tr>
                        <tr>
                            <td>名目</td>
                            <td>
                                <?php echo $coupRow['getWay'] ?>
                            </td>
                        </tr>
                    </table>
                    <button type="submit" class="cart">修改優惠券</button>   
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
            if(window.confirm('確定要放棄修改優惠券嗎？') == true){
                location.href = 'back_coupon.php';
            }
        })
        document.getElementById('upFile').onchange = function(e){
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(){
                document.getElementById('preview').src = reader.result;
            }
            reader.readAsDataURL(file);
        }
    </script>
</body>
</html>