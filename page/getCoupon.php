<?php
    session_start();
    if(isset($_SESSION["memNo"])){
            require_once("connectcd105g2.php");
            $errMsg = "";
            try {
                //撈出 本登入會員 尚未使用 的優惠卷夾，依照到期日排列(先到期的排上面)
                $sql = "SELECT * FROM `coupon` JOIN couponbox ON coupon.coupNo = couponbox.coupNo WHERE memNo = ? and `status`=0 ORDER BY endDate";
                $coupon = $pdo->prepare( $sql ); //先編譯好
                $coupon->bindValue(1, $_SESSION["memNo"]);
                $coupon->execute();//執行之
            } catch (PDOException $e) {
                $errMsg .= "錯誤原因 : ".$e -> getMessage(). "<br>";
                $errMsg .= "錯誤行號 : ".$e -> getLine(). "<br>";
            }
            if($errMsg != ""){
                exit("<div><center>$errMg</center></div>");
            }elseif( $coupon->rowCount() == 0 ){
                echo "none";
            }else{
                $couponRow = $coupon->fetchAll(PDO::FETCH_ASSOC);
                $count=count($couponRow);
                $html="";
                for($i=0;$i<$count;$i++){
                    $value=$couponRow[$i]["discountPrice"];
                    $couponboxNo=$couponRow[$i]["couponboxNo"];
                    $html=$html."<option value=\"".$value."\""."data-couponboxno=\"".$couponboxNo."\">".$value."</option>";
                }
                $html.="<option value=\""."0"."\""."data-couponboxno=\""."none"."\">"."不使用"."</option>";
                echo $html;
            }
        }else{
            echo "0";//沒登入
        }

?>