function showStar(){

$('.star').each(function(){
    var avgG = $(this).attr('grad');
    var gap = avgG>Math.floor(avgG)?Math.floor(avgG):Math.floor(avgG)-1;
    var starLength= avgG*11+gap*5+13;
    $(this).css('background',`linear-gradient(to right, rgb(233, 125, 88) ${starLength}%, rgb(255, 255, 255)10%)`)
})

}
window.onload=showStar;
{/*
    
你的網頁結構會長這樣: 透過改變父層的漸層長度表達星星
1.父層記得給class star 
2.自定義標籤屬性 grad 
3.將商品好評度寫進去
4.這個function會自動完成一切 好方便喔

<div class="star" grad="<?php echo $avgG ?>"> <<<把撈到的商品好評平均 放入自訂標籤屬性給JS抓取
    <img src="../images/rankBoard/starMask.png" alt="星等"> <前面那張遮罩圖片
</div> 



*/}