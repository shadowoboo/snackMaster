// import { Power0 } from "gsap";

// TweenMax.to(".box_1",5,{
//     x:100,
//     y:100
// })

// TweenMax.to(".box_2",5,{
//     x:300,
//     y:50
// })


var  tl =  new TimelineMax({
    repeat: -1,
    yoyo: true
});

tl.to(".box_1",5,{
        x:100,
        y:100
    }).to(".box_2",5,{
            x:300,
            y:50
        })
tl.play(1);

//scrollMagic yooooo---------|

var controller = new ScrollMagic.Controller();

var an01=TweenMax.to(".bgimg",30,{
    // x:600,
    // scale:1,
    rotationZ:360,
    repeat:-1,
    ease: Power0.easeNone
})

var an01_1=TweenMax.fromTo(".snBox",1,{
    // x:600,
    scale:1,
    // rotationZ:360,
    y:5,
    repeat:-1,
    scale:1.5,
    ease: Power0.easeNone
},{
    y:-5,
    repeat:-1,
    yoyo:true,
    // ease: Power0.easeNone
})

//配合jQ可以串接.onXXXX事件
//fromTo中下repeat:-1, 場景給duration:100%, 可以在離開場景後停止動畫, 標記內連續撥放
var scene = new ScrollMagic.Scene({
    triggerElement:"#trigger_04",
    // offset:300,
    // duration:"50%"
    reverse:false
}).setTween([an01,an01_1])
// .setTween(an01_1) 
.addIndicators({
    // name: 'scence 01' //可以自己修改"記號的顯示名稱"
})
.addTo(controller);





var sec05_box=TweenMax.fromTo("#sec05_box",10,{
    rotationX:0,
    rotationY:0,
    rotationZ:0,
    ease: Power0.easeNone
},{
    rotationX:360,
    // rotationY:360,
    // rotationZ:360,
    // repeat:-1,
    ease: Power0.easeNone
})

// var t2=new TimelineMax();
// t2.from(".section_5 h2",0.3,{
//     x:-100,
//     opacity:0
// }).from(".section_5 p",0.3,{
//     y:-100,
//     opacity:0,
//     scale:0
// }).fromTo("sec05_box",0.3,{
//     rotationX:0
// },{
//     rotationX:360
// });


var scene_02= new ScrollMagic.Scene({
    triggerElement:"#trigger_05",
    duration:"60%",

}).setTween(sec05_box)
.addIndicators()
.addTo(controller);




// var scene_h2=TweenMax.fromTo("section_6 h2")
var scene_03= new ScrollMagic.Scene({
    triggerElement:"#trigger_06",
    // duration:"60%",

})
.setClassToggle(".section_6 h2,.setbg","on")
// .setClassToggle(".setbg","on")
.setTween()
.addIndicators()
.addTo(controller);






var tlpin = new TimelineMax();
tlpin.to('.box_0701', 1, {
    x: 100
}).to('.box_0702', 1, {
    x: 200
}).to('.box_0703', 1, {
    x: 300
}).to('.box_0704', 1, {
    x: 400
}).to('.box_0705', 1, {
    x: 500
}).to('.box_0706', 1, {
    x: 600
}).to('.box_0707', 1, {
    x: 700
}).to('.box_0708', 1, {
    x: 800
});
var scene_04=new ScrollMagic.Scene({
    triggerElement:"#trigger_07",
    duration:"800%",//有幾個to串接就要*幾倍
    triggerHook:0,//設定trigger高度, 設0就從畫面一進來就觸發,100就到底觸發
})
.setPin(".section_07")
.setTween(tlpin)
.addIndicators()
.addTo(controller);






var tl_sec08=new TimelineMax();
tl_sec08.fromTo('.sec_0801', 1, {
    x: "-100%"
}, {
    x: '0%'
}).fromTo('.sec_0802', 1, {
    x: "100%"
}, {
    x: '0%'
}).fromTo('.sec_0803', 1, {
    y: "-100%"
}, {
    y: '0%'
})

var scene_sce = new ScrollMagic.Scene({
    triggerElement: "#trigger_08",
    duration: '300%',
    //畫面最上緣
    triggerHook: 0,
    //只出現一次
    // reverse: false,
})
.setPin('.section_08')
.setTween(tl_sec08)
.addIndicators()
.addTo(controller);
//scrollMagic End-----------|




// TweenMax.to(".box_3",5,{
//     repeat:-1,
//     rotationX:360,
//     rotationY:360,
//     rotationZ:360})

btn_1=document.getElementById("btn_1");
btn_1.addEventListener("click",{
    
})




mouse={
    x:0,
    y:0
};
box_3=document.getElementById("box_3");
section_3=document.getElementById("section_3");
console.log(section_3);

box_3.addEventListener("mousemove",(e)=>{
    let h=section_3.offsetHeight;
    let w=section_3.offsetWidth;
    mouse.x=e.offsetX;
    mouse.y=e.offsetY;
    console.log("x: "+mouse.x);
    console.log("y: "+mouse.y);
    console.log("h/2: "+h/2);
    console.log("w/2: "+w/2);

    TweenMax.to("#box_3",1,{
        rotationX:(((h/2)-mouse.y)%90),
        rotationY:((mouse.x-(w/2))%90),
        rotationZ:0})

})






