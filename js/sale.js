var slideIndex = 1;
showSlides(slideIndex);
function showSlides(n) {
    var i;
    var test = document.getElementsByClassName('item');
    console.log(test);
    console.log(test[0]);
    console.log(test.length);
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
    //取得活動結束的時間(第一次專題先寫死而不是從資料庫撈資料)
    var end = new Date(2019, 1, 16);
    //算出目前時間到結束時間中間有多少秒            
    var leftTime = end.getTime() - now.getTime();

    //依序將毫秒轉換成幾天幾時幾分幾秒
    var leftSecond = parseInt(leftTime / 1000);
    var hour = Math.floor(leftSecond / 3600);
    var minute = Math.floor((leftSecond - hour * 3600) / 60);
    var second = Math.floor(leftSecond - hour * 3600 - minute * 60);
    document.getElementById('hour').innerText = hour + '時 : ';
    document.getElementById('minute').innerText = minute + '分 : ';
    document.getElementById('second').innerText = second + '秒';
}
function sale() {
    //先呼叫一次呈現倒數的函數，不然一進畫面會是空白
    countdown();
    //設定計時器讓倒數函式countdown每秒被呼叫一次
    setInterval(countdown, 1000);
    document.getElementById('close').addEventListener('click', function (){
        document.getElementById('sale').style.display = 'none';
    });
}
window.addEventListener('load', sale);
