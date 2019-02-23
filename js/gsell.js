
// Initialize and add the map初始化並添加地圖
function initMap() {
    // 位置
    // var uluru = {lat: 24.9650192, lng: 121.1909533};
    var uluru = {lat: 23.853344, lng: 120.951841}
    var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 4, center: uluru});
    var marker = new google.maps.Marker({position: uluru, map: map});
}
