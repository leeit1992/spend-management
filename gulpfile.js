var gulp        = require('gulp');
var browserSync = require('browser-sync');
var minify      = require('gulp-minify');
var sass        = require('gulp-sass');


gulp.task('js-complie', function() {
  gulp.src('src/js/**/*.js')
    .pipe(minify({
        ext:{
            src:'-debug.js',
            min:'.min.js'
        },
        exclude: ['tasks'],
        ignoreFiles: ['.combo.js', '-min.js']
    }))
    .pipe(gulp.dest('public/backend/js/'));

});
gulp.task('js-watch', ['js-complie'], browserSync.reload);

gulp.task('scss-complie', function() {
    gulp.src('src/sass/*.scss')
        .pipe(sass())
        .pipe(gulp.dest('public/backend/css/'));
});
gulp.task('scss-watch', ['scss-complie'], browserSync.reload);



gulp.task('watch',[], function () {
    browserSync.init({
        proxy: 'http://localhost/spend_atl',
        files: ['{app,resources}/**/*.php', '*.php'],
      });
    
    gulp.watch('src/sass/**/*.scss', ['scss-watch']);
    gulp.watch(['*.php'], browserSync.reload);
    gulp.watch('src/js/**/*.js', ['js-watch']);
});
