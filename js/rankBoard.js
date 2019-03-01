function moveR() {
        $('.itemDetail').css({
            'opacity': '0',
            'transform': 'translateX(-100%)'
        })
        setTimeout(() => {
            $('.itemDetail').css({
                'opacity': '1',
                'transform': 'translateX(0%)'
            })
        }, 500);
}

function getRank(rankGenre){
    var xhr =new XMLHttpRequest();
    xhr.open("Post", "getRankBoard.php", true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    var data_info=`rankGenre=${rankGenre}`;
    xhr.send(data_info);
    xhr.onload=function(){

        //將回傳的snackNo塞入六名轉盤
        var rsp=JSON.parse(xhr.responseText);
        for(i=1;i<7;i++){
            $(`#sw_${i}`).attr('snackNo',rsp[i-1].snackNo);
            $(`.m_rk:eq(${i-1})`).attr('snackNo',rsp[i-1].snackNo);

        }

        //並且載入第一名detail
        setTimeout(() => getSnack(rsp[0].snackNo) , 300);
    }
}

function getSnack(snackNo){

    var xhr =new XMLHttpRequest();
    xhr.open("Post", "getSnack.php", true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    var data_info=`snackNo=${snackNo}`;
    xhr.send(data_info);
    xhr.onload=function(){
        var rsp=JSON.parse(xhr.responseText);

        $('#item').attr('snackNo',rsp.snackNo);
        $('#itemImg').attr('src',rsp.snackPic);
        $('#nationName').html(`<p>[${rsp.nation}]</p>${rsp.snackName}`);
        $('#rankWrap').html(rsp.rankHtml);
        $('#price').text(`$ ${rsp.snackPrice}`);
        $('.cart').attr('id',`${rsp.snackNo}|${rsp.snackPrice}|0`);
        $('.heart').attr('id',rsp.snackNo);
        $('#snackLink').attr('href',`../page/showItem.php?snackNo=${rsp.snackNo}`);
        $('#evaTimes').text(`共${rsp.Etimes}次評價`);
        $('#scoAvg').html(`${rsp.avgG}<span class="total">/5</span>`);
        $('#detailAvgG').attr('grad',rsp.avgG);
        $('.radar').attr({
            's':rsp.avgS,
            't':rsp.avgT,
            'h':rsp.avgH,
           
        })
        firstGet();
        createRadar();
    };

}

function isMobile() {

    var xWidth = $('#rankPanel').css('width');
    if( xWidth == "0px"){
        return true;
    }else{
        return false;
    }
}

function allPanel(){
        $('.sw_class').click(function(e){
            e.preventDefault();
            moveR();
            $('.sw_class').removeClass('catLoc');
            $('.sw_rk').removeClass('catLoc');
            $('#m_rk1').addClass('catLoc');
            $('#sw_1').addClass('catLoc');
            $(this).addClass('catLoc');
            $('.itemDetail').scrollTop(0);

            if (isMobile()==false){

            
                $('#titleCat').css({
                    'opacity': '0',
                    'transform': 'translateX(-100%)'
                })
                
                switch ($(this).attr('id')) {
                    case 'sw_all':
                        newTitleCtx = "本月<br>綜合排行";
                        newIp = "../images/rankBoard/ipAll.png";
                        break;

                    case 'sw_cookie':
                        newTitleCtx = "本月<br>餅乾排行";
                        newIp = "../images/rankBoard/ipCookie.png";
                        break;

                    case 'sw_candy':
                        newTitleCtx = "本月<br>糖果排行";
                        newIp = "../images/rankBoard/ipCandy.png";
                        break;

                    case 'sw_choco':
                        newTitleCtx = "本月<br>巧克力排行";
                        newIp = "../images/rankBoard/ipChoco.png";
                        break;

                    case 'sw_chip':
                        newTitleCtx = "本月<br>洋芋片排行";
                        newIp = "../images/rankBoard/ipChips.png";
                        break;
                }



                $('#sw_ring').css('transform', 'translateY(-50%) rotate(0deg)');
                $('#rankPanel').css({
                    'opacity': '0',
                    'transform': 'scale(0)'
                }) ;
                setTimeout(() => {
                    $('#rankPanel').css({
                        'opacity': '1',
                        'transform': 'scale(1)'
                    });
                    $('#titleCatCtx').html(newTitleCtx);
                    $('#ipImg').attr('src',newIp);
                }, 400);
                
                setTimeout(() => {
                    $('#titleCat').css({
                        'opacity': '1',
                        'transform': 'translateX(0%)'
                    })
                }, 400);

            }
            var rankGenre =$(this).attr('gNum');
            getRank(rankGenre);
        });
}



function ringPanel() {
        
        $('.sw_rk').click(function (e) {
            e.preventDefault();
            moveR();
            $('.sw_rk').removeClass('catLoc');
            $(this).addClass('catLoc');
            $('.itemDetail').scrollTop(0);
            
            switch ($(this).attr('id')) {
                case 'sw_1':
                    $('#sw_ring').css('transform', 'translateY(-50%) rotate(0deg)');
                break;

                case 'sw_2':
                    $('#sw_ring').css('transform', 'translateY(-50%) rotate(60deg)');
                break;

                case 'sw_3':
                    $('#sw_ring').css('transform', 'translateY(-50%) rotate(120deg)');
                break;

                case 'sw_4':
                    $('#sw_ring').css('transform', 'translateY(-50%) rotate(180deg)');
                break;

                case 'sw_5':
                    $('#sw_ring').css('transform', 'translateY(-50%) rotate(240deg)');
                break;

                case 'sw_6':
                    $('#sw_ring').css('transform', 'translateY(-50%) rotate(300deg)');
                break;

                default:
                break;
            }
            var snackNo=$(this).attr('snackNo');
            setTimeout(() => getSnack(snackNo) , 300);
           ;
        })
    
}

function createRadar() {
    var ctx = document.getElementsByClassName("radarCanvas")[0].getContext('2d');
    Chart.defaults.global.legend.display = false;
    Chart.defaults.global.tooltips = false;
    //改字體大小
    Chart.defaults.global.defaultFontSize = 20;
    //因為畫完一次圖表之後希望可以再變動，所以用變數代表每個項目的值
    
    good = $('#detailAvgG').attr('grad');
    sweet = $('.radar').attr('t');
    sour = $('.radar').attr('s');
    spicy = $('.radar').attr('h');
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
    ringPanel();
    allPanel();

    if(isMobile()){
        var newTitleCtx = "零食<br>排行榜";
        $('#titleCatCtx').html(newTitleCtx);

        document.body.addEventListener('touchmove', function() {
          
    
            var minT =  $(window).height()*15/100;
            var maxT =  $(window).height()*30/100;

            if($(window).scrollTop()>=minT && $(window).scrollTop()<=maxT ){
                $('.itemDetail').css('overflowY','auto');
            }else{
                $('.itemDetail').css('overflowY','hidden');
            }

            }, true); 
        
    }else{
        $('.itemDetail').css('overflowY','auto');
    }

    
}

window.addEventListener('load',init,false);