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
    <script src="../../js/alert.js"></script>
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
                <h3>新增販賣機</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
?>
                <form id="myForm" method="post" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>經度</td>
                            <td><input type="text" name="maLnge" size="26"></td>
                        </tr>
                        <tr>
                            <td>緯度</td>
                            <td><input type="text" name="maLat" size="26"></td>
                        </tr>
                        <tr>
                            <td>圖片</td>
                            <td><img src="" alt="" id="preview">
                                <input type="file" name="upFile" id="upFile">
                            </td>
                        </tr>
                        <tr>
                            <td>地區</td>
                            <td>
                                <select name="maArea">
                                    <option value="桃園區">桃園區</option>
                                    <option value="中壢區">中壢區</option>
                                    <option value="八德區">八德區</option>
                                    <option value="龜山區">龜山區 </option>
                                    <option value="大溪區">大溪區 </option>
                                    <option value="平鎮區">平鎮區 </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>地址</td>
                            <td><input type="text" name="maAdd" size="26"></td>
                        </tr>
                    </table>
                    <input type="button" class="cart" id="submit" value="新增販賣機" <?php echo $_SESSION['managerName'] == 'guest'? 'disabled':'' ?>>
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
            confirmBox('確定要放棄新增販賣機嗎？', function (){
                location.href = 'back_vending.php';
            });
        })
        document.getElementById('submit').addEventListener('click', function (){
            if( document.getElementById('upFile').value == '' ){
                alertBox('未上傳圖片');
            }else{
                var xhr = new XMLHttpRequest();
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        if( xhr.responseText == 'true' ){
                            alertBox('新增販賣機成功！');
                            document.getElementById('sure').addEventListener('click', function (){
                            location.href='back_vending.php';
                        });
                        }else{
                            alertBox(xhr.responseText);
                        }
                    } else {
                        alertBox(xhr.status);
                    }
                } 

                xhr.open("Post", "back_vendingToDb.php", true);
                var myForm = new FormData( document.getElementById('myForm'));
                xhr.send( myForm );  
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