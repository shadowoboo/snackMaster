function createRadar() {
    var ctx = document.getElementById("radarCanvas").getContext('2d');
    // console.log(ctx);
    Chart.defaults.global.legend.display = false;
    Chart.defaults.global.tooltips = false;
    //改字體大小
    // Chart.defaults.global.defaultFontSize = '12';
    //因為畫完一次圖表之後希望可以再變動，所以用變數代表每個項目的值
    radarOptions =
        {
            scale:
            {
                ticks:
                {
                    fontSize: 0,
                    beginAtZero: true,
                    maxTicksLimit: 7,
                    min: 0,
                    max: 5
                },
                pointLabels:
                {
                    //label字體大小
                    fontSize: 14,
                    color: '#0044BB'
                },
                gridLines:
                {
                    // color: '#009FCC'
                }
            },
            maintainAspectRatio: false
        };
    radarCanvas = new Chart(ctx, {
        type: 'radar',
        data: {
            //項目標籤的文字
            labels: ["好評度", "酸", "甜", "辣"],
            datasets: [{
                // label: '# of Votes',
                data: [0, 0, 0, 0],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                ],
                borderWidth: 1,
                //端點的大小
                pointRadius: 1,
            }]
        },
        options: radarOptions
    });
}
//取得新的值並依此更新雷達圖
function showRadar(e){
    var id = e.target.id;
    var kindArr = id.split('|');
    var good = kindArr[0];
    var sour = kindArr[2];
    var sweet = kindArr[1];
    var spicy = kindArr[3];
    //重新把口味變數設定給雷達圖
    radarCanvas.data.datasets[0].data = [good, sour, sweet, spicy];
    //更新雷達圖
    radarCanvas.update();

    var msg = document.getElementById('msg');
    msg.innerText = '';
    document.getElementById('goodTitle').innerText = '好評度';
    document.getElementById('mintStar').innerText = good;
    document.getElementById('mintFive').innerText = '/5';
    var newImg = document.createElement('img');
    newImg.className = 'star';
    newImg.src = '../images/blair/star.png';
    newImg.id = 'mintImg';
    document.getElementsByClassName('info')[0].insertBefore(newImg, msg);
}
function cancelRadar(){
    radarCanvas.data.datasets[0].data = [0, 0, 0, 0];
    radarCanvas.update();
    document.getElementsByClassName('info')[0].removeChild(document.getElementById('mintImg'));
    document.getElementById('goodTitle').innerText = '';
    document.getElementById('mintStar').innerText = '';
    document.getElementById('mintFive').innerText = '';
    document.getElementById('msg').innerText = '我可以告訴你商品的評價星等喔!';
}
function search(){
    var country = document.getElementById('countryBar').value;
    var kind = document.getElementById('kindBar').value;
    var flavor = document.getElementById('flavorBar').value;
    var name = document.getElementById('searchName').value;
    if( country != 0 ){
        country = "'" + country + "'";
    }
    if( kind != 0 ){
        kind = "'" + kind + "'";
    }
    console.log(country);
    console.log(kind);
    console.log(flavor);
    console.log(name);
    if( flavor == 0){
        var search = "and nation = " + country + " and snackGenre = " + kind + " and snackName like '%" + name + "%'";
    }else{
        var search = "and nation = " + country + " and snackGenre = " + kind + " and " + flavor + "Stars > 0" + " and snackName like '%" + name + "%'";
    }
    console.log(search);

    // var search = "and nation = " + country + " and snackGenre = " + kind + " and " + flavor + "Stars > 0 and snackName like %" + name + "%";
    // and nation = 泰國 and snackGenre = 巧克力 and sweetStars > 0 and snackName like %巧% 
    
    location.href = 'shopping.php?search=' + search;

    // var xhr = new XMLHttpRequest();
    // xhr.onload = function () {
    //     if (xhr.status == 200) {
    //         //modify here
    //         document.getElementById("showPanel").innerHTML = xhr.responseText;
    //     } else {
    //         alert(xhr.status);
    //     }
    // }

    // var url = 'search.php?search=' + search;
    // xhr.open('get', url, true);
    // xhr.send(null);

}
window.addEventListener('load', function (){
    createRadar();
    var items = document.getElementsByClassName('item');
    for(var i = 0; i < items.length; i++){
        items[i].addEventListener('mouseenter', showRadar);
        items[i].addEventListener('mouseleave', cancelRadar);
    }
    document.getElementById('searchClick').addEventListener('click', search);
});