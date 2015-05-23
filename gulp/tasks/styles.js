var path =        require('path');
var gulp =        require('gulp');
var stylus =      require('gulp-stylus');
var postcss =     require('gulp-postcss');
var clip =        require('gulp-clip-empty-files');
var bemLinter =   require('postcss-bem-linter');
var atImport =    require('postcss-import');
var cssnext =     require('cssnext');
var del =         require('del');
var notifyError = require('../notifyError');
var paths =       require('../paths');

/**
 * Compile all Stylus into CSS files, placed in a temp directory
 */
gulp.task('stylus', function() {
  return gulp.src(paths.styles.stylusSrc)
    .pipe(stylus().on('error', notifyError))
    .pipe(gulp.dest(paths.styles.tmpDir));
});

/**
 * Lint all built CSS files individually
 */
gulp.task('bemlint', ['stylus'], function() {
  return gulp.src(path.join(paths.styles.tmpDir, '**/*.css'))
    .pipe(clip())
    .pipe(postcss([
      bemLinter()
    ]).on('error', notifyError));
});

/**
 * Process CSS files with PostCSS and generate built files
 */
gulp.task('postcss', ['stylus', 'bemlint'], function() {
  return gulp.src(path.join(paths.styles.tmpDir, '*.css'))
    .pipe(postcss([
      atImport(),
      cssnext({
        url: false,
        features: {
          rem: false
        }
      })
    ]).on('error', notifyError))
    .pipe(gulp.dest(paths.styles.dest));
});

/**
 * Nuke temp CSS files
 * */
gulp.task('clean-css', ['stylus', 'bemlint', 'postcss'], function(cb) {
  del(paths.styles.tmpDir, cb);
});

gulp.task('styles', ['stylus', 'bemlint', 'postcss', 'clean-css']);
