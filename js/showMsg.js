// $('.btnMsg').click(function(e) {
//         if($(this).text()=='顯示留言'){
//             $(this).html('<i class="fas fa-comment"></i>隱藏留言');
//         }else{
//             $(this).html('<i class="fas fa-comment"></i>顯示留言');
//         };

//         var thisBox='msgBox'+snackNo;
//         $('.'+thisBox).css('height','200px');
//     });

function msgBtnAdd(){
    $('.btnMsg').click(function(e) {
        var evaNo=$(this).attr('evaNo');

        if($(this).text()=='顯示留言'){
            $(this).html('<i class="fas fa-comment"></i>隱藏留言');


            var xhr =new XMLHttpRequest();
            xhr.open("Post", "getMsg.php", true);
            xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            var data_info=`evaNo=${evaNo}`;
            xhr.send(data_info);
            xhr.onload=function(){
                var msgArr=JSON.parse(xhr.responseText);

                if(msgArr==''){

                }else{
                  
                msgBoxHTML='';

                    for(i=0;i<msgArr.length;i++){
                        msgBoxHTML+=
                        `<div class="msg_num">
                            <div class="memPic">
                                <img src="${msgArr[i].memPic}" alt="會員頭像" class="memImg">
                            </div>
                            <div class="msgCol">
                                <div class="memId">
                                    <p>${msgArr[i].memId}</p><button class="report">...</button>
                                </div>
                                <p class="msgCtx">${msgArr[i].msgText}!</p>
                            </div>
                        </div>`
                    }

                };
                $('#msgBox'+evaNo).css('height','auto').html(msgBoxHTML);
            }

            
        }else{
            $(this).html('<i class="fas fa-comment"></i>顯示留言');
            $('#msgBox'+evaNo).css('height','0px');
        };

    });
}

function showStar(){

    $('.star').each(function(){
        var avgG = $(this).attr('grad');
        var gap = avgG>Math.floor(avgG)?Math.floor(avgG):Math.floor(avgG)-1;
        var starLength= avgG*11+gap*5+13;
        $(this).css('background',`linear-gradient(to right, rgb(233, 125, 88) ${starLength}%, rgb(255, 255, 255)10%)`);
        console.log($(this));
    })
}



function firstGet(){
    var xhr =new XMLHttpRequest();
    xhr.open("Post", "getCmt.php", true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    var data_info=`snackNo=${snackNo}`;
    xhr.send(data_info);
    xhr.onload=function(){
        var rsp=JSON.parse(xhr.responseText);
        // class rsp{
        //     public $pages;
        //     public $cmtArr=[];
        // }

        // setPagination(rsp.pages);
        $('#cmtDiv').html(rsp.cmtArr);
        $('#pagination').html(rsp.pages);
        showStar();
        msgBtnAdd();
    }


}

function initCmt() {
    snackNo=$('#item').attr('snackNo');
    // getCmt(0);
    firstGet();


}


window.addEventListener('load',initCmt,false);