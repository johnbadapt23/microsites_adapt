import gulp from 'gulp';
import rename from 'gulp-rename';
import iconfont from 'gulp-iconfont';
import iconfontCss from 'gulp-iconfont-css';

import path from '../../paths.js';

// Fixed, not Date.now(): gulp-iconfont embeds this in the generated font's
// metadata, so a wall-clock timestamp makes the output non-deterministic -
// rebuilding from byte-identical source/icons/*.svg produced a different
// icons.{eot,ttf,woff,woff2,svg} every time, which defeats any "does the
// build match what's committed" check (CI would always show a diff, even
// with zero real changes). The exact value is arbitrary - it's just font
// metadata - so any fixed epoch works.
const timestamp = 1700000000;

gulp.task('build:icons', function (done) {
    // Two dependent streams: the second reads the icons.css the first one
    // just wrote, so it has to wait for the first to actually finish (gulp3
    // fired both without waiting for completion, which only worked by luck).
    const iconStream = gulp.src(path.src.icons)
        .pipe(iconfontCss({
            fontName: 'icons',
            targetPath: 'icons.css',
            fontPath: '../fonts/'
        }))
        .pipe(iconfont({
            fontName: 'icons',
            prependUnicode: true, // renamed from appendUnicode in svgicons2svgfont
            formats: ['ttf', 'eot', 'woff', 'woff2', 'svg'],
            timestamp: timestamp,
        }))
        .pipe(gulp.dest(path.build.fonts));

    iconStream.on('error', done);
    iconStream.on('end', function () {
        gulp.src(path.build.fonts + 'icons.css')
            .pipe(rename('_icons.scss'))
            .pipe(gulp.dest('source/scss/global/'))
            .on('error', done)
            .on('end', () => done());
    });
});
