function toRad(d) {return d*Math.PI/180; }

function getDisance(lat1,lng1,lat2,lng2) { //lat为纬度, lng为经度, 一定不要弄错

    var dis=0;
    var radLat1 = toRad(lat1);
    var radLat2 = toRad(lat2);
    var deltaLat=radLat1-radLat2;
    var deltaLng=toRad(lng1)-toRad(lng2);
    var dis = 2 * Math.asin(Math.sqrt(Math.pow(Math.sin(deltaLat / 2), 2) + Math.cos(radLat1) * Math.cos(radLat2) * Math.pow(Math.sin(deltaLng / 2), 2)));
    return dis * 6378137;
}



function getAllg(lat1,lng1){
    gD=[];
    var xhr =new XMLHttpRequest();
    xhr.open("Get", "getAllg.php", true);
    xhr.send(null);
    
    xhr.onload=function(){
        rsp= JSON.parse(xhr.responseText);

        if(showMap==1){

            for (var i= 0; rsp.length >i ; i++) {
                gD.push(getDisance(lat1,lng1,rsp[i].lat,rsp[i].lng))
            }
            nearestGi=gD.indexOf(Math.min(...gD));
            cx=rsp[nearestGi].lat;
            cy=rsp[nearestGi].lng;
        
        }else{
            cx=rsp[3].lat;
            cy=rsp[3].lng;

        }
          creatMap(lat1,lng1,cx,cy,rsp);
    };
   
}



function creatMap(la1,lng1,cx,cy){
    //開始創造地圖
    
    var taiwan = {
        north: 25.46,
        south: 21.09,
        west: 118.20,
        east: 122.70,
        };
        
    var xy = new google.maps.LatLng(la1,lng1);
    var nearG=new google.maps.LatLng(cx,cy);
    var options = {
        zoom: 12,
        center: nearG,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        restriction: {
            latLngBounds: taiwan,
            strictBounds: false,
        },
    };
    mapd=new google.maps.Map(showMapdiv,options);
    //放Marker
    if(showMap==1){
        var marker = new google.maps.Marker({
            position:xy,
            map:mapd,
            title:'您的位置',
        });
    }

    var image='../images/nnnnn/masell.png';
    for (var i= 0; rsp.length >i ; i++) {
        var marker = new google.maps.Marker({
            position:{lat:parseFloat(rsp[i].lat),lng:parseFloat(rsp[i].lng)},
            map:mapd,
            title:rsp[i].title,
            icon:image,
        });
      }

}


function showLoc(position){ //抓使用者的位置
    lat1=position.coords.latitude;
    lng1=position.coords.longitude;
    getAllg( lat1,lng1);
}

function showErr(error){//使用者不同意開啟或是其他意外
    // console.log('錯誤代碼:'+error.code);
    lat1=24.967768;
    lng1=121.191705;
    getAllg( lat1,lng1);

    $('#map').html('<p id="errMsg">目前無法存取您的位置資訊</p>');
}

function yesOrNoMap(){
    console.log('要不要顯示地圖:'+showMap);
    showMapdiv=document.getElementById('map');
    if(showMap==1){
        //顯示最近的販賣機
        // $('#map').html('<p id="errMsg">目前無法存取您的位置資訊</p>');
        // navigator.geolocation.getCurrentPosition(showLoc,showErr); 
        showErr();
    }else{
        $('#map').html('<p id="errMsg">本商品目前未於販賣機販售</p>');
    }   

}


function createRadar() {
var ctx = document.getElementsByClassName("radarCanvas")[0].getContext('2d');
Chart.defaults.global.legend.display = false;
Chart.defaults.global.tooltips = false;
//改字體大小
Chart.defaults.global.defaultFontSize = 20;
//因為畫完一次圖表之後希望可以再變動，所以用變數代表每個項目的值


good = $('#avgG').attr('grad');
sweet = $('#avgT').text();
sour = $('#avgS').text();
spicy = $('#avgH').text();
radarOptions = {
    scale: {
        ticks: {
            fontSize: 0,
            beginAtZero: true,
            maxTicksLimit: 7,
            min: 0,
            max: 5
        },
        pointLabels: {
            fontSize: 12,
            color: '#076baf'
        },
        gridLines: {
            // color: '#009FCC'
        }
    },
    maintainAspectRatio: false
};
radarCanvas = new Chart(ctx, {
    type: 'radar',
    data: {
        //項目標籤的文字
        labels: ["好評度", "甜", "酸", "辣"],
        datasets: [{
            // label: '# of Votes',
            data: [good, sweet, sour, spicy],
            backgroundColor: [
                'rgba(233, 125, 88, 0.7)',
            ],
            borderColor: [
                'rgba(233,125,88,1)',
            ],
            borderWidth: 2,
            //端點的大小
            pointRadius: 0,
        }]
    },
    options: radarOptions
});
}

function init(){
showMap=$('#map').attr('show');

nearGx=0;
nearGy=0;
createRadar();
yesOrNoMap();


}

window.addEventListener('load',init,false);