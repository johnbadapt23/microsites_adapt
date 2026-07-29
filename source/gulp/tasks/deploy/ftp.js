import gulp from 'gulp';
import ftp from 'vinyl-ftp';

import path from '../../paths.js';

gulp.task('deploy:ftp', function () {
    // NOTE: path.deploy.ftp is not defined in paths.js - add host/user/password/
    // directory there before this task can actually run.
    const conn = ftp.create(path.deploy.ftp);
    return gulp.src(path.deploy.files, {
        base: path.deploy.base,
        buffer: false
    })
        .pipe(conn.dest(path.deploy.ftp.directory));
});
