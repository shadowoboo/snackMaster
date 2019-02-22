<?php
    ob_start();
    session_start();
    
    $errMsg = "";
    try {
        $memNo = $_SESSION['memNo'];
        require_once("connectcd105g2.php");
        $sql = "select * from member where memNo = {$memNo}";
        $members = $pdo -> query($sql);
        $member = $members -> fetch();
        $point = $member['memPoint'];
        if( $point >= 18000 ){
            //升到6等
            $sql = "update member set grade = 6 where memNo = {$memNo}";
            $grade = 6;
        }else if( $point >= 12000 ){
            //升到5等
            $sql = "update member set grade = 5 where memNo = {$memNo}";
            $grade = 5;
        }else if( $point >= 7200 ){
            //4
            $sql = "update member set grade = 4 where memNo = {$memNo}";
            $grade = 4;
        }else if( $point >= 3600 ){
            //3
            $sql = "update member set grade = 3 where memNo = {$memNo}";
            $grade = 3;
        }else if ( $point >= 1200 ){
            //2
            $sql = "update member set grade = 2 where memNo = {$memNo}";
            $grade = 2;
        }else if ( $point >= 100 ){
            //1
            $sql = "update member set grade = 1 where memNo = {$memNo}";
            $grade = 1;
        }

        $pdo -> exec($sql);
        $sql = "insert into couponbox values(:memNo, :coupNo, :startDate, :endDate, :cUse)";
        $coupon = $pdo -> prepare($sql);
        $coupon -> bindValue(":memNo", $memNo);
        $coupon -> bindValue(":coupNo", 8);
        $startDate = date("Y-m-d",time()) ;
        $coupon -> bindValue(":startDate", $startDate.' 00.00.00' );
        $endDate = date("Y-m-d", strtotime("+1 month"));
        $coupon -> bindValue(":endDate", $endDate.' 00.00.00' );
        $coupon -> bindValue(":cUse", 1);
        $coupon -> execute();

        if(strpos($member['memPic'], '\Level\level') != false){
            $sql = "update member set memPic = :memPic";
            $pic = $pdo -> prepare($sql);
            $memPic = "../images\Level\level{$grade}.png";
            $pic -> bindValue(":memPic", $memPic);
            $pic -> execute();
        }
        
        $sql = "select gradeName, memPic from member m join masterlevel l on m.grade = l.grade where memNo = {$memNo}";
        $grade = $pdo -> query($sql);
        $gradeRow = $grade -> fetch();

        echo $gradeRow['gradeName']."|".$gradeRow['memPic'];
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>