// $('.btnMsg').click(function(e) {
//         if($(this).text()=='顯示留言'){
//             $(this).html('<i class="fas fa-comment"></i>隱藏留言');
//         }else{
//             $(this).html('<i class="fas fa-comment"></i>顯示留言');
//         };

//         var thisBox='msgBox'+snackNo;
//         $('.'+thisBox).css('height','200px');
//     });
function likeBtnAdd(){
$('.like').click(function(){
    var likeBtn=$(this);
    if($('#btnloglout').text()=='登出'){
        //登入成功 讚數+1 並將已經登入寫進session
        var likeTime=parseInt($(this).text());
        var evaNo=$(this).attr('evaNo');
        var xhr=new XMLHttpRequest();
        xhr.open('Post','updateLike.php',true);
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        var data_info=`evaNo=${evaNo}&liketime=${likeTime+1}`;
        xhr.send(data_info);
        xhr.onload=function(){
            if(xhr.responseText=="liked"){
                alert('已經說過讚');
            }else{
                likeBtn.html(`<i class="far fa-thumbs-up"></i>${likeTime+1}`);
            }
        }
        // $(this).html(`<i class="far fa-thumbs-up"></i>${likeTime+1}`);

    }else{
        alert('登入會員後才能按讚');
        showLightBox();    
    }


})

}

function sendMsg(){
    $('.sendMsg').click(function(e){
        //檢查登入狀態
        if($('#btnloglout').text()=='登出'){
        //登入true->將留言內容送入資料庫並重撈一次全部留言    
        
       var evaNo=$(this).attr('evaNo');
       var msgText=  $(this).prev().val();
       var xhr =new XMLHttpRequest(); 
       xhr.open("Post", "sendMsg.php", true);
       xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
       var data_info=`evaNo=${evaNo}&msgText=${msgText}`;
       xhr.send(data_info);
       xhr.onload=function(){
            console.log('留言成功');
            var xhr =new XMLHttpRequest();
            xhr.open("Post", "getMsg.php", true);
            xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            var data_info=`evaNo=${evaNo}`;
            xhr.send(data_info);
            msgBoxHTML='';
            xhr.onload=function(){
                var msgArr=JSON.parse(xhr.responseText);
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
                            <p class="msgCtx">${msgArr[i].msgText}</p>
                            <p class="msgTime">留言時間:${msgArr[i].msgTime}</p>
                        </div>
                    </div>`
                }
                $('#msgBox'+evaNo).css('height','auto').html(msgBoxHTML);
            }
        };
        $(this).prev().val('');
        $(this).parent().prev().children().last().html('<i class="fas fa-comment"></i>隱藏留言');

        }else{
        //登入false->把留言內容寫入secction後 等到確定登入了再送資料庫並重撈。    
            alert('登入會員後才能進行留言');
            showLightBox();
        }
        
        

    });


}
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
                    msgBoxHTML='<p>本評價尚無任何留言</p>';
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
                                <p class="msgCtx">${msgArr[i].msgText}</p>
                                <p class="msgTime">留言時間:${msgArr[i].msgTime}</p>
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
        sendMsg();
        likeBtnAdd();
    }


}

function initCmt() {
    snackNo=$('#item').attr('snackNo');
    // getCmt(0);
    firstGet();


}


window.addEventListener('load',initCmt,false);