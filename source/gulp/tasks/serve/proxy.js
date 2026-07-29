import gulp from 'gulp';
import browserSync from 'browser-sync';

import config from '../../config.js';

gulp.task('serve:proxy', function (done) {
    browserSync({
        proxy: config.serve.url,
        host: config.serve.host,
        port: config.serve.port,
        open: config.serve.open,
        notify: false,
        tunnel: config.serve.tunnel,
        logPrefix: config.serve.log
    });
    done();
});
