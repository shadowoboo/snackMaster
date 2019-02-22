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
    <style>
        .backstage #contentWrap #content table{
            margin: auto;
            margin-bottom: 30px;
        }
        .backstage #contentWrap #content table td{
            width: 350px;
        }
        .backstage #contentWrap #content button, #cancel, #submit{
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
                <h3>新增優惠券</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
?>
                <form id="myForm">
                    <table>
                        <tr>
                            <td>折價金額</td>
                            <td><input type="text" name="discountPrice" size="10"></td>
                        </tr>
                        <tr>
                            <td>圖片</td>
                            <td><input type="text" name="imgSRC" size="30"></td>
                        </tr>
                        <tr>
                            <td>名目</td>
                            <td>
                                <select name="getWay">
                                    <option value="刮刮樂">刮刮樂</option>
                                    <option value="猜箱子">猜箱子</option>
                                    <option value="升等獎勵">升等獎勵</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <input type="button" class="cart" id="submit" value="新增優惠券">
                    <input type="button" class="cart" id="cancel" value="放棄新增">
                </form>
            </div>
            <footer>
                <p id="copy">Copyright©2019 Snack Master</p>
            </footer>
        </div>
    </div> 
    <script>
        document.getElementById('submit').addEventListener('click', function (){
            if(window.confirm('優惠券新增後，折價金額將不能再修改，確認要新增優惠券嗎？') == true){
                var xhr = new XMLHttpRequest();
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        if( xhr.responseText == 'true' ){
                            alert('新增優惠券成功！');
                            location.href='back_coupon.php';
                        }else{
                            alert(xhr.responseText);
                        }
                    } else {
                        alert(xhr.status);
                    }
                } 

                xhr.open("Post", "back_couponToDb.php", true);
                var myForm = new FormData( document.getElementById('myForm'));
                xhr.send( myForm );  
            }
              
        })
        document.getElementById('cancel').addEventListener('click', function (){
            if(window.confirm('確定要放棄新增優惠券嗎？') == true){
                location.href = 'back_coupon.php';
            }
        })
    </script>
</body>
</html>