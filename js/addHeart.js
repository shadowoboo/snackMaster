function addHeart(e){
    if( e.target.className.indexOf('fa') == -1 ){
        var snackNo = e.target.id;        
    }else{
        var snackNo = e.target.parentNode.id;        
    }
    console.log(snackNo);
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