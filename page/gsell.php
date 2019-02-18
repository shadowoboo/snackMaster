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
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="../css/nnnnn.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/gsell.css" />
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/search.js"></script>


</head>

<body>

<!-- if錯誤訊息 -->
    <?php
        if( $errMsg != ""){
            exit("<div><center>$errMsg</center></div>");
        }
    ?>
<!-- header -->
    <header>
        <h1>大零食家</h1>
        <div class="cloud">
            <div class="doc doc--bg2">
                <canvas id="canvas"></canvas>
            </div>
            <nav>
                <label for="smlSearch" class="searchBtn" value="search">
                    <img src="../images/tina/search-icon.svg" alt="search" id="searchBtn">
                </label>
                
                <div class="menu">
                    <!-------- -----手機漢堡----------- -->

                    <div id="ham">
                        <span class="btnTop"></span>
                        <span class="btnMid"></span>
                        <span class="btnBot"></span>
                    </div>
                    <!----    在手機上打開此logo;桌機上關掉此logo------ -->
                    <div class="logo">
                        <a href="index.html"><img src="../images/tina/LOGO2.png" alt="大零食家"></a>

                    </div>
                    <div id="list_appear">
                        <!-- ----------手機選單離開-------- -->
                        <div id="cros">
                            <span class="leave">X</span>
                        </div>
                        <ul class="list">
                            <li><a href="rankBoard.html">零食排行榜</a></li>
                            <li><a href="customized.html">客製零食箱</a> </li>
                            <!-- 在手機上要關掉這個li的logo -->
                            <li><a href="index.html"><img src="../images/tina/LOGO1.png" alt="大零食家"></a></li>
                            <li id="store"> <a href="shopping.html">零食商店街</a>
                                <ul id="Submenu" class="subMenu">
                                    <li><a href="showItem.html">零食單品</a></li>
                                    <li id="snBox"><a href="preOrder.html">預購零食箱</a></li>
                                </ul>
                            </li>
                            <li><a href="gsell.html">尋找販賣機</a> </li>
                        </ul>
                    </div>
                </div>

                <ul class="login">
                    <li><i class="fas fa-shopping-cart"></i></li>
                    <li><i class="fas fa-user-circle"></i></li>
                </ul>
            </nav>
        </div>
        <div class="seachRegion" id="search_appear">
                <div class="search">
                    <img src="../images/blair/pocky.png" alt="">
                    <div class="selectbar">
                        <select name="country" id="country">
                            <option value="0">國家</option>
                            <option value='巴西'>巴西</option>
                            <option value="日本">日本</option>
                            <option value="美國">美國</option>
                            <option value="英國">英國</option>
                            <option value="埃及">埃及</option>
                            <option value="德國">德國</option>
                            <option value="澳洲">澳洲</option>
                            <option value="韓國">韓國</option>
                        </select>
                        <select name="kind" id="kind">
                            <option value="0">種類</option>
                            <option value="巧克力">巧克力</option>
                            <option value="糖果">糖果</option>
                            <option value="餅乾">餅乾</option>
                            <option value="洋芋片">洋芋片</option>
                        </select>
                        <select name="flavor" id="flavor">
                            <option value="0">口味</option>
                            <option value="sour">酸</option>
                            <option value="sweet">甜</option>
                            <option value="spicy">辣</option>
                        </select>                        
                    </div>
                    <div class="inputbar">
                        <input type="text"  id="searchName" placeholder="想找什麼零食呢？">
                        <i class="fas fa-search"  id="searchClick"></i>
                    </div>
                </div>
                    <div id="close">
                        <span class="close"><i class="fas fa-times"></i></span>
                    </div>
        </div>
    </header>


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
                    <option value="All">All</option>
                    <option value="桃園區">桃園區</option>
                    <option value="中壢區">中壢區</option>
                    <option value="八德區">八德區</option>
                    <option value="龜山區">龜山區 </option>
                    <option value="大溪區">大溪區 </option>
                    <option value="平鎮區">平鎮區 </option>
                </select> 
            </form>
            <!-- <a href="#" class="search_search" id="searchIcon"> -->
                <i class="fas fa-search search_search searchIcon"></i>
            <!-- </a> -->
        </div>
    </div>


    <!-- 整個google_search -->
    <div class="google_search">
        <!-- map api -->
        <div id="mapSearch">
            <div id="map"></div>
            <script src="../js/gsell.js"></script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxP0uxcl_z9Y2bY7OkrWZg5TRhtkANEog&callback=initMap">
            </script>        
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
                        <option value="All">All</option>
                        <option value="桃園區">桃園區</option>
                        <option value="中壢區">中壢區</option>
                        <option value="八德區">八德區</option>
                        <option value="龜山區">龜山區 </option>
                        <option value="大溪區">大溪區 </option>
                        <option value="平鎮區">平鎮區 </option>
                    </select> 
                </form>
                <!-- <a href="#" class="search_search_desk searchIcon"> -->
                <i class="fas fa-search search_search_desk searchIcon"></i>
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
                            <span>距離: 100公尺</span>
                        </div>
                        <div class="map_serch_info_line">
                            <a href="#">
                                <span>規劃路線
                                    <i class="fas fa-location-arrow"></i></span>
                            </a>
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
        function test(num){
            var xhr = new XMLHttpRequest();
            xhr.onload = function(){
                // console.log(`xhr.status: ${xhr.status}`);

                // console.log(`xhr.responseText: ${xhr.responseText}`);
                if( xhr.status == 200){
                    document.getElementsByClassName("change_gsell")[0].innerHTML = xhr.responseText;
                }else{
                    alert( xhr.status );
                }
            }
            var url = "getPosition.php?maArea=" + selectMenu[num].value;
            // console.log(selectMenu.value);
            
            xhr.open("Get", url, true);
            xhr.send( null );
            // console.log(xhr.status);
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
        function doFirst(){
            navigator.geolocation.getCurrentPosition(succCallback);
        }
        function succCallback(arg){
                
            var lati = 24.967768;
            var longi = 121.191705;

            var taiwan = {
                north: 25.46,
                south: 21.09,
                west: 118.20,
                east: 122.70,
                };

            var xy = new google.maps.LatLng(lati, longi);
            var mapBoard = document.getElementById('mapBoard');
            var options = {
                zoom: 10,
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
                var marker = new google.maps.Marker({ 
                    position: xy, 
                    map: map 
                });
                marker.setTitle(title); 
                markers[i]  = marker;i++ ;           
            }           
        }
        
    //做點擊事件
        searchIcon[0].addEventListener('click', function(){
            test(0);
        });
        searchIcon[1].addEventListener('click', function(){
            test(1);
        });
        searchIcon[0].addEventListener('click', function(){
            showInfo(0);
        });
        searchIcon[1].addEventListener('click', function(){
            showInfo(1);
        });
        

    

    window.addEventListener('load', doFirst, false);
    


    </script>

</body>

</html>