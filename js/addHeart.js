function addHeart(e){
    if (document.getElementById("btnloglout").innerHTML == "&nbsp"){
        alert('請先登入會員唷～');
        return;
    }else{
        if (e.target.className.indexOf('fa') == -1) {
            var snackNo = e.target.id;
        } else {
            e.stopPropagation();
            var snackNo = e.target.parentNode.id;
        }
        e.target.style.color = 'rgb(234, 90, 90)';
        var xhr = new XMLHttpRequest();
        xhr.onload = function () {
            if (xhr.status == 200) {
                alert('已將零食加入收藏～');
            } else {
                alert(xhr.status);
            }
        }

        var url = 'addHeart.php?snackNo=' + snackNo;
        xhr.open('get', url, true);
        xhr.send(null);   
    }
}
window.addEventListener('load', function (){
    var hearts = document.getElementsByClassName('heart');
    var length = hearts.length;
    for(var i = 0; i < length; i++){
        hearts[i].addEventListener('click', addHeart);
    }
    var heartIcons = document.getElementsByClassName('fa-heart');
    var length2 = heartIcons.length;
    for (var j = 0; j < length; j++) {
        heartIcons[j].addEventListener('click', addHeart);
    }
})