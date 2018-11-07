gulp.task('autoprefixer', function () {
    var postcss = require('gulp-postcss');
    var autoprefixer = require('autoprefixer');

    return gulp.src('homeworks\week9\hw1\style.css')
        .pipe(postcss([autoprefixer()]))
        .pipe(gulp.dest('./dest'));
});