<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }
    
    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "select * from msg m, msgreport r where m.msgNo = r.msgNo and r.msgReportNo = {$_REQUEST['msgReportNo']}";
        $msg = $pdo -> query($sql);
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
            /* width: 300px; */
        }
        .backstage #contentWrap #content button, .cart{
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
                <h3>審核留言檢舉</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    $msgRow = $msg -> fetch();
?>
                <form>
                    <table id="editTable">
                        <tr>
                            <td width="120"></td>
                            <td width="180"></td>
                        </tr>
                        <tr>
                            <td>編號</td>
                            <td id="msgReportNo"><?php echo $msgRow['msgReportNo'] ?></td>
                        </tr>
                        <tr>
                            <td>留言編號</td>
                            <td id="msgNo"><?php echo $msgRow['msgNo']?></td>
                        </tr>
                        <tr>
                            <td>留言內容</td>
                            <td style="padding: 15px 10px;"><?php echo $msgRow['msgText'] ?></td>
                        </tr>
                        <tr>
                            <td>檢舉時間</td>
                            <td><?php echo $msgRow['msgTime']?></td>
                        </tr>
                    </table>
                    <input type="button" class="cart" id="sustain" value="檢舉成立">
                    <input type="button" class="cart" id="overrule" value="檢舉不成立">
                </form>
            </div>
            <footer>
                <p id="copy">Copyright©2019 Snack Master</p>
            </footer>
        </div>
    </div> 
    <script>
        msgReportNo = document.getElementById('msgReportNo').innerText;
        msgNo = document.getElementById('msgNo').innerText;
        document.getElementById('sustain').addEventListener('click', function (){
            if(window.confirm('檢舉成立後，留言將會被刪除，確定檢舉成立嗎？') == true){
                var xhr = new XMLHttpRequest();
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        if( xhr.responseText == 'true' ){
                            alert('檢舉審核已完成！');
                            location.href='back_msgReport.php';
                        }else{
                            alert(xhr.responseText);
                        }
                    } else {
                        alert(xhr.status);
                    }
                } 
                var url = 'back_dealMsgReportToDb.php?status=sustain&msgReportNo=' + msgReportNo + '&msgNo=' + msgNo;
                xhr.open("Get", url, true);
                xhr.send( null );
            }
        })
        document.getElementById('overrule').addEventListener('click', function (){
            if(window.confirm('確定後將無法再改變審核結果，確定檢舉不成立嗎？') == true){
                var xhr = new XMLHttpRequest();
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        if( xhr.responseText == 'true' ){
                            alert('檢舉審核已完成！');
                            location.href='back_msgReport.php';
                        }else{
                            alert(xhr.responseText);
                        }
                    } else {
                        alert(xhr.status);
                    }
                } 
                var url = 'back_dealMsgReportToDb.php?status=overrule&msgReportNo=' + msgReportNo + '&msgNo=' + msgNo;;
                xhr.open("Get", url, true);
                xhr.send( null );
            }
        })
        
    
    </script>
</body>
</html>