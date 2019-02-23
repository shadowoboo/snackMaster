function upgrade(){
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            alert('會員等級已經提升～升等獎勵已送至優惠券匣');

            document.getElementById('gradeName').innerText = xhr.responseText.split('|')[0];
            document.getElementById('headPic').src = xhr.responseText.split('|')[1];
            document.getElementsByClassName('goToCustom')[0].style.cursor = "no-drop";
            document.getElementsByClassName('goToCustom')[0].setAttribute("disabled", "true");;
        } else {
            alert(xhr.status)
        }
    }
    xhr.open("Get", "upgrade.php", true);
    xhr.send(null);
}
window.addEventListener('load', function (){
    document.getElementsByClassName('goToCustom')[0].addEventListener('click', upgrade);
    var width = document.getElementsByClassName('colorBar')[0].offsetWidth;
    var pxPerPt = width / 18000;
    var point = document.getElementById('memPoint').innerText;
    var barWidth = point * pxPerPt;
    document.getElementsByClassName('nowPro')[0].style.width = barWidth + 'px';
});
