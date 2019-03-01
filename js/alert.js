function alertBox(msg){
    var boxBody = document.createElement('div');
    boxBody.id = 'alertBoxBody';
    var box = document.createElement('div');
    box.id = 'alertBox';
    var p = document.createElement('p');
    p.innerText = msg;
    var sureBtn = document.createElement('button');
    sureBtn.id = 'sure';
    sureBtn.innerText = '確定';
    box.appendChild(p);
    box.appendChild(sureBtn);
    boxBody.appendChild(box);
    document.getElementsByTagName('body')[0].appendChild(boxBody);
    sureBtn.addEventListener('click', function (){
        document.getElementsByTagName('body')[0].removeChild(boxBody);    
    });
    document.getElementById('alertBoxBody').addEventListener('click', function (e){
        if(e.target.id == 'alertBoxBody'){
            document.getElementsByTagName('body')[0].removeChild(boxBody);    
        }
    })
}
function confirmBox(msg, sureFunc){
    var boxBody = document.createElement('div');
    boxBody.id = 'alertBoxBody';
    var box = document.createElement('div');
    box.id = 'alertBox';
    var p = document.createElement('p');
    p.innerText = msg;
    var sureBtn = document.createElement('button');
    sureBtn.id = 'sure';
    sureBtn.innerText = '確定';
    var noBtn = document.createElement('button');
    noBtn.id = 'hellNo';
    noBtn.innerText = '取消';
    box.appendChild(p);
    box.appendChild(noBtn);
    box.appendChild(sureBtn);
    boxBody.appendChild(box);
    document.getElementsByTagName('body')[0].appendChild(boxBody);
    sureBtn.addEventListener('click', function () {
        sureFunc();
        document.getElementsByTagName('body')[0].removeChild(boxBody);
    }); 
    noBtn.addEventListener('click', function () {
        document.getElementsByTagName('body')[0].removeChild(boxBody);
    })
    document.getElementById('alertBoxBody').addEventListener('click', function (e) {
        if (e.target.id == 'alertBoxBody') {
            document.getElementsByTagName('body')[0].removeChild(boxBody);
        }
    })
}

