<?php
    $errMsg = "";
    try {
        require_once("connectcd105g2.php");
        $sql = "select * from snack where boxDate = 20190{$_REQUEST['month']}01";
        $snacks = $pdo->query($sql); 

        
        if( $snacks -> rowCount() == 0){
            echo 'oops';
        }else{
            $html = '';
	        for($i = 1; $i < 7; $i++){
                $snackRow = $snacks -> fetch();

                $sql = "SELECT e.evaCtx, e.memNo, e.snackNo, e.goodStar, m.memPic FROM eva e join member m on e.memNo = m.memNo where snackNo = :snackNo order by goodStar DESC limit 1";
                $eva = $pdo -> prepare($sql);
                $eva -> bindValue(":snackNo", $snackRow['snackNo']);
                $eva -> execute();
                $evaRow  = $eva -> fetch();
                $good = round($snackRow['goodStars'] / $snackRow['goodTimes'], 1);
                $html .= "<div class='carousel item{$i}'>
                            <div class='cardImg'>
                                <img src='{$snackRow['snackPic']}' alt='snack'>
                            </div>
                            <h4>[{$snackRow['nation']}]{$snackRow['snackName']}</h4>
                            <div class='review'>
                                <div class='profile'>
                                    <img src='{$evaRow['memPic']}' alt='profile'>
                                </div>
                                <div class='reviewLeft'>
                                    <div class='star' grad='{$good}'>
                                        <img src='../images/rankBoard/starMask.png' alt='星等'>
                                    </div>
                                    <p class='reviewWord'>
                                        {$evaRow['evaCtx']}
                                    </p>
                                </div>
                            </div>
                        </div>";
            };
            echo $html;
        }
    } catch (PDOException $e) {
        $errMsg .= "錯誤 : ".$e -> getMessage()."<br>";
        $errMsg .= "行號 : ".$e -> getLine()."<br>";
        echo $errMsg;
    }
?>