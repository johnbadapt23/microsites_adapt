import gulp from 'gulp';
import fileinclude from 'gulp-file-include';
import browserSync from 'browser-sync';

import path from '../../paths.js';

const reload = browserSync.reload;

gulp.task('build:html', function () {
    return gulp.src(path.src.html)
        .pipe(fileinclude({
            prefix: '@@',
            basepath: './source/templates/'
        }))
        .pipe(gulp.dest(path.build.html || path.build.base))
        .pipe(reload({ stream: true }));
});
