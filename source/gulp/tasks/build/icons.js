import gulp from 'gulp';
import rename from 'gulp-rename';
import iconfont from 'gulp-iconfont';
import iconfontCss from 'gulp-iconfont-css';

import path from '../../paths.js';

const timestamp = Math.round(Date.now() / 1000);

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
