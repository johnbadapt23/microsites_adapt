import gulp from 'gulp';
import concat from 'gulp-concat';
import fileinclude from 'gulp-file-include';
import terser from 'gulp-terser';
import browserSync from 'browser-sync';

import path from '../../paths.js';
import error from '../../error.js';

const reload = browserSync.reload;

gulp.task('build:scripts', function () {
    return gulp.src(path.src.scripts)
        .pipe(fileinclude({
            prefix: '@@',
            basepath: '@file'
        }))
        .on('error', error.handler)
        .pipe(terser())
        .on('error', error.handler)
        .pipe(concat('main.min.js'))
        .pipe(gulp.dest(path.build.scripts))
        .pipe(reload({ stream: true }));
});
