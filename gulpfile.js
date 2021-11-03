const fs = require('fs');
const gulp = require('gulp');

gulp.task('build', async function () {
	gulp.src('src/*.php')
		.pipe(gulp.dest('build/src'));
	gulp.src('./*.php')
		.pipe(gulp.dest('build'));
	gulp.src('./composer.json')
		.pipe(gulp.dest('build'));
	gulp.src('./readme.txt')
		.pipe(gulp.dest('build'));
	gulp.src('assets/*')
		.pipe(gulp.dest('build/assets'));
	gulp.src('languages/*')
		.pipe(gulp.dest('build/languages'));
	vendor();
});

const vendor = () => {
	const composer = fs.readFileSync('./composer.json', 'utf8');
	const dependencies = Object.keys(JSON.parse(composer).require);
	dependencies.forEach((key, index) => {
		let dependency = key.split('/');
		if(dependency[0] !== 'php') {
			gulp.src(`vendor/${dependency[0]}/**/*`)
				.pipe(gulp.dest(`build/vendor/${dependency[0]}`));
		}
	});
}
