'use strict';

var gulp = require('gulp');
var $ = require('gulp-load-plugins')();
var del = require('del');

gulp.task('scripts', function() {
  gulp.src(require('./assets/js/common.json'))
    .pipe($.concat('common.js'))
    .pipe($.uglify({preserveComments: 'some'}))
    .pipe(gulp.dest('web/js'))
    .pipe($.gzip())
    .pipe(gulp.dest('web/js'));
});

gulp.task('styles', function() {
  gulp.src('assets/less/common.less')
    .pipe($.plumber())
    .pipe($.less())
    .pipe($.autoprefixer({browsers: ['last 2 versions']}))
    .pipe($.cssnano())
    .pipe(gulp.dest('web/css'))
    .pipe($.gzip())
    .pipe(gulp.dest('web/css'));
});

gulp.task('fonts', function() {
  gulp.src(require('./assets/font/common.json'))
    .pipe(gulp.dest('web/fonts'));
});

gulp.task('clean', function() {
  del(['node_modules', 'runtime/*', 'vendor', 'web/assets/*']);
});

gulp.task('build', ['scripts', 'styles', 'fonts']);

gulp.task('default', ['build'], function() {
  gulp.watch('assets/js/**/*.js', ['scripts']);
  gulp.watch('assets/less/**/*.less', ['styles']);
});
