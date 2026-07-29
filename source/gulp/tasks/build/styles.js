import gulp from 'gulp';
import pump from 'pump';
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

gulp.task('build:styles', function (done) {
    // pump() (not chained .pipe()) so a Sass/plugin error properly destroys
    // every stream in the pipeline and reaches this one callback - plain
    // .pipe() chains don't propagate errors to downstream pipes in Node, so
    // a compile error would otherwise leave gulp.dest() running on whatever
    // partial data got through, or skipping it silently, while the task
    // still reported success.
    pump([
        gulp.src(path.src.styles),
        sassGlob(),
        // NOTE: the old pipeline ran autoprefixer before the Sass compile
        // step, so it only touched the plain vendor .css files in the list
        // and never actually prefixed anything compiled from main.scss.
        // Autoprefixer now runs after sass() so it prefixes the real
        // compiled output too.
        sass({
            outputStyle: 'compressed',
            // The theme's ~40 partials all use @import, which Dart Sass is
            // deprecating in favour of @use/@forward. Migrating that is a
            // separate, larger refactor - silence the noise for now rather
            // than leave dozens of warnings on every build.
            silenceDeprecations: ['import', 'global-builtin', 'color-functions'],
        }),
        prefixer(),
        cleanCSS({ level: { 1: {}, 2: { restructureRules: true } } }),
        concat('main.min.css'),
        gulp.dest(path.build.styles),
        reload({ stream: true })
    ], function (err) {
        error.notify(err);
        done(err);
    });
});
