import log from 'fancy-log';

// Plain-function notifier, used as pump()'s completion callback in
// build:styles / build:scripts (see those files). It used to be a
// stream-bound `.on('error', handler)` that called `this.emit('end')` -
// which ends a stream gracefully instead of failing it, so a real compile
// error meant gulp.dest() silently never ran while the task (and CI) still
// reported success. Plain .pipe() chains also don't propagate errors
// downstream in Node, so even switching that to `this.destroy(error)` only
// killed the one stream that errored, not the rest of the chain - hence the
// move to pump(), which correctly destroys every stream in the pipeline and
// surfaces the error through one callback here.
export default {
	notify: function (error) {
		if (!error) return;
		log.error('Error: ' + error.toString());
		process.stdout.write('\x07'); // terminal bell, replaces gulp-util's .beep()
	}
};
