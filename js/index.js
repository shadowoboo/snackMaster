$(document).ready(function () {

    $('.countryImg').each(function () {
        var originTop = parseInt($(this).css('top'));//先抓原本你ＣＳＳ寫的高度
        var parentHeight = parseInt($(this).parent().css('height'));
        $(this).css('top', '-300px');//然後把國旗放到0的位置  
            
        $(this).animate({//做個動畫讓它們掉下來}
            top: `${Math.ceil((originTop/parentHeight)*100)}%`,
        }, 2000, 'easeOutBounce');
        // console.log($(this).css('top'));
    })


    $(window).scroll(function () {
        // if($(window).width()>'768px'){
            if ($(window).scrollTop() > $('#section_12').offset().top - 500) {
                $('.snackMap').css({
                    'transform': 'translateY(100%) scale(0)',
                    'opacity': '0',
                    'transition': '2.5s',
                });
            } 
            else {
                $('.snackMap').css({
                    'transform': 'translateY(0) scale(1)',
                    'opacity': '1',
                });
            }
        // }
    });

    //給箱子姿態初始值
    // boxBases.forEach(el => {
    //     el.style.transform = "rotateX(-30deg) rotateY(30deg) rotateZ(0deg)";
    // })

    shouldMove = true;
    $(window).scroll(function () {
        if(shouldMove ===true){
            if ($(window).scrollTop() > $('#section_12').offset().top - 500) {
                cover_out_12.style.transform = "translate3d(0, 40px, -100px) rotateX(200deg)";
                cover_in_12.style.transform = "translate3d(0, 40px, -100px) rotateX(200deg) rotateY(180deg)";
                //下蓋初始關起來
                cover_dl_12.style.transform = "translate3d(-200px, 160px, 0px) rotateY(-90deg) rotateX(-90deg) ";
                cover_dr_12.style.transform = "translate3d(200px, 160px, 0px)  rotateY(90deg) rotateX(-90deg)";
                //box_12姿態固定
                box_12.style.transform = "rotateX(-30deg) rotateY(30deg) rotateZ(0deg)";
                setTimeout(e => {
                    box_12.style.transform = "rotateX(-30deg) rotateY(0deg) rotateZ(0deg)";
                }, 500)

                //延遲....上蓋關起來
                setTimeout(e => {
                    cover_out_12.style.transform = "translate3d(0, 40px, -100px) rotateX(90deg)";
                    cover_in_12.style.transform = "translate3d(0, 40px, -100px) rotateX(90deg) rotateY(180deg)";
                }, 1500);


            }
            if ($(window).scrollTop() > $('.LeaderboardCount').offset().top - 500) {

                //延遲...箱子抬起來
                setTimeout(e => {
                    box_12.style.transform = "rotateX(20deg) rotateY(0deg) rotateZ(0deg)";
                }, 1500)
                //延遲...下蓋兩片打開
                setTimeout(e => {
                    cover_dl_12.style.transform = "translate3d(-200px, 160px, 0px) rotateY(-90deg) rotateX(30deg) ";
                    cover_dr_12.style.transform = "translate3d(200px, 160px, 0px)  rotateY(90deg) rotateX(30deg)";
                }, 1700);
            }
            shouldMove = false;
        }else{
            if ($(window).scrollTop() < $('#section_12').offset().top - 500) {
                cover_out_12.style.transform = "translate3d(0, 40px, -100px) rotateX(200deg)";
                cover_in_12.style.transform = "translate3d(0, 40px, -100px) rotateX(200deg) rotateY(180deg)";
                //下蓋初始關起來
                cover_dl_12.style.transform = "translate3d(-200px, 160px, 0px) rotateY(-90deg) rotateX(-90deg) ";
                cover_dr_12.style.transform = "translate3d(200px, 160px, 0px)  rotateY(90deg) rotateX(-90deg)";
                //box_12姿態固定
                box_12.style.transform = "rotateX(-30deg) rotateY(30deg) rotateZ(0deg)";
                setTimeout(e => {
                    box_12.style.transform = "rotateX(-30deg) rotateY(0deg) rotateZ(0deg)";
                }, 400)

                //延遲....上蓋關起來
                setTimeout(e => {
                    cover_out_12.style.transform = "translate3d(0, 40px, -100px) rotateX(90deg)";
                    cover_in_12.style.transform = "translate3d(0, 40px, -100px) rotateX(90deg) rotateY(180deg)";
                }, 1500);
            }
            if ($(window).scrollTop() < $('.LeaderboardCount').offset().top - 500) {

                //延遲...箱子抬起來
                setTimeout(e => {
                    box_12.style.transform = "rotateX(20deg) rotateY(0deg) rotateZ(0deg)";
                }, 1500)
                //延遲...下蓋兩片打開
                setTimeout(e => {
                    cover_dl_12.style.transform = "translate3d(-200px, 160px, 0px) rotateY(-90deg) rotateX(30deg) ";
                    cover_dr_12.style.transform = "translate3d(200px, 160px, 0px)  rotateY(90deg) rotateX(30deg)";
                }, 1700);
            }
            shouldMove = false;
        }   
    });



    //先讓排行榜跟糖果消失
    $('.LeaderboardCount').css({
        'transform': 'translateY(-80%) scale(0)',
        'opacity': '0',
    });
    $('.lbIconImg').css({
        'transform': 'translateY(-80%) scale(0)',
        'opacity': '0',
    });
    shouldScroll = true;
    $(window).scroll(function () {
        if (shouldScroll === true) {

            if ($(window).scrollTop() > $('.LeaderboardTitle').offset().top - 400) {
                $('.LeaderboardCount').css({
                    'transform': 'translateY(0) scale(1)',
                    'opacity': '1',
                    'transition': '2.5s',
                });
                //彩帶效果
                Point = function (x, y) {
                    this.x = x || 0;
                    this.y = y || 0;
                };

                Particle = function (ctx, p0, p1, p2, p3) {
                    this.ctx = ctx;
                    this.p0 = p0;
                    this.p1 = p1;
                    this.p2 = p2;
                    this.p3 = p3;

                    this.time = 0;
                    this.duration = 3 + Math.random() * 1;
                    this.color = '#' + Math.floor((Math.random() * 0xffffff)).toString(16);

                    this.w = 8;
                    this.h = 6;

                    this.complete = false;
                };

                Particle.prototype = {
                    update: function () {
                        // (1/60) is timeStep
                        this.time = Math.min(this.duration, this.time + (1 / 60));

                        var f = Ease.outCubic(this.time, 0.125, 1, this.duration);
                        var p = cubeBezier(this.p0, this.p1, this.p2, this.p3, f);

                        var dx = p.x - this.x;
                        var dy = p.y - this.y;

                        this.r = Math.atan2(dy, dx) + (Math.PI * 0.5);
                        this.sy = Math.sin(Math.PI * f * 10);
                        this.x = p.x;
                        this.y = p.y;

                        this.complete = this.time === this.duration;
                    },
                    draw: function () {
                        this.ctx.save();
                        this.ctx.translate(this.x, this.y);
                        this.ctx.rotate(this.r);
                        this.ctx.scale(1, this.sy);

                        this.ctx.fillStyle = this.color;
                        this.ctx.fillRect(-this.w * 0.5, -this.h * 0.5, this.w, this.h);

                        this.ctx.restore();
                    }
                };

                function CelebrationCanvas(canvas, width, height) {
                    var particles = [];
                    var ctx = canvas.getContext('2d');

                    canvas.width = width;
                    canvas.height = height;
                    createParticles();

                    function animate() {
                        requestAnimationFrame(loop);
                    }

                    function createParticles() {
                        for (var i = 0; i < 128; i++) {
                            var p0 = new Point(width * 0.5, height * 0.5);
                            var p1 = new Point(Math.random() * width, Math.random() * height);
                            var p2 = new Point(Math.random() * width, Math.random() * height);
                            var p3 = new Point(Math.random() * width, height + 64);

                            particles.push(new Particle(ctx, p0, p1, p2, p3));
                        }
                    }

                    function update() {
                        particles.forEach(function (p) {
                            p.update();
                        });
                    }

                    function draw() {
                        ctx.clearRect(0, 0, width, height);
                        particles.forEach(function (p) {
                            p.draw();
                        });
                    }

                    function loop() {
                        update();
                        draw();

                        // if (checkParticlesComplete()) {
                        //     // reset
                        //     particles.length = 0;
                        //     createParticles();
                        //     setTimeout(function () {
                        //         animate();
                        //     }, (Math.random() * 2000));
                        // } else {
                        animate();
                        // }
                    }

                    function checkParticlesComplete() {
                        for (var i = 0; i < particles.length; i++) {
                            if (particles[i].complete === false) return false;
                        }
                        return true;
                    }

                    return {
                        animate: animate
                    };
                }

                var celebrationCanvas = new CelebrationCanvas(document.getElementById('celebration'), 800, 800);

                celebrationCanvas.animate();


                /**
                 * easing equations from http://gizma.com/easing/
                 * t = current time
                 * b = start value
                 * c = delta value
                 * d = duration
                 */
                var Ease = {
                    inCubic: function (t, b, c, d) {
                        t /= d;
                        return c * t * t * t + b;
                    },
                    outCubic: function (t, b, c, d) {
                        t /= d;
                        t--;
                        return c * (t * t * t + 1) + b;
                    },
                    inOutCubic: function (t, b, c, d) {
                        t /= d / 2;
                        if (t < 1) return c / 2 * t * t * t + b;
                        t -= 2;
                        return c / 2 * (t * t * t + 2) + b;
                    },
                    inBack: function (t, b, c, d, s) {
                        s = s || 1.70158;
                        return c * (t /= d) * t * ((s + 1) * t - s) + b;
                    }
                };

                function cubeBezier(p0, c0, c1, p1, t) {
                    var p = new Point();
                    var nt = (1 - t);

                    p.x = nt * nt * nt * p0.x + 3 * nt * nt * t * c0.x + 3 * nt * t * t * c1.x + t * t * t * p1.x;
                    p.y = nt * nt * nt * p0.y + 3 * nt * nt * t * c0.y + 3 * nt * t * t * c1.y + t * t * t * p1.y;

                    return p;
                }
                shouldScroll = false;
            }
        }
        // else {
        //     $('.LeaderboardCount').css({
        //         'transform': 'translateY(-80%) scale(0)',
        //         'opacity': '0',
        //         'transition': '2.5s',
        //     });
        // }
        if ($(window).scrollTop() > $('.LeaderboardTitle').offset().top - 400) {
            $('.lbIconImg').css({
                'transform': 'translateY(0) scale(1)',
                'opacity': '1',
                'transition': '2.5s',
            });
        }
    });

    // $('.chocoGroup').css({
    //     'transform': 'translateX(-1000px)'
    // });
    // $(window).scroll(function () {
    //     if ($(window).scrollTop() > $('.igCount').offset().top - 500) {
    //         $('.chocoGroup').css({
    //             'transform': 'translateX(0)',
    //             'transition': '1s'
    //         });
    //     }
    // });
});
