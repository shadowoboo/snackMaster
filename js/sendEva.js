


function addBtnEva(){

    $('.sendEva').click(function(){
        var snackNo=$(this).attr('id');
        
        var evaCtx=$(`tr[name=snackNo${snackNo}] textarea`).val();
        var sweetStar=$(`tr[name=snackNo${snackNo}] input[name=swStar]:checked`).val();
        var sourStar=$(`tr[name=snackNo${snackNo}] input[name=suStar]:checked`).val();
        var spicyStar=$(`tr[name=snackNo${snackNo}] input[name=spStar]:checked`).val();
        var goodStar=$(`tr[name=snackNo${snackNo}] input[name=gdStar]:checked`).val();

        var data_info=`snackNo=${snackNo}&evaCtx=${evaCtx}&goodStar=${goodStar}&sourStar=${sourStar}&sweetStar=${sweetStar}&spicyStar=${spicyStar}`;
        var xhr= new XMLHttpRequest();
        xhr.open("Post", "sendEva.php", true);
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhr.send(data_info);
        xhr.onload=function(){
            alert("感謝您提供的意見，加100分");
            $(`div[name=snackNo${snackNo}]`).remove();

        }
        console.log(data_info);
    });
   


}

window.addEventListener('load',addBtnEva,false);