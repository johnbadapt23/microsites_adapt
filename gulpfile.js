// TASKS
// (each of these registers its task(s) via gulp.task() as a side effect)
import './source/gulp/tasks/clean.js';
import './source/gulp/tasks/watch.js';

import './source/gulp/tasks/build/favicons.js';
import './source/gulp/tasks/build/fonts.js';
import './source/gulp/tasks/build/html.js';
import './source/gulp/tasks/build/icons.js';
import './source/gulp/tasks/build/images.js';
import './source/gulp/tasks/build/php.js';
import './source/gulp/tasks/build/scripts.js';
import './source/gulp/tasks/build/styles.js';

import './source/gulp/tasks/serve/html.js';
import './source/gulp/tasks/serve/php.js';
import './source/gulp/tasks/serve/proxy.js';

import './source/gulp/tasks/deploy/ftp.js';
import './source/gulp/tasks/deploy/git.js';
import './source/gulp/tasks/deploy/zip.js';

// INCLUDES
import gulp from 'gulp';
import config from './source/gulp/config.js';

// TASKS
// gulp 4/5 dropped array-of-task-names dependency syntax in favour of
// explicit series()/parallel() composition.
gulp.task('__start', gulp.series(
    config.serve.task,
    'watch'
));

// `build:packages` (bower install + npm install) is gone now that the theme
// no longer depends on Bower - just run `npm install` yourself before `_build`.
gulp.task('_build', gulp.parallel(
    'build:fonts',
    'build:icons',
    'build:images',
    'build:scripts',
    'build:styles',
    'build:php'
));

export default gulp;
