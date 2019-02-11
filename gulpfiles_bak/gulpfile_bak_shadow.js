var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();
var reload = browserSync.reload;
var jquery = require('gulp-jquery');
var sourcemaps = require('gulp-sourcemaps');

// sass 編譯函式
gulp.task('sass', function () {
    return gulp.src('./sass/*.scss') //來源目錄
        .pipe(sourcemaps.init()) // Initializes sourcemaps
        .pipe(sass().on('error', sass.logError)) //經由sass 轉譯
        // 寫入sourcemaps到當前資料夾(以下下列dest('../css')為基準點，sourceRoot：以匯出的資料夾為基準點找他原本的scss資料夾位置。
        .pipe(sourcemaps.write('./', { includeContent: false, sourceRoot: '../sass' }))
        .pipe(gulp.dest('./css')); //目的地目錄
});


//jquery環境
gulp.task('jquery', function () {
    return gulp.src('./node_modules/jquery/src')
        .pipe(jquery({
            flags: ['-deprecated', '-event/alias', '-ajax/script', '-ajax/jsonp', '-exports/global']
        }))
        .pipe(gulp.dest('./public/vendor/'));
    // creates ./public/vendor/jquery.custom.js
});


gulp.task('default', ['sass'], function () {

    browserSync.init({
        // server: {
        //     //根目錄
        //     baseDir: "./",
        //     index: "index.html",
        //     // baseDir:"./code testing",

        // },

        //php工作方式
        //整個專案放到server工作的目錄下
        //連接php server的 port
        //proxy指向php server下的工作資料夾
        //ex: proxy:"localhost:80/testG2",
        //就會利用代理的方式連進server，吃到php的效果
        //p.s. proxy 跟 server只能擇一
        proxy:"localhost:80/專題/g2_test", 
    });

    gulp.watch(["sass/*.scss", "sass/**/*.scss"], ['sass']).on('change', reload);
    gulp.watch("*.html").on('change', reload);
    gulp.watch("js/*.js").on('change', reload);
    gulp.watch("images/*").on('change', reload);
    gulp.watch("page/*.html").on('change', reload);
    gulp.watch("codeTesting/*.html").on('change', reload);
    // gulp.watch("images/*").on('change', reload);


    // gulp.watch(["專題/g2_test/sass/*.scss", "專題/g2_test/sass/**/*.scss"], ['sass']).on('change', reload);
    // gulp.watch("專題/g2_test/*.html").on('change', reload);
    // gulp.watch("專題/g2_test/js/*.js").on('change', reload);
    // gulp.watch("專題/g2_test/images/*").on('change', reload);
    // gulp.watch("專題/g2_test/page/*.html").on('change', reload);
    // gulp.watch("專題/g2_test/codeTesting/*.html").on('change', reload);
});


gulp.task('css', ['cssUrls']);