<?php
    session_start();
    if(isset($_SESSION["memId"])){
            require_once("connectcd105g2.php");
            $errMsg = "";
            try {
                //撈出 本登入會員 尚未使用 的優惠卷夾，依照到期日排列(先到期的排上面)
                $sql = "SELECT * FROM `coupon` JOIN couponbox ON coupon.coupNo = couponbox.coupNo WHERE memNo = ? and cUse=1 ORDER BY endDate";
                $coupon = $pdo->prepare( $sql ); //先編譯好
                $coupon->bindValue(1, $_SESSION["memId"]);
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
                    $html=$html."<option value=\"".$value."\">".$value."</option>";
                }
                echo $html;
            }
        }else{
            echo "aaa";//沒登入
        }

?>