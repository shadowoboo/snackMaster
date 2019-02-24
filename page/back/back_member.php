<?php
    ob_start();
    session_start();
    if( isset($_SESSION['managerName']) == false ){
        header('location:back_login.html');
    }

    $errMsg = "";
    try {
        require_once("../connectcd105g2.php");
        $recPerPage = 12;
        $sql = 'select count(memNo) from member';
        $countSta = $pdo -> query($sql);
        $totalRec = $countSta -> fetchColumn();
        $pages = ceil($totalRec/$recPerPage);
        if( isset($_REQUEST['pageNum']) ){
            $pageNum = $_REQUEST['pageNum'];
        }else{
            $pageNum = 1;
        }
        $start = ($pageNum - 1) * $recPerPage;
        $sql = "select * from member limit $start, $recPerPage";
        $members = $pdo -> query($sql); 
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
    <title>大零食家 - 後端管理系統</title>
</head>
<body>
    <div class="backstage">
<?php
    require_once('back_menu.php');
?>
        <div id="contentWrap">
            <div id="content">
                <h3>會員管理</h3>
                <table>
                    <tr>
                        <th width="60">編號</th>
                        <th width="100">帳號</th>
                        <th width="100">姓名</th>
                        <th width="150">電話</th>
                        <th width="100">e-mail</th>
                        <th width="100">頭像</th>
                        <th width="60">等級</th>
                        <th width="100">積分</th>
                        <th width="150">狀態</th>
                        <th width="150">編輯狀態</th>
                    </tr>
                    <tr>
<?php
    if( $errMsg != ""){
        exit("<div><center>$errMsg</center></div>");
    }
    while( $memberRow = $members -> fetch() ){
?>
                        <td><?php echo $memberRow['memNo']?></td>
                        <td><?php echo $memberRow['memId']?></td>
                        <td><?php echo $memberRow['memName']?></td>
                        <td><?php echo $memberRow['memPhone']?></td>
                        <td><?php echo $memberRow['email']?></td>
                        <td><img src="../<?php echo $memberRow['memPic']?>" alt="memPic"></td>
                        <td><?php echo $memberRow['grade']?></td>
                        <td><?php echo $memberRow['memPoint']?></td>
                        <form action="back_editMemberToDb.php">
                            <td>
                                <label>
                                    <input type="radio" name="commentRight" value="1" <?php echo $memberRow['commentRight'] == 1? 'checked':''?> >
                                    正常
                                </label> 
                                <label>
                                    <input type="radio" name="commentRight" value="0" <?php echo $memberRow['commentRight'] == 0? 'checked':''?> >
                                    禁言
                                </label>
                            </td>
                            <td>
                                <input type="hidden" name="memNo" value="<?php echo $memberRow['memNo']?>">
                                <button type="submit" id="subBtn"><i class="fas fa-edit"></i></button>
                            </td>
                        </form>
                    </tr>
<?php
    }
?>
                </table>
                <div id="pagination">
                    <ul>
                        <?php
                            $pagesP = $pages + 1;
                            $prev = $pageNum - 1 == 0? 1:$pageNum - 1;
                            $next = $pageNum + 1 == $pagesP? $pages:$pageNum + 1;
                            echo '<li class="page-item"><a href="back_member.php?pageNum='.$prev.'" id="last" class="page-link"><i class="fas fa-chevron-left"></i></a></li>';
                            for($i=1; $i<=$pages; $i++){
                                if( $i == $pageNum ){
                                    echo '<li class="page-item"><a href="back_member.php?pageNum='.$i.'" class="page-link nowLoc">'.$i.'</a></li>';
                                }else{
                                    echo '<li class="page-item"><a href="back_member.php?pageNum='.$i.'" class="page-link">'.$i.'</a></li>';
                                }
                            }
                            echo '<li class="page-item"><a href="back_member.php?pageNum='.$next.'" id="next" class="page-link"><i class="fas fa-chevron-right"></i></a></li>';
                        ?>
                    </ul>
                </div>
            </div>
            <footer>
                <p id="copy">Copyright©2019 Snack Master</p>
            </footer>
        </div>
    </div> 
</body>
</html>