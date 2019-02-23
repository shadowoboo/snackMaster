// $(document).ready(function(){
//   $('#btnmodify').click(function(){
//     //點擊按鈕，以字串形式打包表單資料
//      memUPdata = $('#memInfo').serialize();
//      console.log(memUPdata);
     
//     $.ajax({
//       url: 'memUpdate.php',
//       // type: 'POST',
//       data:memUPdata,
//       success: function(data){//PHP回傳的結果
//         if(data=="memOK"){
//           alert("修改完成");
//         }else{
//           alert("修改失敗");
//           console.log(data);
//         }
//       }
//     });
//   });

// });
function $id(id){
  return document.getElementById(id);
}

function headChange(){
  var file = $id('upFile').files[0];
  var readFile = new FileReader();
  readFile .readAsDataURL(file);
  readFile.addEventListener('load',function(){
    var bigHead = $id('headPic');
    bigHead.src = readFile.result;
    bigHead.style.maxWidth = '200px';
    bigHead.style.maxHeight = '300px';
  });
}
//展開訂單明細
function moreList(e){
  if($id('listMorebtn').innerText=="訂單明細v"){
    e.currentTarget.innerHTML = "訂單明細^";
  }else{
    e.currentTarget.innerHTML = "訂單明細v";
  }
  
  $id('proEva').classList.toggle('expand');
  
}
//跳出商品評價燈箱
function evaBox(e){

  e.currentTarget.style.color="red";
  $id('#evaBox').classList.add('jump');
}




function doFirst(){
  $id('upFile').onchange = headChange;
  $id('listMorebtn').addEventListener('click',moreList);
  $id("evaShow").addEventListener("click",evaBox);
}
window.addEventListener('load',doFirst);

//-----------------------頁籤切換------------------------//
function changeTabs(evt, tabList) {
    var i,tablinks,tabPanel;
    tabPanel = document.getElementsByClassName("tabPanel");
    for (i = 0; i < tabPanel.length; i++) {
        tabPanel[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");

    }
    document.getElementById(tabList).style.display = "block";
    
    evt.currentTarget.className += " active";
  }
  
  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();
//-----------------------頁籤切換結束------------------------//





