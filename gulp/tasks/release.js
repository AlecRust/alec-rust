var gulp = require('gulp');
var git = require('gulp-git');
var bump = require('gulp-bump');
var fs = require('fs');

function getPackageJsonVersion() {
  // Parse the JSON file instead of using require because require
  // caches multiple calls so the version number won't be updated
  return JSON.parse(fs.readFileSync('./package.json', 'utf8')).version;
}

gulp.task('bump-version', function () {
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

gulp.task('commit-changes', ['bump-version'], function () {
  var version = getPackageJsonVersion();
  return gulp.src('.')
    .pipe(git.add())
    .pipe(git.commit('Release version ' + version));
});

gulp.task('create-new-tag', ['commit-changes'], function (cb) {
  var version = getPackageJsonVersion();
  git.tag(version, 'Created Tag for version: ' + version, function (error) {
    if (error) {
      return cb(error);
    }
  });
});

gulp.task('release', ['create-new-tag']);
