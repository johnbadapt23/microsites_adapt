import gulp from 'gulp';
import browserSync from 'browser-sync';

import path from '../../paths.js';

const reload = browserSync.reload;

// NOTE: this used to run every font through gulp-fontgen, which shells out to
// fontforge/ttf2eot/batik-ttf2svg (Unix/Mac-only system binaries, not present
// on this machine or in CI). source/fonts/ already ships every format
// (ttf/otf/eot/woff/svg) pre-compiled, so generation was redundant — this now
// just copies the pre-built files straight through.
gulp.task('build:fonts', function () {
    return gulp.src('source/fonts/**/*.{ttf,otf,eot,woff,woff2,svg,json}')
        .pipe(gulp.dest(path.build.fonts))
        .pipe(reload({ stream: true }));
});
