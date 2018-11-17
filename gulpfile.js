const gulp = require('gulp');
const sass = require('gulp-sass');
const minify = require('gulp-minify');
const cleanCss = require('gulp-clean-css');
const babel = require('gulp-babel');
const clean = require('gulp-clean');
gulp.task('clean', function () {
    return gulp.src('./build')
        .pipe(clean())
})
gulp.task('css', function () {
    return gulp.src('homeworks/week10/hw1/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCss())
        .pipe(gulp.dest('./build'))
});
gulp.task('js', function () {
    return gulp.src("homeworks/week10/hw1/hw2.js")
        .pipe(babel())
        .pipe(minify())
        .pipe(gulp.dest("./build"));
})
gulp.task('default', ['css', 'js'])