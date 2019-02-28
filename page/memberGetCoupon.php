<?php
    session_start();
    try{
        require_once("connectcd105g2.php");
        $sql ="SELECT * from couponbox join coupon on coupon.coupNo = couponbox.coupNo where memNo = :memNo and `status`=0 ORDER BY endDate";
        $coupon = $pdo->prepare( $sql );
        $coupon->bindValue(":memNo", $_SESSION['memNo']);
        $coupon->execute();
        if( $coupon->rowCount() == 0){
            echo "<center id='cou'>目前沒有優惠券~</center>";
        }else{
            $html='';
            while($couponRow = $coupon->fetch()){
                $endDate = substr($couponRow['endDate'], 0, 10);
                $html .="
                <tr>
                <td id='{$couponRow['coupNo']}'><img src='{$couponRow['imgSRC']}'></td>
                <td>{$couponRow['getWay']}</td>
                <td>{$couponRow['discountPrice']}</td>
                <td>{$endDate}</td>
                </tr>";
            }
            echo $html;
    }

    
    }catch(PDOEeception $e){
        echo $e->getMessage();
    }
?>