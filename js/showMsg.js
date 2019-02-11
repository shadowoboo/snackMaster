
function init() {
    $('.btnMsg').click(function(e) {
        if($(this).text()=='顯示留言'){
            $(this).html('<i class="fas fa-comment"></i>隱藏留言');
        }else{
            $(this).html('<i class="fas fa-comment"></i>顯示留言');
        };
        $(this).parent().next().next().toggleClass('msgsShow');
    });
}

window.addEventListener('load',init,false);