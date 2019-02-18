<?php
    try {
        require_once("connectcd105g2.php");
        $sql = "select * from masell where maArea = :maArea";
        $masell = $pdo->prepare( $sql );
        $masell -> bindValue(":maArea", $_REQUEST["maArea"]);
        $masell -> execute();

        if( $masell->rowCount() == 0 ){
            echo "{}";
        }else{
            $html ='';
            while($sellRow = $masell->fetch(PDO::FETCH_ASSOC)){


            $html .= "
            <div class='map_serch_box'>
                <div class='map_serch_item'>
                    <div class='map_serch_item_pic'>
                        <img src='{$sellRow["maPic"]}' alt='sell_machine' id='maPic'>
                    </div>

                    <div class='map_serch_item_info'>
                        <div class='map_serch_item_info_point'>
                            <span id='maAdd'>{$sellRow["maAdd"]}</span>
                        </div>
                        <div class='map_serch_item_info_distance'>
                            <span>距離: 100公尺</span>
                        </div>
                        <div class='map_serch_info_line'>
                            <a href='#'>
                            <span>規劃路線
                                <i class='fas fa-location-arrow'></i>
                            </span>
                            </a>
                        </div>
                    </div>
                <div class='clearfix'></div>
            </div>
            </div>";
        }

        echo $html;
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
?>

