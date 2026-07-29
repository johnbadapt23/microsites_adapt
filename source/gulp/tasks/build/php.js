import gulp from 'gulp';
import browserSync from 'browser-sync';

import path from '../../paths.js';

const reload = browserSync.reload;

gulp.task('build:php', function () {
    return gulp.src(path.src.php)
        .pipe(reload({ stream: true }));
});
