import fs from 'node:fs';
import gulp from 'gulp';
import favicon from 'gulp-real-favicon';

import path from '../../paths.js';

gulp.task('build:favicons', function (done) {
	favicon.generateFavicon({
		masterPicture: path.src.favicon.master,
		dest: path.build.favicons,
		iconsPath: path.src.favicon.path,
		design: path.src.favicon.design,
		settings: path.src.favicon.settings,
		markupFile: path.src.favicon.data
	}, function () {
		done();
	});

	gulp.src([path.src.favicon.html])
		.pipe(favicon.injectFaviconMarkups(JSON.parse(fs.readFileSync(path.src.favicon.data)).favicon.html_code))
		.pipe(gulp.dest('templates/partials/'));
});

gulp.task('favicons:update', function (done) {
	var currentVersion = JSON.parse(fs.readFileSync(path.src.favicon.data)).version;
	favicon.checkForUpdates(currentVersion, function (err) {
		if (err) {
			done(err);
			return;
		}
		done();
	});
});
