<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }
    
    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "select * from snack where snackNo = {$_REQUEST['snackNo']}";
        $snack = $pdo -> query($sql);
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
                <h3>修改商品資料</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    $snackRow = $snack -> fetch();
?>
                <form id="myForm" method="post" enctype="multipart/form-data">
                    <table id="editTable">
                        <tr>
                            <td>編號</td>
                            <td>
                                <?php echo $snackRow['snackNo'] ?>
                                <input type="hidden" name="snackNo" value="<?php echo $snackRow['snackNo'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>種類</td>
                            <td>
                                <label>
                                    <input type="radio" name ="snackGenre" value="巧克力" <?php echo $snackRow['snackGenre']=='巧克力'? 'checked':'' ?>>
                                    巧克力
                                </label>
                                <label>
                                    <input type="radio" name ="snackGenre" value="糖果" <?php echo $snackRow['snackGenre']=='糖果'? 'checked':'' ?>>
                                    糖果
                                </label>
                                <label>
                                    <input type="radio" name ="snackGenre" value="餅乾" <?php echo $snackRow['snackGenre']=='餅乾'? 'checked':'' ?>>
                                    餅乾
                                </label>
                                <label>
                                    <input type="radio" name ="snackGenre" value="洋芋片" <?php echo $snackRow['snackGenre']=='洋芋片'? 'checked':'' ?>>
                                    洋芋片
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>名稱</td>
                            <td>
                                <input type="text" name="snackName" value="<?php echo $snackRow['snackName'] ?>" size="28">
                            </td>
                        </tr>
                        <tr>
                            <td>價格</td>
                            <td>
                                <input type="text" name="snackPrice" value="<?php echo $snackRow['snackPrice'] ?>" size="6">
                            </td>
                        </tr>
                        <tr>
                            <td>國家</td>
                            <td>
                                <select name="nation">
                                    <option value="巴西" <?php echo $snackRow['nation']=='巴西'? 'selected':'' ?>>巴西</option>
                                    <option value="日本" <?php echo $snackRow['nation']=='日本'? 'selected':'' ?>>日本</option>
                                    <option value="美國" <?php echo $snackRow['nation']=='美國'? 'selected':'' ?>>美國</option>
                                    <option value="英國" <?php echo $snackRow['nation']=='英國'? 'selected':'' ?>>英國</option>
                                    <option value="埃及" <?php echo $snackRow['nation']=='埃及'? 'selected':'' ?>>埃及</option>
                                    <option value="德國" <?php echo $snackRow['nation']=='德國'? 'selected':'' ?>>德國</option>
                                    <option value="澳洲" <?php echo $snackRow['nation']=='澳洲'? 'selected':'' ?>>澳洲</option>
                                    <option value="韓國" <?php echo $snackRow['nation']=='韓國'? 'selected':'' ?>>韓國</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>圖片</td>
                            <td>
                                <img id="oldPic" src="../<?php echo $snackRow['snackPic'] ?>" alt="snack">
                                <input type="file" name="upFile" id="upFile">
                            </td>
                        </tr>
                        <tr>
                            <td>上下架狀態</td>
                            <td>
                                <label>
                                    <input type="radio" name ="snackStatus" value="1" <?php echo $snackRow['snackStatus']=='1'? 'checked':'' ?>>
                                    上架中
                                </label>
                                <label>
                                    <input type="radio" name ="snackStatus" value="0" <?php echo $snackRow['snackStatus']=='0'? 'checked':'' ?>>
                                    下架中
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>販賣機販售</td>
                            <td>
                                <label>
                                    <input type="radio" name ="snackVending" value="1" <?php echo $snackRow['snackVending']=='1'? 'checked':'' ?>>
                                    是
                                </label>
                                <label>
                                    <input type="radio" name ="snackVending" value="0" <?php echo $snackRow['snackVending']=='0'? 'checked':'' ?>>
                                    否
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>販賣機年月</td>
                            <td>
                                <input type="month" name="boxDate" value="<?php echo substr($snackRow['boxDate'], 0, 7) ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>零食描述</td>
                            <td>
                                <textarea name="snackWord" rows="4" cols="40"><?php echo $snackRow['snackWord'] ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>成分</td>
                            <td>
                                <textarea name="snackIngre" rows="2" cols="40"><?php echo $snackRow['snackIngre'] ?>
                                </textarea>
                            </td>
                        </tr>
                    </table>
                    <input type="button" class="cart" id="submit" value="修改商品"  <?php echo $_SESSION['managerName'] == 'guest'? 'disabled':'' ?>>
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
                location.href = 'back_snack.php';
            });
        })
        document.getElementById('submit').addEventListener('click', function (){
            var xhr = new XMLHttpRequest();
            xhr.onload = function () {
                if (xhr.status == 200) {
                    if( xhr.responseText == 'true' ){
                        alertBox('修改商品成功！');
                        document.getElementById('sure').addEventListener('click', function (){
                            location.href='back_snack.php';
                        });
                    }else{
                        alertBox(xhr.responseText);
                    }
                } else {
                    alertBox(xhr.status);
                }
            } 

            xhr.open("Post", "back_editSnackToDb.php", true);
            var myForm = new FormData( document.getElementById('myForm'));
            xhr.send( myForm );  
        })
        document.getElementById('upFile').onchange = function(e){
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(){
                document.getElementById('oldPic').src = reader.result;
            }
            reader.readAsDataURL(file);
        }
    </script>
</body>
</html>