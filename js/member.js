function $id(id){
  return document.getElementById(id);
}
function doFirst(){
  $id('upFile').onchange = headChange;
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





