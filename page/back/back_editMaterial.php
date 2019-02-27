<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }
    
    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "select * from material where materialNo = {$_REQUEST['materialNo']}";
        $material = $pdo -> query($sql);
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
                <h3>修改客製化素材</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    $mateRow = $material -> fetch();
?>
                <form id="myForm">
                    <table id="editTable">
                        <tr>
                            <td>編號</td>
                            <td>
                                <?php echo $mateRow['materialNo'] ?>
                                <input type="hidden" name="materialNo" value="<?php echo $mateRow['materialNo'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>種類</td>
                            <td>
                                <label>
                                    <input type="radio" name ="materialGenre" value="img" <?php echo $mateRow['materialGenre']=='img'? 'checked':'' ?>>
                                    img
                                </label>
                                <label>
                                    <input type="radio" name ="materialGenre" value="color" <?php echo $mateRow['materialGenre']=='color'? 'checked':'' ?>>
                                    color
                                </label>
                                <label>
                                    <input type="radio" name ="materialGenre" value="colorstyle" <?php echo $mateRow['materialGenre']=='colorstyle'? 'checked':'' ?>>
                                    colorstyle
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>名稱</td>
                            <td>
                                <input type="text" name="materialName" value="<?php echo $mateRow['materialName'] ?>" size="26">
                            </td>
                        </tr>
                        <tr>
                            <td>內容</td>
                            <td>
                                <input type="text" name="materialPath" value="<?php echo $mateRow['materialPath'] ?>" size="26">
                            </td>
                        </tr>
                    </table>
                    <input type="button" class="cart" id="submit" value="修改素材">
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
            confirmBox('確定要放棄修改商品嗎？', function (){
                location.href = 'back_coupon.php';
            });
        })
        document.getElementById('submit').addEventListener('click', function (){
            var xhr = new XMLHttpRequest();
            xhr.onload = function () {
                if (xhr.status == 200) {
                    if( xhr.responseText == 'true' ){
                        alertBox('修改素材成功！');
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

            xhr.open("Post", "back_editMaterialToDb.php", true);
            var myForm = new FormData( document.getElementById('myForm'));
            xhr.send( myForm );  
        })
    </script>
</body>
</html>