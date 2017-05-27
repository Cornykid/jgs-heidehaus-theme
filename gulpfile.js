//Gulp Packages
var gulp = require('gulp'),
    path = require('path'),
    watch = require('gulp-watch'),
    newer = require('gulp-newer'),
    imagemin = require('gulp-imagemin'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    sass = require('gulp-sass'),
    postcss = require('gulp-postcss'),
    assets = require('postcss-assets'),
    autoprefixer = require('autoprefixer'),
    mqpacker = require('css-mqpacker'),
    cssnano = require('gulp-cssnano');


//Sass processing
gulp.task('sass', function() {
      gulp.src('src/sass/*.scss')
        .pipe(sass())
        .pipe(gulp.dest('src/css'));
});

//CSS processing
gulp.task('css', ['images'], function() {

  var postCssOpts = [
  autoprefixer({ browsers: ['last 2 versions', '> 2%'] }),
  mqpacker
  ];

  return gulp.src('src/css/*.css')
    .pipe(postcss(postCssOpts))
    .pipe(concat('main.min.css'))
    //.pipe(cssnano())
    .pipe(gulp.dest('./dist/css'));

});

//Image processing
gulp.task('images', function() {
  var out = './dist/img/';
  return gulp.src('src/img/**/*')
    .pipe(newer(out))
    .pipe(imagemin({ optimizationLevel: 5 }))
    .pipe(gulp.dest(out));
});

//JavaScript processing
gulp.task('js', function() {
  var jsbuild = gulp.src('src/js/**/*')
    .pipe(concat('main.min.js'))
    .pipe(uglify());

  return jsbuild.pipe(gulp.dest('./dist/js/'));
});


// run task
gulp.task('run', ['sass', 'css', 'js', 'images']);

// watch for changes
gulp.task('watch', function() {
  gulp.watch('src/img/**/*', ['images']);

  gulp.watch('src/js/**/*', ['js']);

  gulp.watch('src/sass/**/*', ['sass']);

  gulp.watch('src/css/**/*', ['css']);
});

// default task
gulp.task('default', ['run', 'watch']);