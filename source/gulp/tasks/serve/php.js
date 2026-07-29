import gulp from 'gulp';
import php from 'gulp-connect-php';

import config from '../../config.js';

gulp.task('serve:php', function (done) {
    php.server({
        base: config.serve.base,
        port: config.serve.port,
        keepalive: true
    });
    done();
});
