import gulp from 'gulp';
import image from 'gulp-image';
import browserSync from 'browser-sync';

import path from '../../paths.js';

const reload = browserSync.reload;

gulp.task('build:images', function () {
    return gulp.src(path.src.images)
        .pipe(image({
            pngquant: true,
            optipng: false,
            zopflipng: true,
            advpng: true,
            jpegRecompress: false,
            jpegoptim: true,
            mozjpeg: true,
            gifsicle: true,
            svgo: true
        }))
        .pipe(gulp.dest(path.build.images))
        .pipe(reload({ stream: true }));
});
