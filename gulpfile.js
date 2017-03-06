'use strict';

var gulp = require('gulp');
var $ = require('gulp-load-plugins')();

gulp.task('js', function() {
  gulp.src(require('./assets/js/common.json'))
    .pipe($.concat('common.js'))
    .pipe($.uglify({preserveComments: 'license'}))
    .pipe(gulp.dest('web/js'))
    .pipe($.gzip())
    .pipe(gulp.dest('web/js'));
});

gulp.task('css', function() {
  gulp.src('assets/css/common.scss')
    .pipe($.plumber())
    .pipe($.sass().on('error', $.sass.logError))
    .pipe($.autoprefixer({browsers: ['last 2 versions']}))
    .pipe($.cssnano())
    .pipe(gulp.dest('web/css'))
    .pipe($.gzip())
    .pipe(gulp.dest('web/css'));
});

gulp.task('font', function() {
  gulp.src(require('./assets/fonts/common.json'))
    .pipe(gulp.dest('web/fonts'));
});

gulp.task('build', ['js', 'css', 'font']);

gulp.task('default', ['build'], function() {
  gulp.watch('assets/js/**/*.js', ['js']);
  gulp.watch('assets/css/**/*.scss', ['css']);
});
