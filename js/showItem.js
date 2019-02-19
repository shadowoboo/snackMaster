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
createRadar();

}

window.addEventListener('load',init,false);