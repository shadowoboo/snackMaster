<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }
    
    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "select * from manager where managerNo = {$_REQUEST['managerNo']}";
        $manager = $pdo -> query($sql);
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
                <h3>修改後台帳號</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    $magRow = $manager -> fetch();
?>
                <form id="myForm">
                    <table id="editTable">
                        <tr>
                            <td>編號</td>
                            <td>
                                <?php echo $magRow['managerNo'] ?>
                                <input type="hidden" name="managerNo" value="<?php echo $magRow['managerNo'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>姓名</td>
                            <td><input type="text" name="managerName" value="<?php echo $magRow['managerName'] ?>" size="16"></td>
                        </tr>
                        <tr>
                            <td>帳號</td>
                            <td>
                                <?php echo $magRow['managerId'] ?>
                                <input type="hidden" name="managerId" value="<?php echo $magRow['managerId'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>輸入密碼</td>
                            <td><input type="password" name="managerPsw" size="16">
                            </td>
                        </tr>
                    </table>
                    <input type="button" class="cart" id="submit" value="修改帳號">
                    <input type="button" class="cart" id="cancel" value="放棄修改">
                </form>
            </div>
            <footer>
                <p id="copy">Copyright©2019 Snack Master</p>
            </footer>
        </div>
    </div> 
    <script>
        document.getElementById('submit').addEventListener('click', function (){
            var xhr = new XMLHttpRequest();
            xhr.onload = function () {
                if (xhr.status == 200) {
                    if( xhr.responseText == 'false' ){
                        alert('密碼錯誤！請重新輸入');
                    }else{
                        alert('修改帳號成功！');
                        location.href='back_manager.php';
                    }
                } else {
                    alert(xhr.status);
                }
            } 

            xhr.open("Post", "back_editManagerToDb.php", true);
            var myForm = new FormData( document.getElementById('myForm'));
            xhr.send( myForm );    
        })
        document.getElementById('cancel').addEventListener('click', function (){
            if(window.confirm('確定要放棄修改帳號嗎？') == true){
                location.href = 'back_manager.php';
            }
        })
    </script>
</body>
</html>