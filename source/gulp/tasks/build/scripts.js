import gulp from 'gulp';
import pump from 'pump';
import concat from 'gulp-concat';
import fileinclude from 'gulp-file-include';
import terser from 'gulp-terser';
import browserSync from 'browser-sync';

import path from '../../paths.js';
import error from '../../error.js';

const reload = browserSync.reload;

gulp.task('build:scripts', function (done) {
    // pump(), not chained .pipe() - see build:styles for why.
    pump([
        gulp.src(path.src.scripts),
        fileinclude({
            prefix: '@@',
            basepath: '@file'
        }),
        terser(),
        concat('main.min.js'),
        gulp.dest(path.build.scripts),
        reload({ stream: true })
    ], function (err) {
        error.notify(err);
        done(err);
    });
});
