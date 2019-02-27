<?php
try{
  require_once("connectcd105g2.php");
  $sql = "SELECT * FROM `snack` WHERE boxDate = :boxDate";
  $goodsRow = $pdo->prepare( $sql );
  $goodsRow->bindValue(":boxDate", $_REQUEST["month"]);
  $goodsRow->execute();

    //送出html結構字串
    $html = '';
    $goods = $goodsRow->fetchAll();
    $html .= "<div class='snacksRunImg'>
                <a href='showItem.php?snackNo={$goods[0]["snackNo"]}'>
                    <p>{$goods[0]["snackName"]}&nbsp;&nbsp;<span>&nbsp;$&nbsp;{$goods[0]["snackPrice"]}</span></p>
                    <img src='{$goods[0]["snackPic"]}' alt='零食'>
                </a>
            </div>
            <div class='snacksRunImg'>
                <a href='showItem.php?snackNo={$goods[1]["snackNo"]}'>
                    <p>{$goods[1]["snackName"]}&nbsp;&nbsp;<span>&nbsp;$&nbsp;{$goods[1]["snackPrice"]}</span></p>
                    <img src='{$goods[1]["snackPic"]}' alt='零食'>
                </a>
            </div>
            <div class='snacksRunImg'>
                <a href='showItem.php?snackNo={$goods[2]["snackNo"]}'>
                    <p>{$goods[2]["snackName"]}<br><span>&nbsp;$&nbsp;{$goods[2]["snackPrice"]}</span></p>
                    <img src='{$goods[2]["snackPic"]}' alt='零食'>
                </a>
            </div>
            <div class='snacksRunImg'>
                <a href='showItem.php?snackNo={$goods[3]["snackNo"]}'>
                    <p>{$goods[3]["snackName"]}<br><span>&nbsp;$&nbsp;{$goods[3]["snackPrice"]}</span></p>
                    <img src='{$goods[3]["snackPic"]}' alt='零食'>
                </a>
            </div>
            <div class='snacksRunImg'>
                <a href='showItem.php?snackNo={$goods[4]["snackNo"]}'>
                    <p>{$goods[4]["snackName"]}<br><span>&nbsp;$&nbsp;{$goods[4]["snackPrice"]}</span></p>
                    <img src='{$goods[4]["snackPic"]}' alt='零食'>
                </a>
            </div>
            <div class='snacksRunImg'>
                <a href='showItem.php?snackNo={$goods[5]["snackNo"]}'>
                    <p>{$goods[5]["snackName"]}<br><span>&nbsp;$&nbsp;{$goods[5]["snackPrice"]}</span></p>
                    <img src='{$goods[5]["snackPic"]}' alt='零食'>
                </a>
            </div>";
    echo $html;   

}catch(PDOException $e){
  echo $e->getMessage();
}
?>