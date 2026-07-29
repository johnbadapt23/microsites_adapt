import log from 'fancy-log';

export default {
	handler: function (error) {
		log.error('Error: ' + error.toString());
		process.stdout.write('\x07'); // terminal bell, replaces gulp-util's .beep()
		this.emit('end');
	}
};
