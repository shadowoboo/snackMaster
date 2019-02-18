var slideIndex = 1;
function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName('item');
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex - 1].style.display = "block";
}
function plusSlides(n) {
    showSlides(slideIndex += n);
}
function currentSlide(n) {
    showSlides(slideIndex = n);
}
function countdown() {
    //取得現在的時間
    var now = new Date();
    // console.log(now);
    //取得活動結束的時間(第一次專題先寫死而不是從資料庫撈資料)
    var oneDay = now.getDate() + 1;
    var end = new Date(2019, 1, oneDay);
    // console.log(end);
    //算出目前時間到結束時間中間有多少秒            
    var leftTime = end.getTime() - now.getTime();  //1552752000-1550378890=2372984
    // console.log(leftTime); 

    //依序將毫秒轉換成幾天幾時幾分幾秒
    var leftSecond = parseInt(leftTime / 1000); //毫秒-秒
    var hour = Math.floor(leftSecond / 3600); //
    // console.log(hour);
    var minute = Math.floor((leftSecond - hour * 3600) / 60);
    var second = Math.floor(leftSecond - hour * 3600 - minute * 60);
    document.getElementById('hour').innerText = hour + '時 : ';
    document.getElementById('minute').innerText = minute + '分 : ';
    document.getElementById('second').innerText = second + '秒';
}
function test(){
    console.log('here');
}
function sale() {
    //先呼叫一次呈現倒數的函數，不然一進畫面會是空白
    countdown();
    //設定計時器讓倒數函式countdown每秒被呼叫一次
    setInterval(countdown, 1000);
    document.getElementById('close').addEventListener('click', test);
    document.getElementById('closeSale').addEventListener('click', function (){
        document.getElementById('sale').style.display = 'none';
    });
    window.addEventListener('resize', function (){
        if (window.screen.width < 768){
            showSlides(slideIndex);
        }else{
            var slides = document.getElementsByClassName('item');
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "block";
            }
        }
    });
    if (window.screen.width < 768) {
        showSlides(slideIndex);
    };
}
window.addEventListener('load', sale);