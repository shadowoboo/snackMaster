<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }
    
    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $sql = "select * from eva e, evareport r where e.evaNo = r.evaNo and r.evaRepNo = {$_REQUEST['evaRepNo']}";
        $eva = $pdo -> query($sql);
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
                <h3>審核評價檢舉</h3>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    $evaRow = $eva -> fetch();
    $sql = "select * from member where memNo = {$evaRow['memNo']}";
    $members = $pdo -> query($sql);
    $member = $members -> fetch();
?>
                <form action="back_dealEvaReportToDb.php">
                    <table id="editTable">
                        <tr>
                            <td width="120"></td>
                            <td width="180"></td>
                        </tr>
                        <tr>
                            <td>編號</td>
                            <td id="evaRepNo"><?php echo $evaRow['evaRepNo'] ?></td>
                        </tr>
                        <tr>
                            <td>評價編號</td>
                            <td id="evaNo"><?php echo $evaRow['evaNo']?></td>
                        </tr>
                        <tr>
                            <td>會員編號</td>
                            <td><?php echo $member['memNo']?></td>
                        </tr>
                        <tr>
                            <td>會員帳號</td>
                            <td><?php echo $member['memId']?></td>
                        </tr>
                        <tr>
                            <td>評價內容</td>
                            <td style="padding: 15px 10px;"><?php echo $evaRow['evaCtx'] ?></td>
                        </tr>
                        <tr>
                            <td>檢舉時間</td>
                            <td><?php echo $evaRow['evaRepDate']?></td>
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
        evaRepNo = document.getElementById('evaRepNo').innerText;
        evaNo = document.getElementById('evaNo').innerText;
        document.getElementById('sustain').addEventListener('click', function (){
            confirmBox('檢舉成立後，評價、相關積分及留言都將會被刪除，確定檢舉成立嗎？', function (){
                var xhr = new XMLHttpRequest();
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        if( xhr.responseText == 'true' ){
                            alertBox('檢舉審核已完成！');
                            document.getElementById('sure').addEventListener('click', function (){
                                location.href='back_evaReport.php';
                            });
                        }else{
                            alertBox(xhr.responseText);
                        }
                    } else {
                        alertBox(xhr.status);
                    }
                } 
                var url = 'back_dealEvaReportToDb.php?status=sustain&evaRepNo=' + evaRepNo + '&evaNo=' +evaNo;
                xhr.open("Get", url, true);
                xhr.send( null );
            });
        })
        document.getElementById('overrule').addEventListener('click', function (){
            confirmBox('確定後將無法再改變審核結果，確定檢舉不成立嗎？', function (){
                var xhr = new XMLHttpRequest();
                xhr.onload = function () {
                    if (xhr.status == 200) {
                        if( xhr.responseText == 'true' ){
                            alertBox('檢舉審核已完成！');
                            document.getElementById('sure').addEventListener('click', function (){
                                location.href='back_evaReport.php';
                            });
                        }else{
                            alertBox(xhr.responseText);
                        }
                    } else {
                        alertBox(xhr.status);
                    }
                } 
                var url = 'back_dealEvaReportToDb.php?status=overrule&evaRepNo=' + evaRepNo + '&evaNo=' +evaNo;;
                xhr.open("Get", url, true);
                xhr.send( null );
            });
        })
    </script>
</body>
</html>