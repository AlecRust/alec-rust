var gulp =      require('gulp');
var gulpIf =    require('gulp-if');
var uglify =    require('gulp-uglify');
var minifyCss = require('gulp-cssnano');
var paths =     require('../paths');

gulp.task('copy', ['styles'], function () {
  return gulp.src([
    'src/**/*',
    '!src/assets/scripts',
    '!src/assets/scripts/**',
    '!src/assets/styles',
    '!src/assets/styles/**'
  ], {
    dot: true
  })
  .pipe(gulpIf('*.js', uglify()))
  .pipe(gulpIf('*.css', minifyCss()))
  .pipe(gulp.dest(paths.distDir));
});
