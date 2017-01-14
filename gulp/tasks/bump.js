var gulp = require('gulp');
var bump = require('gulp-bump');

gulp.task('bump', function () {
  gulp.src([
    'package.json',
    './src/assets/styles/style.styl',
    './src/functions.php',
  ])
  .pipe(bump())
  .pipe(gulp.dest(function(file) {
    return file.base;
  }));
  gulp.start('default');
});
