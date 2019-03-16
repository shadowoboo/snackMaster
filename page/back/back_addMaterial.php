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
                <h3>客製化素材</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
?>
                <form id="myForm">
                    <table>
                        <tr>
                            <td>種類</td>
                            <td>
                                <select name="materialGenre">
                                    <option value="img">img</option>
                                    <option value="color">color</option>
                                    <option value="cardstyle">cardstyle</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>名稱</td>
                            <td><input type="text" name="materialName" size="26"></td>
                        </tr>
                        <tr>
                            <td>內容</td>
                            <td><input type="text" name="materialPath" size="26"></td>
                        </tr>
                    </table>
                    <input type="button" class="cart" id="submit" value="新增素材" <?php echo $_SESSION['managerName'] == 'guest'? 'disabled':'' ?>>
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
            confirmBox('確定要放棄新增素材嗎？', function (){
                location.href = 'back_material.php';
            });
        })
        document.getElementById('submit').addEventListener('click', function (){
            var xhr = new XMLHttpRequest();
            xhr.onload = function () {
                if (xhr.status == 200) {
                    if( xhr.responseText == 'true' ){
                        alertBox('新增素材成功！');
                        document.getElementById('sure').addEventListener('click', function (){
                            location.href='back_material.php';
                        });
                    }else{
                        alertBox(xhr.responseText);
                    }
                } else {
                    alertBox(xhr.status);
                }
            } 

            xhr.open("Post", "back_materialToDb.php", true);
            var myForm = new FormData( document.getElementById('myForm'));
            xhr.send( myForm );  
        })
    </script>
</body>
</html>