import gulp from 'gulp';
import deploy from 'gulp-deploy-git';

import path from '../../paths.js';

gulp.task('deploy:git', function () {
    return gulp.src('**/*')
        .pipe(deploy({
            repository: path.deploy.repository
        }));
});
