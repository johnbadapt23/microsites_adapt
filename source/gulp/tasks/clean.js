import gulp from 'gulp';
import { rm } from 'node:fs/promises';

import path from '../paths.js';

gulp.task('_clean', async function () {
    await rm(path.build.base, { recursive: true, force: true });
});
