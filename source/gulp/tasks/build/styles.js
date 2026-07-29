import gulp from 'gulp';
import concat from 'gulp-concat';
import gulpSass from 'gulp-sass';
import * as dartSass from 'sass';
import sassGlob from 'gulp-sass-glob';
import prefixer from 'gulp-autoprefixer';
import cleanCSS from 'gulp-clean-css';
import browserSync from 'browser-sync';

import path from '../../paths.js';
import error from '../../error.js';

const sass = gulpSass(dartSass);
const reload = browserSync.reload;

gulp.task('build:styles', function () {
    // NOTE: the old pipeline ran autoprefixer before the Sass compile step,
    // so it only ever touched the plain vendor .css files in the list and
    // never actually prefixed anything compiled from main.scss. Autoprefixer
    // now runs after sass() so it prefixes the real compiled output too.
    return gulp.src(path.src.styles)
        .pipe(sassGlob())
        .pipe(sass({
            outputStyle: 'compressed',
            // The theme's ~40 partials all use @import, which Dart Sass is
            // deprecating in favour of @use/@forward. Migrating that is a
            // separate, larger refactor - silence the noise for now rather
            // than leave dozens of warnings on every build.
            silenceDeprecations: ['import', 'global-builtin', 'color-functions'],
        }).on('error', sass.logError))
        .on('error', error.handler)
        .pipe(prefixer())
        .pipe(cleanCSS({ level: { 1: {}, 2: { restructureRules: true } } }))
        .pipe(concat('main.min.css'))
        .pipe(gulp.dest(path.build.styles))
        .pipe(reload({ stream: true }));
});
