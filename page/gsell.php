<?php
$errMsg = "";
try {
    require_once("connectcd105g2.php");
    $sql = "select * from masell";
    $masell = $pdo->query($sql);
} catch (PDOException $e){
    $errMsg .= "錯誤 :".$e -> getMessage()."<br>";
    $errMsg .= "行號 :".$e -> getLine()."<br>";
}
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>尋找販賣機</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../css/nnnnn.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/gsell.css" />
    <!-- <link rel="stylesheet" href="../css/header.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/search.js"></script>
    <script src="../js/scratch.js"></script>
    <script src="../js/alert.js"></script>
</head>

<body>

<!-- if錯誤訊息 -->
    <?php
        if( $errMsg != ""){
            exit("<div><center>$errMsg</center></div>");
        }
    ?>
<!-- header -->
    <?php
        require_once('header.php');
    ?>


 <!-- search_mobile -->
    <div class="search_mobile">
    <!-- 手機 title -->
        <div class="search_title">
            <h2>尋找販賣機</h2>
        </div>

    <!-- 手機選單 -->
        <div class="search_select">
            <form action="" method="get" name="serch_list" class="serch_form">
                <select name="serch_place" class="maArea">
                    <option value="0">All</option>
                    <option value="桃園區">桃園區</option>
                    <option value="中壢區">中壢區</option>
                    <option value="八德區">八德區</option>
                    <option value="龜山區">龜山區 </option>
                    <option value="大溪區">大溪區 </option>
                    <option value="平鎮區">平鎮區 </option>
                </select> 
            </form>
            <!-- <a href="#" class="search_search" id="searchIcon"> -->
                <!-- <i class="fas fa-search search_search searchIcon"></i> -->
                <i class="fas fa-search-location search_search searchIcon"></i>
            <!-- </a> -->
        </div>
    </div>


    <!-- 整個google_search -->
    <div class="google_search">
        <!-- map api -->
        <div id="mapSearch">
            <div id="map"></div>
            <scrip src="../js/gsell.js"></scrip>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxP0uxcl_z9Y2bY7OkrWZg5TRhtkANEog">
            </script>        
            <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxP0uxcl_z9Y2bY7OkrWZg5TRhtkANEog&callback=initMap"> -->
        </div>
    
        <!-- 地圖篩選 -->
        <div class="mapSearch_resullt">

            <!-- 桌機 search_desk -->
            <div class="search_desk">
                 <!-- 桌機 title -->
                <div class="search_title_desk">
                <h2>尋找販賣機</h2>
                </div>
                <!-- 桌機選單 -->
                <div class="search_select_desk">
                <form action="" method="get" name="serch_list" class="serch_form">
                    <select name="serch_place" class="maArea">
                        <option value="0">All</option>
                        <option value="桃園區">桃園區</option>
                        <option value="中壢區">中壢區</option>
                        <option value="八德區">八德區</option>
                        <option value="龜山區">龜山區 </option>
                        <option value="大溪區">大溪區 </option>
                        <option value="平鎮區">平鎮區 </option>
                    </select> 
                </form>
                <!-- <a href="#" class="search_search_desk searchIcon"> -->
                <!-- <i class="fas fa-search search_search_desk searchIcon"></i> -->
                <i class="fas fa-search-location search_search_desk searchIcon"></i>
                <!-- </a> -->
                </div>
            </div>

        <!-- php 抓資料 -->
            <div class="change_gsell">
            <?php
                while($sellRow = $masell->fetch(PDO::FETCH_ASSOC)){
             ?>

            <!-- 第1個框  -->
            <div class="map_serch_box">
                <div class="map_serch_item">
                    <div class="map_serch_item_pic">
                        <img src="<?php echo $sellRow["maPic"];?>" alt="sell_machine" id="maPic">
                    </div>

                    <div class="map_serch_item_info">
                        <div class="map_serch_item_info_point">
                            <span id="maAdd"><?php echo $sellRow["maAdd"];?></span>
                        </div>
                        <div class="map_serch_item_info_distance">
                            <span class="distance" data-lnge="<?php echo $sellRow["maLnge"] ?>" data-lat="<?php echo $sellRow["maLat"];?>">距離: 100公尺</span>
                        </div>
                        <div class="map_serch_info_line" id="<?php echo $sellRow["maLnge"]."|".$sellRow["maLat"];?>">
                            <span>規劃路線
                                <i class="fas fa-location-arrow"></i>
                            </span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <?php
                }
            ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>


    <footer class="footer">
        <div id="floor">
            <img src="../images/nnnnn/floor.png" alt="floor">
            <p id="copy">Copyright©2019 Snack Master</p>
        </div>
    </footer> 

    <script src="../js/header.js"></script>

    
    <script>
     //ajax 左邊撈資料
    selectMenu = document.getElementsByClassName("maArea");
    searchIcon = document.getElementsByClassName("searchIcon");
    function searchUpdate(num){
        if(selectMenu[num].value != 0){
            var xhr = new XMLHttpRequest();
            xhr.onload = function(){
                if( xhr.status == 200){
                    document.getElementsByClassName("change_gsell")[0].innerHTML = xhr.responseText;
                    var searchLine = document.getElementsByClassName('map_serch_info_line');
                    //做終點經緯度的'字串分割'
                    for ( var p = 0; p < searchLine.length; p++ ) {
                        searchLine[p].addEventListener('click', function(e){
                            if(e.target.className.indexOf('line') != -1){
                                    var item = e.target;
                            }else if(e.target.className.indexOf('arrow') != -1){
                                    var item = e.target.parentNode.parentNode;
                            }else{
                                    var item = e.target.parentNode;
                            }
                            endLnge = item.id.split('|')[0];
                            endLat = item.id.split('|')[1];
                            initialize(); 
                            });
                    }
                    //distance
                    var distances = document.getElementsByClassName("distance");
                    for(var i=0; i<distances.length; i++){
                        var x = parseFloat(distances[i].dataset.lnge);
                        var y = parseFloat(distances[i].dataset.lat);
                        var a = Math.abs(x - 24.967768)*111;
                        var b = Math.abs(y - 121.191705)*111;
                        var cc = Math.pow(a,2) + Math.pow(b,2);
                        distances[i].innerText = "距離：" + Math.sqrt(cc).toFixed(3) + "公里";
                    }
                }else{
                    alert( xhr.status );
                }
            }
                
            var url = "getPosition.php?maArea=" + selectMenu[num].value;
            
            xhr.open("Get", url, true);
            xhr.send( null );
                
            }    
    }

    //map js 地標
        //hate
        // var hate = ['24.993088,121.301048', '24.994471,121.302025', '24.988993,121.313644'];
        
        //power
        // var power = ['24.967854,121.191704', '24.959982,121.215134', '24.990711,121.232857','24.962435,121.223572'];

        //eight
        // var eight = ['24.958616,121.298447', '24.964466,121.299294'];

        //mountain
        // var mountain = ['25.003271,121.287598'];

        //river
        // var river = ['24.885115,121.287598'];

        //hori
        // var hori = ['24.912287,121.206841'];


    //用php 生成 js 地標 
    <?php
        // 桃園區
        $sql = "select maLnge, maLat from masell where maArea = '桃園區'";
        $hate = $pdo -> query($sql);
        $hateStr = "[";
        while( $hateRow = $hate -> fetch() ){
            $hateStr .= "'{$hateRow["maLnge"]}, {$hateRow["maLat"]}',";
        };
        $hateStr .= "];";
        echo "var hate = $hateStr";

        // 中壢區
        $sql = "select maLnge, maLat from masell where maArea = '中壢區'";
        $power = $pdo -> query($sql);
        $powerStr = "[";
        while( $powerRow = $power -> fetch() ){
            $powerStr .= "'{$powerRow["maLnge"]}, {$powerRow["maLat"]}',";
        };
        $powerStr .= "];";
        echo "var power = $powerStr";


        // 八德區
        $sql = "select maLnge, maLat from masell where maArea = '八德區'";
        $eight = $pdo -> query($sql);
        $eightStr = "[";
        while( $eightRow = $eight -> fetch() ){
            $eightStr .= "'{$eightRow["maLnge"]}, {$eightRow["maLat"]}',";
        };
        $eightStr .= "];";
        echo "var eight = $eightStr";

        //龜山區 mountain
        $sql = "select maLnge, maLat from masell where maArea = '龜山區'";
        $mountain = $pdo -> query($sql);
        $mountainStr = "[";
        while( $mountainRow = $mountain -> fetch() ){
            $mountainStr .= "'{$mountainRow["maLnge"]}, {$mountainRow["maLat"]}',";
        };
        $mountainStr .= "];";
        echo "var mountain = $mountainStr";

        // 大溪區
        $sql = "select maLnge, maLat from masell where maArea = '大溪區'";
        $river = $pdo -> query($sql);
        $riverStr = "[";
        while( $riverRow = $river -> fetch() ){
            $riverStr .= "'{$riverRow["maLnge"]}, {$riverRow["maLat"]}',";
        };
        $riverStr .= "];";
        echo "var river = $riverStr";

        // 平鎮區
        $sql = "select maLnge, maLat from masell where maArea = '平鎮區'";
        $hori = $pdo -> query($sql);
        $horiStr = "[";
        while( $horiRow = $hori -> fetch() ){
            $horiStr .= "'{$horiRow["maLnge"]}, {$horiRow["maLat"]}',";
        };
        $horiStr .= "];";
        echo "var hori = $horiStr";
    ?>


   

    


    //限制地圖區域
    // function doFirst(){
    //     navigator.geolocation.getCurrentPosition(succCallback);
    // }

    function succCallback(arg){
        var lati = 24.967768;
        // var lati = 23.853344;
        var longi = 121.191705;
        // var longi = 120.951841;

        var taiwan = {
            north: 25.46,
            south: 21.09,
            west: 118.20,
            east: 122.70,
        };

        var xy = new google.maps.LatLng(lati, longi);
        // var mapBoard = document.getElementById('mapBoard');
        var options = {
            zoom: 10,//設定遠近
            center: xy,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            restriction: {
                latLngBounds: taiwan,
                strictBounds: false,
            },
        };
            
        map = new google.maps.Map(map, options);
            
        var marker = new google.maps.Marker({ 
            position: xy, 
            map: map
        });
        marker.setTitle('目前位置'); 

         //distance
        var distances = document.getElementsByClassName("distance");
        for(var i=0; i<distances.length; i++){
            var x = parseFloat(distances[i].dataset.lnge);
            var y = parseFloat(distances[i].dataset.lat);
            var a = Math.abs(x - 24.967768)*111;
            var b = Math.abs(y - 121.191705)*111;
            var cc = Math.pow(a,2) + Math.pow(b,2);
            distances[i].innerText = "距離：" + Math.sqrt(cc).toFixed(3) + "公里";
        }
    }

    // marker 地標
    function showInfo(num){
        var value = selectMenu[num].value;
        switch(value){
            case '桃園區':
                getLocation(hate, '桃園區');
                break; 
            case '中壢區':
                getLocation(power, '中壢區');
                break ; 
            case '八德區':
                getLocation(eight, '八德區');
                break ;
            case '龜山區':
                getLocation(mountain, '龜山區');
                break ;
            case '大溪區':
                getLocation(river, '大溪區');
                break ;
            case '平鎮區':
                getLocation(hori, '平鎮區');
                break ;
            }
        }


    var markers = new Array(); 
    function getLocation(as,title){
        var i = 0;
        for(var k in markers){
            markers[k].setVisible(false);
        }
        for(var k in as){
            var lati = as[k].split(',')[0]; 
            var longi = as[k].split(',')[1]; 
            var xy = new google.maps.LatLng(lati, longi);
            //加 icon
            var image = '../images/nnnnn/masell.png';
            var marker = new google.maps.Marker({ 
                position: xy, 
                map: map,
                icon: image
            });
            marker.setTitle(title); 
            markers[i]  = marker;i++ ;           
        }           
    }

        

        
        
    //做點擊事件
    searchIcon[0].addEventListener('click', function(){
        searchUpdate(0);
    });
    searchIcon[1].addEventListener('click', function(){
        searchUpdate(1);
    });
    searchIcon[0].addEventListener('click', function(){
        showInfo(0);
    });
    searchIcon[1].addEventListener('click', function(){
        showInfo(1);
    });
        

    

    
    

    //規劃路線
    function initialize() {
        var markerArray = [];
        // 實例化路線服務
        var directionsService = new google.maps.DirectionsService;

        var map = new google.maps.Map(document.getElementById('map'), {
        //   zoom: 12,
        //   center: {lat: 24.967768, lng: 121.191705}
        center: {lat: 23.853344, lng: 120.951841}
        });

        // 為路線創建渲染器並將其綁定到地
        var directionsDisplay = new google.maps.DirectionsRenderer({map: map});

        // 實例化信息窗口以保存步驟文
        var stepDisplay = new google.maps.InfoWindow;

         // 顯示初始開始和結束選擇之間的路徑
         calculateAndDisplayRoute(
            directionsDisplay, directionsService, markerArray, stepDisplay, map);


        // 從開始和結束列表中收聽更改事件
        var onClickSearch = function() {
            calculateAndDisplayRoute(
              directionsDisplay, directionsService, markerArray, stepDisplay, map);
        };
        
        var searchLine = document.getElementsByClassName('map_serch_info_line');
        for ( var p = 0; p < searchLine.length; p++ ) {
            searchLine[p].addEventListener('click', onClickSearch);
        }
    }

    
    //抓點擊到的物件
    var searchLine = document.getElementsByClassName('map_serch_info_line');
    for ( var p = 0; p < searchLine.length; p++ ) {
        searchLine[p].addEventListener('click', function(e){
            if(e.target.className.indexOf('line') != -1){
                var item = e.target;
            }else if(e.target.className.indexOf('arrow') != -1){
                var item = e.target.parentNode.parentNode;
            }else{
                var item = e.target.parentNode;
            }
            endLnge = item.id.split('|')[0];
            endLat = item.id.split('|')[1];
            initialize(); //有用到就要呼叫
        });
    }


    //首先，從地圖中刪除任何現有標記
    function calculateAndDisplayRoute(directionsDisplay, directionsService,markerArray, stepDisplay, map) {
        for (var i = 0; i < markerArray.length; i++) {
            markerArray[i].setMap(null);
        }

        // 檢索開始和結束位置並使用創建
        directionsService.route({
            origin: {lat: 24.9650192, lng: 121.1909533},
            destination: endLnge+','+endLat,
            travelMode: 'DRIVING'
            },  function(response, status){
                //路線指示並將響應傳遞給要創建的功能
                //每個步驟的標記
                if (status === 'OK') {
                    // 回傳路線上每個步驟的細節
                    console.log(response.routes[0]);
                    directionsDisplay.setDirections(response);
                    showSteps(response, markerArray, stepDisplay, map);
                } else {
                    window.alert('Directions request failed due to ' + status);
                } 
        });
    }

    
        
    function showSteps(directionResult, markerArray, stepDisplay, map) {
        // 對於每個步驟，放置一個標記，然後將文本添加到標記的infowindow
        // 當計算新路線時，還要將標記附加到陣列，以便我們可以跟踪它並將其刪除
        var myRoute = directionResult.routes[0].legs[0];
        for (var i = 0; i < myRoute.steps.length; i++) {
          var marker = markerArray[i] = markerArray[i] || new google.maps.Marker;
          marker.setMap(map);
          marker.setPosition(myRoute.steps[i].start_location);
          attachInstructionText(
              stepDisplay, marker, myRoute.steps[i].instructions, map);
        }
    }

    function attachInstructionText(stepDisplay, marker, text, map) {
        google.maps.event.addListener(marker, 'click', function(){
          // 單擊標記時打開信息窗口，其中包含文本步驟
          stepDisplay.setContent(text);
          stepDisplay.open(map, marker);
        });
    }
    

    window.addEventListener('load', succCallback, false);
    
    </script>

</body>

</html>