var canvas = document.getElementById('canvas');
       var ctx = canvas.getContext('2d');
        canvas.width = canvas.parentNode.offsetWidth;
        canvas.height = canvas.parentNode.offsetHeight;

//如果浏览器支持requestAnimFrame则使用requestAnimFrame否则使用setTimeout  
        window.requestAnimFrame = (function() {
            return window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
        function(callback) {
            //-----------波浪秒數設定-----------
            window.setTimeout(callback, 50000 / 60);
         };
        })();

        window.onresize = function(){
            canvas.width = canvas.parentNode.offsetWidth;
            canvas.height = canvas.parentNode.offsetHeight;
} 

    //初始角度为0  
    var step = 0;
    //定义三条不同波浪的颜色  
    // var lines = ["rgba(0,222,255, 0.3)",
    //             "rgba(157,192,249, 0.3)",
    //             "rgba(0,168,255, 0.3)"
    //             ];
    var lines = ["#fff",
                 "fdfbfb",
                 "rgba(235,237,238, 0.3)"
                
                ];

    function loop() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        step++;
  //画3个不同颜色的矩形  
    for (var j = lines.length - 1; j >= 0; j--) {
            ctx.fillStyle = lines[j];
    //每个矩形的角度都不同，每个之间相差45度  
    var angle = (step + j * 45) * Math.PI / 180;
    //-------------波浪幅度設定(原設定50->35)-------------------
    var deltaHeight = Math.sin(angle) * 30;
    var deltaHeightRight = Math.cos(angle) * 30;
    ctx.beginPath();
    ctx.moveTo(0, canvas.height / 2 + deltaHeight);
    ctx.bezierCurveTo(canvas.width / 2, canvas.height / 2 + deltaHeight - 30, canvas.width / 2, canvas.height / 2 + deltaHeightRight - 30, canvas.width, canvas.height / 2 + deltaHeightRight);
    ctx.lineTo(canvas.width, canvas.height);
    ctx.lineTo(0, canvas.height);
    ctx.lineTo(0, canvas.height / 2 + deltaHeight);
    ctx.closePath();
    ctx.fill();
  }
  requestAnimFrame(loop);
}
loop();

//手機的漢堡
const list_appear = document.getElementById("list_appear");
        const ham = document.getElementById("ham");
        const cros = document.getElementById("cros");
        // const store = document.getElementById("store");
        // const subMenu = document.getElementById("Submenu");
        function init(e) {
            ham.addEventListener("click", show);
            cros.addEventListener("click", close);
            // store.addEventListener("click",appear);

        }
        function show(e) {
            list_appear.classList.add("show");
        
        }
        function close(e) {
            console.log(`remove`);
            list_appear.classList.remove("show");
        }
        //hover的設定,不確定需不需要
        //還沒移除show,如果點擊子選單會收不起來
        // function appear(e){
        //     console.log('hi');
        //     Submenu.classList.add("show");
        // }
        
        window.addEventListener("load",init);

        const search_appear = document.getElementById("search_appear");
        const search = document.getElementById("searchBtn");
        const closex = document.getElementById("close");
        function init2(e) {
            search.addEventListener("click", showSearch);
            closex.addEventListener("click", closeSearch);

        }
        function showSearch(e) {
            search_appear.classList.add("down");
        
        }
        function closeSearch(e) {
            console.log(`remove`);
            search_appear.classList.remove("down");
        }

        window.addEventListener("load",init2);