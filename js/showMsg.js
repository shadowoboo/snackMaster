
function repBtnAdd(){
    $('.report').click(function(e){
        $('.report').attr('disable',true);
        // console.log($(this).attr('repno'));
        if($('#btnloglout').text()=='登出'){
            if(confirm("確定要檢舉這則言論嗎?")){
                // console.log($(this));
                var repNo=$(this).attr('repno');
                var to=$(this).attr('to');
                var xhr=new XMLHttpRequest();
                xhr.open("Post","sendRep.php",true);
                xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                var data_info=`repNo=${repNo}&repTo=${to}`;
                xhr.send(data_info);
                xhr.onload=function(){
                    if(xhr.responseText=='already'){

                        alertBox('您已經檢舉過這則評價了。')
                    }else if(xhr.responseText=='already2'){

                        alertBox('您已經檢舉過這則留言了。')
                    }else{
                        alertBox('感謝您的檢舉，將由管理員進行審核');
                        // console.log(xhr.responseText);
                    }
                    $('.report').attr('disable',false);  
                }

            }else{
                $('.report').attr('disable',false);  
            }
        }else{
            alertBox('登入會員後才能進行檢舉');
            $('#sure').click(showLightBox) ;    
            $('.report').attr('disable',false);          
        }
    });
}
function pageBtnAdd(){
    snackNo=$('#item').attr('snackNo');

    $('.page-link:eq(1)').addClass('nowLoc');
    $('.page-link').click(function(){

        if($(this).attr('id')=='next'){
           var page = parseInt( $('.nowLoc').attr('page'))+1;
           console.log($('.nowLoc').attr('page'));

        }else if($(this).attr('id')=='last'){
            var page = parseInt( $('.nowLoc').attr('page'))-1;
        }else{
            var page =parseInt($(this).attr('page'));
        }

        if(page > 0 && page < $('.page-link').length-1){
            $('.page-link').removeClass('nowLoc');
            $(`.page-link:eq(${page})`).addClass('nowLoc');
            var xhr =new XMLHttpRequest();
            xhr.open("Post", "getCmt.php", true);
            xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            var data_info=`snackNo=${snackNo}&page=${page}`;
            xhr.send(data_info);
            xhr.onload=function(){
                var rsp=JSON.parse(xhr.responseText);
                // class rsp{
                //     public $pages;
                //     public $cmtArr=[];
                // }
        
                // setPagination(rsp.pages);
                $('#cmtDiv').html(rsp.cmtArr);
                showStar();
                $('.sendMsg').off('click');
                $('.like').off('click');
                $('.report').off('click');
                msgBtnAdd();
                sendMsg();
                likeBtnAdd();
            }
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#comment").offset().top
            }, 500);

        }else{
            if(page==0){
                alertBox('這就是盡頭了');
            }else{
                alertBox('沒有下一頁了!');
            }
        }
        
        
    });


}

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
                alertBox('已經說過讚');
            }else{
                likeBtn.html(`<i class="far fa-thumbs-up"></i>${likeTime+1}`);
            }
        }
        // $(this).html(`<i class="far fa-thumbs-up"></i>${likeTime+1}`);

    }else{
        alertBox('登入會員後才能按讚');
        $('#sure').click(showLightBox) ;  
    }


})

}

function sendMsg(){
    $('.sendMsg').click(function(e){
        //檢查登入狀態
        // $('.sendMsg').off('click');
        $('.sendMsg').attr('disable',true);
        if($('#btnloglout').text()=='登出'){
        //登入true->將留言內容送入資料庫並重撈一次全部留言    
        
            var evaNo=$(this).attr('evaNo');
            var msgText=  $(this).prev().val();
            var xhr2 =new XMLHttpRequest(); 
            xhr2.open("Post", "sendMsg.php", true);
            xhr2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            var data_info=`evaNo=${evaNo}&msgText=${msgText}`;
            xhr2.send(data_info);
            xhr2.onload=function(){
            rsp = xhr2.responseText;
            if(rsp==2){
                alertBox('請勿留下空白訊息');
                $('.sendMsg').attr('disable',false);
                return false;
                
            }else{
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
                    $('#show'+evaNo).html('<i class="fas fa-comment"></i>隱藏留言');
                    $('#ctx'+evaNo).val('');
                    $('.report').off('click');
                    repBtnAdd();
                    // $('.sendMsg').on('click');
                    $('.sendMsg').attr('disable',false);
            }
            // console.log('留言成功');
            }
        };

        }else{
        //登入false->把留言內容寫入secction後 等到確定登入了再送資料庫並重撈。    
            alertBox('登入會員後才能進行留言');
            $('#sure').click(showLightBox) ;  
            $('.report').attr('disable',false);
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
                    msgBoxHTML='<p class="noMsg">本評價尚無任何留言</p>';
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
                                    <p>${msgArr[i].memId}</p><button class="report" to="msg" repNo="${msgArr[i].msgNo}">...</button>
                                </div>
                                <p class="msgCtx">${msgArr[i].msgText}</p>
                                <p class="msgTime">留言時間:${msgArr[i].msgTime}</p>
                            </div>
                        </div>`
                    }

                };
                $('#msgBox'+evaNo).css('height','auto').html(msgBoxHTML);
                
                $('.report').off('click');
                repBtnAdd();
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
        // console.log($(this));
    })
}


function firstGet(){
    snackNo=$('#item').attr('snackNo');
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
        pageBtnAdd();
        repBtnAdd();
        // shareBtn();

        
    }


}

function initCmt() {
    snackNo=$('#item').attr('snackNo');
    // getCmt(0);
    firstGet();


}


window.addEventListener('load',initCmt,false);