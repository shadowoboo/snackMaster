var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();
var reload = browserSync.reload;
var jquery = require('gulp-jquery');
var sourcemaps= require('gulp-sourcemaps');

// sass 編譯函式
gulp.task('sass', function () {
    return gulp.src('./sass/*.scss') //來源目錄
        .pipe(sourcemaps.init()) // 初始化sourcemaps功能
        .pipe(sass().on('error', sass.logError)) //經由sass 轉譯
        .pipe(sourcemaps.write('./',{includeContent:false, sourceRoot: '../sass'}))
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
        //     index: "page/index.html"
        // },
        // proxy:指向php server工作資料夾，串連php工作port
        //proxy跟server只能挑一個
        proxy: "localhost:8888/testG2/page"
    });

    gulp.watch(["sass/*.scss", "sass/**/*.scss"], ['sass']).on('change', reload);
    gulp.watch("*.html").on('change', reload);
    gulp.watch("page/*.html").on('change', reload);
    gulp.watch("js/*.js").on('change', reload);
    gulp.watch("images/*").on('change', reload);
    // gulp.watch("images/*").on('change', reload);
});


gulp.task('css', ['cssUrls']);