import gulp from 'gulp';
import zip from 'gulp-zip';

import path from '../../paths.js';

gulp.task('deploy:zip', function () {
    return gulp.src(path.deploy.files)
        .pipe(zip(path.deploy.archive))
        .pipe(gulp.dest(path.deploy.folder));
});
