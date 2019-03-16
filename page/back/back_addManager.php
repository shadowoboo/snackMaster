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
            width: 180px;
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
                <h3>新增後台帳號</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
?>
                <form id="myForm">
                    <table>
                        <tr>
                            <td>姓名</td>
                            <td><input type="text" name="managerName" size="15"></td>
                        </tr>
                        <tr>
                            <td>帳號</td>
                            <td><input type="text" name="managerId" size="15"></td>
                        </tr>
                        <tr>
                            <td>密碼</td>
                            <td><input type="password" id="managerPsw" name="managerPsw" size="15"></td>
                        </tr>
                        <tr>
                            <td>確認密碼</td>
                            <td><input type="password" id="checkPsw" size="15"></td>
                        </tr>
                    </table>
                    <input type="button" class="cart" id="submit" value="新增帳號" <?php echo $_SESSION['managerName'] == 'guest'? 'disabled':'' ?>>
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
            if( document.getElementById('checkPsw').value == '' || document.getElementById('checkPsw').value != document.getElementById('managerPsw').value ){
                document.getElementById('managerPsw').value = '';
                document.getElementById('checkPsw').value = '';
                alertBox('密碼與確認密碼內容不正確！請重新輸入')
            }else{
                var xhr = new XMLHttpRequest();
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        if( xhr.responseText == 'false' ){
                            alertBox('已有重複帳號！請重新輸入');
                        }else{
                            alertBox('新增帳號成功！');
                            document.getElementById('sure').addEventListener('click', function (){
                                location.href='back_manager.php';
                            });
                        }
                    } else {
                        alertBox(xhr.status);
                    }
                } 

                xhr.open("Post", "back_managerToDb.php", true);
                var myForm = new FormData( document.getElementById('myForm'));
                xhr.send( myForm );    
            }
        });
        document.getElementById('cancel').addEventListener('click', function (){
            confirmBox('確定要放棄新增帳號嗎？', function (){
                location.href = 'back_manager.php';
            })
        })
    </script>
</body>
</html>