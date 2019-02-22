<?php
    session_start();
    try{
        require_once("connectcd105g2.php");
        $sql ="SELECT * from couponbox join coupon on coupon.coupNo = couponbox.coupNo where memNo = :memNo";
        $coupon = $pdo->prepare( $sql );
        $coupon->bindValue(":memNo", $_SESSION['memNo']);
        // $coupon->bindValue(":memNo", $_SESSION["memNo"]);
        $coupon->execute();
        if( $coupon->rowCount() == 0){
            echo "目前沒有優惠券~";
        }else{
            $html='';
            while($couponRow = $coupon->fetch(PDO::FETCH_ASSOC)){
    
                $html .="
                <tr>
                <td><img src='{$couponRow['imgSRC']}'></td>
                <td>{$couponRow['getWay']}</td>
                <td>{$couponRow['discountPrice']}</td>
                <td>{$couponRow['endDate']}</td>
                </tr>";
                echo $html;
            }
    }

    
    }catch(PDOEeception $e){
        echo $e->getMessage();
    }
?>