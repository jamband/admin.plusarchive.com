'use strict';

const fs = require('fs');
const gulp = require('gulp');
const $ = require('gulp-load-plugins')();

gulp.task('js', () =>
  gulp.src(JSON.parse(fs.readFileSync('./assets/js/common.json')))
    .pipe($.concat('common.js'))
    .pipe($.uglify({preserveComments: 'license'}))
    .pipe(gulp.dest('web/assets'))
    .pipe($.gzip())
    .pipe(gulp.dest('web/assets'))
);

gulp.task('css', () =>
  gulp.src('assets/css/common.scss')
    .pipe($.plumber())
    .pipe($.sass().on('error', $.sass.logError))
    .pipe($.autoprefixer({browsers: ['last 2 versions'], cascade: false}))
    .pipe($.cssnano())
    .pipe(gulp.dest('web/assets'))
    .pipe($.gzip())
    .pipe(gulp.dest('web/assets'))
);

gulp.task('font', () =>
  gulp.src(JSON.parse(fs.readFileSync('./assets/fonts/common.json')))
    .pipe(gulp.dest('web/assets'))
);

gulp.task('build', ['js', 'css', 'font']);

gulp.task('default', ['build'], () => {
  gulp.watch('assets/js/**/*.{js,json}', ['js']);
  gulp.watch('assets/css/**/*.scss', ['css']);
  gulp.watch('assets/fonts/common.json', ['font']);
});
