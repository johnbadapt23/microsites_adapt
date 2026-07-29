import gulp from 'gulp';
import browserSync from 'browser-sync';

import config from '../../config.js';

gulp.task('serve:html', function (done) {
    browserSync({
        server: {
            baseDir: config.serve.base
        },
        tunnel: config.serve.tunnel,
        host: config.serve.host,
        port: config.serve.port,
        logPrefix: config.serve.log
    });
    done();
});
